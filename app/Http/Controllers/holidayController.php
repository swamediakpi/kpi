<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use app\Holiday;
use DB;

class holidayController extends Controller
{
	public function show(){			
		$tahun = DB::table('t_tahun')->get();
		$holidays = DB::table('holiday')->get();

		return view('holiday',compact(['holidays','tahun']));
	}

	public function getholiday(Request $request){
		if($request -> ajax())
    	{
    		$showDate = DB::table('holiday')->select('day')		 							 
    									 	->get();
    		return json_encode($showDate);
    	}
	}
	public function filter_tahun_holiday(Request $request){
    	$tahun   = $request->get('tahun');
    	//dd($tahun);
        //$dataPrjct = DB::select("call spMandaysfilter_prjct('".$emp_id."', '".$prjct_id."')");
        $dataHoliday = DB::table('holiday')
        	->whereYear('day','=',$tahun )
        	->orderBy('day','asc')
        	->get();
		$data ['content'] = $dataHoliday;
        //dd($data);

        return json_encode($data);
    }

	public function input_holiday(Request $request){
		$holiday = $request->get('holiday');
        $ket     = $request->get('ket');      

        $saveData = array("day"=>$holiday,"keterangan"=>$ket);

        DB::table('holiday')->insert($saveData);

        $msg['msg'] = 'Success Insert';

		return json_encode($msg);
	}
	public function update_holiday(Request $request){
		$holiday_id = $request->get('holiday_id');
		$holiday_date = $request->get('holiday_date');
		$holiday_ket = $request->get('holiday_ket');

		$updateArr = array('day_id' => $holiday_id,'day' => $holiday_date,'keterangan' => $holiday_ket);
		//($updateArr);
		DB::table('holiday')
			->where('day_id',$holiday_id)
			->update($updateArr);
		$msg['msg'] = 'Success Update';

		return json_encode($msg);
	}
	public function delete_holiday(Request $request){
		$holiday_id = $request->get('holiday_id');
		DB::table('holiday')
			->where('day_id', '=', $holiday_id)
			->delete();
		$msg['msg'] = 'Success Delete';
		return json_encode($msg);
	}	

}