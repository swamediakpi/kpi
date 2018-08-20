<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class newcaseController extends Controller
{
	public function showElement(){

		$showUnit        = DB::table('unit')->get();
		$showProjectRole = DB::table('list_project_role')->get();

		return view('newcase',compact(['showUnit','showProjectRole']));
	}

	public function getEmpPrjct(Request $request){
		$unitid = $request->get('id');
		$dataEmp = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')                            
                                    ->where('UNIT_ID','=',$unitid)
                                    ->get();
        $dataPrjct = DB::table('project_detail')->select('PROJECT_DETAIL_ID','PROJECT_NAME')
                                    ->where('UNIT_ID','=',$unitid)
                                    ->get();

		$data ['contentEmp']   = $dataEmp;
        $data ['contentPrjct'] = $dataPrjct;
        return json_encode($data);
	}

	public function insert_Prjct(Request $request){
		$unit      = $request->get('unit');
        $emp       = $request->get('emp');
        $prjct     = $request->get('prjct');
        $prjctrole = $request->get('prjctrole');
        $Cdate     = $request->get('Cdate');
        $date      = $request->get('date');
        
        // var_dump($unit);
        // var_dump($emp);
        // var_dump($prjct);
        // var_dump($prjctrole);
        // var_dump($Cdate);
        // var_dump($date);

        if (is_array($date) || is_object($date)){ 
        
            foreach ($date as $key) {
                $listdate = $key['date'];
                
                $save = array("EMPLOYEE_ID"=>$emp,"PROJECT_DETAIL_ID"=>$prjct,"LIST_PROJECT_ROLE_ID"=>$prjctrole,"START_WORK"=>$listdate,"WORK_DURATION"=>$Cdate);

                DB::table('project')->insert($save);
            }
                $msg['msg'] = 'Success Insert';
	    }else{
	            $msg['msg'] = 'Assembly Error!';
	    }

        return json_encode($msg);
	}
}