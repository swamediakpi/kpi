<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class projectController extends Controller
{
	public function insert_project(Request $request){

        $unit        = $request->get('unit');
		$namaProject = $request->get('nama');
    	$start 		 = $request->get('start');
    	$finish 	 = $request->get('finish');
        $days  	 	 = $request->get('days');

        $saveData = array("UNIT_ID"=>$unit,"PROJECT_NAME"=>$namaProject,"PROJECT_START"=>$start,"PROJECT_END"=>$finish,"PROJECT_DURATION"=>$days);

        DB::raw("call spInputProject('".$unit."', '".$namaProject."', '".$start."', '".$finish."', '".$days."')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
	}
    public function showElement(){

        $showUnit = DB::table('unit')->get();

        return view('project',compact('showUnit'));
    }

}


?>