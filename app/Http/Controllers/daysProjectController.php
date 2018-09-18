<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class daysProjectController extends Controller
{
	public function index() {
		return view('index');
	}

	public function showElement(){
		$data = DB::select('call spGetListProjectEmp');
		$countlist = count($data);

		$listprojectRole = DB::table('list_project_role')
								->orderBy('PROJECT_ROLE_EMP','asc')
								->get();
		$employeeName = DB::table('employee')->select('EMPLOYEE_NAME','EMPLOYEE_ID','avatar')->get();
		$projectname = DB::table('project')
								->orderBy('PROJECT_NAME','asc')
								->get();

		return view('days_project',compact(['data','listprojectRole','employeeName','projectname','countlist']));
	}

	public function search_mandays(Request $request){	
		$idEmployee = $request->get('nama');
		$result = DB::select("call spGetsearch_mandaysEmp('".$idEmployee."')");
		$data ['content'] = $result;
		return json_encode($data);
	}

	public function insert_project(Request $request){

		$idemployee   = $request->get('idemployee');
		$idprojek     = $request->get('idprojek');
		$idprojekRole = $request->get('idprojekRole');
		$startwork    = $request->get('startwork');
		$endwork      = $request->get('endwork');
		$workduration = $request->get('workduration');

		$saveData = array("EMPLOYEE_ID"=>$idemployee,"PROJECT_DETAIL_ID"=>$idprojek,"LIST_PROJECT_ROLE_ID"=>$idprojekRole,"START_WORK"=>$startwork,"END_WORK"=>$endwork,"WORK_DURATION"=>$workduration);

		DB::table('project_employee')->insert($saveData);

		$msg['msg'] = 'Success Insert';

		return json_encode($msg);
	}

	public function getJabatan(Request $request){
		if($request -> ajax())
		{
			$temp = DB::table('employee')->select('EMPLOYEE_TITLE')
										 ->where('EMPLOYEE_ID','=',$request->getjbtn)                                    
										 ->get();
			
			 $x = json_encode($temp);
			return $x;
		}
	}

	public function getInfoProjek(Request $request){
		if($request -> ajax())
		{
			$tempInfoProjek = DB::table('project')
										->select('PROJECT_START','PROJECT_END','PROJECT_DURATION')
										->where('PROJECT_DETAIL_ID','=',$request->getInfoProjek)
										->get();

			$tempInfoProjek = json_encode($tempInfoProjek);
			return $tempInfoProjek;
		}
	}

	public function history($project_id, $last_status){

		$result = DB::table('schedule')
				->select('schedule.status', DB::raw("CASE `schedule`.`status` WHEN 0 THEN 'Started' WHEN 1 THEN 'Paused' WHEN 2 THEN 'Stopped' ELSE 'Undefined' END AS `status_formatted`"), DB::raw("DATE_FORMAT(`schedule`.`timelaps`, '%d-%m-%Y %H:%i') AS `timelaps_formatted` "), DB::raw("DATE_FORMAT(`schedule`.`timelaps`, '%Y-%m-%d %H:%i:%s') AS `timelaps_formatted_en`"), 'schedule.timelaps')
				->where('schedule.project_id','=',$project_id)
				->orderby('schedule.timelaps','asc')
				->get();
		$result1 = DB::table('holiday')
				->select('day')
				->get();
		$innerTable = "";
		$fired_interval = 0;
		for($i = 0; $i < sizeof($result); $i++)
		{
			$innerTable .= '<tr>';
			$innerTable .= '<td style = "width:20px;">' . ($i + 1) . '</td>';
			$innerTable .= '<td>' . $result[$i]->status_formatted . '</td>';
			$innerTable .= '<td>' . $result[$i]->timelaps_formatted . '</td>';
			$innerTable .= '</tr>';

			if(($last_status == 'RUNNING' || $last_status == 'PAUSED' || $last_status == 'STOPPED') && ($result[$i]->status_formatted == 'Paused' || $result[$i]->status_formatted == 'Stopped'))
			{
				$from_time = $result[$i-1]->timelaps_formatted_en;
				$to_time = $result[$i]->timelaps_formatted_en;
				$time_diff = $this->get_duration($from_time, $to_time);
				$interval_diff = $this->get_duration($from_time, $to_time, 1);
				if($fired_interval < 1)
				{
					$total_interval = MyDateInterval::fromDateInterval($interval_diff);
					$fired_interval++;
				}
				else
				{
					$total_interval->add($interval_diff);
				}

				$innerTable .= '<tr>';
				$innerTable .= '<td colspan="2">Sub Total</td>';
				$innerTable .= '<td>' . $time_diff . '</td>';
				$innerTable .= '</tr>';

				if($i == (sizeof($result) - 1) && $last_status != 'RUNNING')
				{
					$labels = [
						'y' => 'year',
						'm' => 'month',
						'd' => 'day',
						'h' => 'hour',
						'i' => 'minute',
						's' => 'second',
					];                    
					$return = [];
					foreach ($labels as $k => $v) {
						if ($total_interval->$k) {
							$return[] = $total_interval->$k . ' ' . $v . ($total_interval->$k > 1 ? 's' : '');
						}
					}

					$innerTable .= '<tr>';
					$innerTable .= '<td colspan="2">Grand Total</td>';
					$innerTable .= '<td>' . implode(', ', $return) . '</td>';
					$innerTable .= '</tr>';
					
					$data_project = DB::table('project_employee')->select('PROJECT_ID')
										 ->where('PROJECT_ID','=',$project_id)                                    
										 ->get(); 

					if ( count($data_project)==0 ) 
					{
						
						$save = array("PROJECT_ID"=>$project_id);
						DB::table('project_employee')->insert($save);                         

					}else{

						$days = $total_interval->d + 1;
						DB::table('project_employee')                                    
									->where('PROJECT_ID',$project_id)
									->update(['REALIZE_TIME'=>$total_interval->d + 1]);
					}                   

				}
			}
		}

		$table = '<table class="table table-bordered table-responsive table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Status</th>
									<th>Timelaps</th>
								</tr>
							</thead>
							<tbody>';
		$table .= $innerTable;                    
		$table .='</tbody>
						</table>';
		return $table;
	}

	public function action(Request $request){
		$projectID = $request->get('projectID');
		$status = $request->get('actionStatus');

		$save = array("PROJECT_ID"=>$projectID,"STATUS"=>$status,"TIMELAPS"=>DB::raw("now()"));
		DB::table('schedule')->insert($save);
		$msg['msg'] = 'Action executed';
		return json_encode($msg);
	}

	public function getMandays(Request $request){
		$list = DB::select('call spGetListProjectEmp');

		if(count($list) > 0) {
			for ($i=0; $i < count($list); $i++) {
				$list[$i]->rownum = $i+1;
				if($list[$i]->timeline_status == 'NOT_STARTED' || $list[$i]->timeline_status == 'PAUSED') {
					$act = 0;
					$list[$i]->action =
						'<button class="btn-success btn-start" id="act'.$i.'" onClick="actionClick('.$i.','.$act.','.$list[$i]->PROJECT_ID.')"><i class="fa fa-play" aria-hidden="true"></i></button>';
				}else if($list[$i]->timeline_status == 'RUNNING'){
					$actPause = 1;
					$actStop = 2;
					$list[$i]->action =
						'<button class="btn-warning btn-pause" id="act'.$i.'" onClick="actionClick('.$i.','.$actPause.','.$list[$i]->PROJECT_ID.')">'
						.'<i class="fa fa-pause" aria-hidden="true"></i></button>'
						.'<button class="btn-danger btn-stop" id="act'.$i.'" onClick="actionClick('.$i.','.$actStop.','.$list[$i]->PROJECT_ID.')">'
						.'<i class="fa fa-stop" aria-hidden="true"></i></button>';
				}else if($list[$i]->timeline_status == 'STOPPED'){
					$list[$i]->action = 'Done';
				}
				$list[$i]->history =
					'<button type="button" class="btn btn-default btn-sm btn-history-modal" id="hist'.$i.'" onClick="historyClick('.$list[$i]->PROJECT_ID.',\''.$list[$i]->timeline_status.'\')"><span class="glyphicon glyphicon-list-alt"></span> Show </button>';
			};
			$data['data'] = $list;
			$data['status'] = 'success';
			return json_encode($data);
		}else {
			return json_encode(["status" => 'Failed']);
		}
		return json_encode($data);
	}

	function get_duration($from, $to, $return_interval = 0) {
		$workingDays = [1, 2, 3, 4, 5]; # date format = N
		$workingHours = ['from' => ['00', '00'], 'to' => ['23', '59']];

		$start = new \DateTime($from);
		$end = new \DateTime($to);

		$startP = clone $start;
		//$startP->setTime(0, 0, 0);
		$endP = clone $end;
		//$endP->setTime(23, 59, 59);
		$interval = new \DateInterval('P1D');
		$periods = new \DatePeriod($startP, $interval, $endP);

		$sum = [];
		foreach ($periods as $i => $period) {
			if (!in_array($period->format('N'), $workingDays)) continue;

			$startT = clone $period;
			$startT->setTime($workingHours['from'][0], $workingHours['from'][1]);
			if (!$i && $start->diff($startT)->invert) $startT = $start;

			$endT = clone $period;
			$endT->setTime($workingHours['to'][0], $workingHours['to'][1]);
			if (!$end->diff($endT)->invert) $endT = $end;

			#echo $startT->format('Y-m-d H:i') . ' - ' . $endT->format('Y-m-d H:i') . "\n"; # debug

			$diff = $startT->diff($endT);
			if ($diff->invert) continue;
			foreach ($diff as $k => $v) {
				if (!isset($sum[$k])) $sum[$k] = 0;
				$sum[$k] += $v;
			}
		}
		if (!$sum) return '0 day 0 hour 0 minute 0 second';

		$spec = "P{$sum['y']}Y{$sum['m']}M{$sum['d']}DT{$sum['h']}H{$sum['i']}M{$sum['s']}S";
		$interval = new \DateInterval($spec);
		$startS = new \DateTime;
		$endS = clone $startS;
		$endS->sub($interval);
		$diff = $endS->diff($startS);

		if($return_interval == 1)
			return $diff;

		$labels = [
			'y' => 'year',
			'm' => 'month',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		];
		$return = [];
		
		foreach ($labels as $k => $v) {
			if ($diff->$k) {
				$return[] = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			}
		}

		return implode(', ', $return);                
	}

}

class MyDateInterval extends \DateInterval
{
	/**
	 * @param DateInterval $from
	 * @return MyDateInterval
	 */
	public static function fromDateInterval(\DateInterval $from)
	{
		return new MyDateInterval($from->format('P%yY%dDT%hH%iM%sS'));
	}
	public function add(\DateInterval $interval)
	{
		foreach (str_split('ymdhis') as $prop) {
			$this->$prop += $interval->$prop;
		}
		$this->i += (int)($this->s / 60);
		$this->s = $this->s % 60;
		$this->h += (int)($this->i / 60);
		$this->i = $this->i % 60;
	}
}