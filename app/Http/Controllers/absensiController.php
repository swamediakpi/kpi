<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class absensiController extends Controller
{
	public function showData(){

		$id_name = Auth::user()->EMPLOYEE_ID;
		$id_unit = Auth::user()->UNIT_ID;
		$months = array();


		if(Auth::user()->ROLE_ID == '1' || Auth::user()->ROLE_ID == '2' || Auth::user()->ROLE_ID == '5' || Auth::user()->ROLE_ID == '8') {
			$showUnit = DB::table('unit')->whereNotIn('UNIT',['HRD','NON Unit'])
			                             ->get();

		}else if(Auth::user()->ROLE_ID == '3') {
			$showUnit = DB::table('unit')->where('UNIT_ID','=',$id_unit)
			                             ->whereNotIn('UNIT',['HRD','NON Unit'])
										 ->get();
		}else if(Auth::user()->ROLE_ID == '6' || Auth::user()->ROLE_ID == '7') {
			if(Auth::user()->ROLE_ID == '6') {
				$showUnit = DB::table('unit')->whereIn('UNIT_ID', array(1,3))
											 ->get();
			}else {
				$showUnit = DB::table('unit')->whereIn('UNIT_ID', array(2,4))
											 ->get();
			}
		}

		for($i = 0; $i < 12; $i++) {
			array_push($months, date('F', strtotime('+ '.$i.' months')));
		}
		return view('absensi',compact(['showUnit','months']));
	}

	public function filter_absensi(Request $request){

		$emp_id   = $request->get('emp_id');
		$month   = $request->get('month');
		
		if($month == "komulatif"){
		    
		    $query =  DB::select("call spViewAbsenYear('$emp_id')");
		    
		}else{
		    
    		$query =  DB::select("call spViewAbsen('$emp_id','$month')");		    
		}

		$data ['content'] = $query;		
        
        return json_encode($data);
	}

	public function getEmployeeFromUnit(Request $request){
        $idUnit = $request->get('id');

        $data = DB::select('call spGetEmployeeFromUnit('.$idUnit.')');

        return response()->json($data);
    }

}