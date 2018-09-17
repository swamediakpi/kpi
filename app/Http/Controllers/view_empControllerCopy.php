<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class view_empController extends Controller
{
	public function showElement(){
		$showRole = DB::table('role')->get();

		$showUnit = DB::table('unit')->get();

		return view('view_emp',compact(['showUnit']));
	}

	public function filter_emp(Request $request){
		$unit    = $request->get('unit');

		$showemp = DB::table("employee")
						->join("unit","employee.UNIT_ID","=","unit.UNIT_ID")
						->join("role","employee.ROLE_ID","=","role.ROLE_ID")
						->select("EMPLOYEE_NAME","EMPLOYEE_TITLE","UNIT","ROLE_NAME")
						->where("employee.UNIT_ID","=",$unit)
						->where("employee.EMPLOYEE_NAME","!=","admin")
						->get();

		 $data ['content'] = $showemp;
        
        return json_encode($data);
	}
}
