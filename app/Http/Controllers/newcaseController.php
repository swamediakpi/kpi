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
		$dataEmp = DB::select("call spGetEmployeeFromUnit('".$unitid."')");
        $dataPrjct = DB::select("call spgetProjectfromunit('".$unitid."')");

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
        
        if (is_array($date) || is_object($date)){ 
        
            foreach ($date as $key) {
                $listdate = $key['date'];
 
                DB::select("call spInputSingelMandaysproject('".$emp."', '".$prjct."', '".$prjctrole."', '".$listdate."', '".$Cdate."')" );
            }
                $msg['msg'] = 'Success Insert';
	    }else{
	            $msg['msg'] = 'Assembly Error!';
	    }

        return json_encode($msg);
	}
}