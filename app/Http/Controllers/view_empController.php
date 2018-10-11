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

		$showemp = DB::select("CALL spunitemp('".$unit."', '".$tahun."')");

		 $data ['content'] = $showemp;
		 return json_encode($data);
	}
	public function forunit(Request $request){

	$unit_id = $request->get('unit');
	$tahun= date("Y");
		
		$data = DB::select("CALL spunitemp('".$unit_id."', '".$tahun."')");
				
		return json_encode($data);
	}
}