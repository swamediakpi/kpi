<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class holidayController extends Controller
{
	public function show(){			

		$holidays = DB::table('holiday')->get();

		return view('holiday',compact(['holidays']));
	}

	public function getholiday(Request $request){
		if($request -> ajax())
    	{
    		$showDate = DB::table('holiday')->select('day')					 							 
    									 	->get();
    	
    		return json_encode($showDate);
    	}
	}

	public function input_holiday(Request $request){
		$holiday = $request->get('holiday');
        $ket     = $request->get('ket');      

        $saveData = array("day"=>$holiday,"keterangan"=>$ket);

        DB::table('holiday')->insert($saveData);

        $msg['msg'] = 'Success Insert';

		return json_encode($msg);
	}
	

}