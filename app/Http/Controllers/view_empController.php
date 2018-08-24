<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class view_empController extends Controller {
	public function showElement(){
		$showRole = DB::table('role')->get();
		$showUnit = DB::table('unit')->get();
		$tahun = DB::table('t_tahun')->get();

		return view('view_emp',compact(['showUnit','tahun']));
	}

	public function filter_emp(Request $request){
		$unit  = $request->get('unit');
		$month = date("m");
		$tahun = $request->get('tahun');
		$json = file_get_contents('http://portal.swamedia.co.id/index.php/hrm/json/'.$unit.'/'.$month.$tahun);
		$obj = json_decode($json);
		// $data  = $obj;
		$showemp = DB::table("employee")
						->join("unit","employee.UNIT_ID","=","unit.UNIT_ID")
						->join("role","employee.ROLE_ID","=","role.ROLE_ID")
						->join("periode_employee","employee.EMPLOYEE_ID","=","periode_employee.EMPLOYEE_ID")
						->join("t_tahun","periode_employee.TAHUN_ID","=","t_tahun.TAHUN_ID")
						->select("EMPLOYEE_NAME","EMPLOYEE_TITLE","UNIT","ROLE_NAME")
						->where("employee.UNIT_ID","=",$unit)
						->where("t_tahun.TAHUN","=",$tahun)
						->where("employee.EMPLOYEE_NAME","!=","admin")
						->get();

		 $data ['content'] = $showemp;
		 return json_encode($data);
	}
}