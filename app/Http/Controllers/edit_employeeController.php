<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_employeeController extends Controller
{
	public function showRoleUnit()
	{

		$showRole = DB::table('role')->get();
        $showUnit = DB::table('unit')->get();
        

       	return view('edit_employee',compact(['showRole','showUnit']));
	}

	public function edit_employee(Request $request){

        $noemp       = $request->get('noemp');
		$role        = $request->get('role');
        $unit        = $request->get('unit');
        $name 		 = $request->get('name');
    	$email       = $request->get('email');
        $title 		 = $request->get('title');
    	$username    = $request->get('username');        
        $password	 = $request->get('pass');
        $conpass  	 = $request->get('passcon');       


        $saveData = array("EMPLOYEE_ID"=>$noemp,"ROLE_ID"=>$role,"UNIT_ID"=>$unit,"EMPLOYEE_NAME"=>$name,"EMPLOYEE_EMAIL"=>$email,"EMPLOYEE_TITLE"=>$title,"username"=>$username,"password"=>bcrypt($password));
		
        //sesuai kan dengan nama sp edit nya 
        //$simpan = DB::raw("call spInputEmp('".$noemp."', '".$role."', '".$unit."', '".$name."', '".$email."', '".$title."', '".$username."', '".bcrypt($password)."')");
        //dd($simpan);
        if($simpan){
                    $msg['msg'] = 'Success Insert';
        }
        else{
                    $msg['msg'] = 'Gagal Insert';
        }


        return json_encode($msg);
	}
}
?>