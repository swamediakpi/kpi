<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class integrasiController extends Controller
{
	public function showRoleUnit()
	{

		$showRole = DB::table('role')->get();
        $showUnit = DB::table('unit')->get();
        

       	return view('integrasi_emp',compact(['showRole','showUnit']));
	}	
	public function getemp(Request $request)
	{
		$nik	= $request->get('nik');
	   $response= DB::select("call spgetemp('".$nik."')");
			
		return json_encode($response);
	}
	public function getapi(Request $request)
	{
		$unit 	= $request->get('unit');
		$tanggal = $request->get('tanggal');
		$url = "http://portal.swamedia.co.id/index.php/hrm/json/".$unit."/".$tanggal ;    
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		curl_setopt($curl, CURLOPT_HTTPGET, 1);

		$json_response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($json_response, true);

       	return json_encode($response);
	}

	public function insert_emp(Request $request){

        $noemp       = $request->get('noemp');
		$role        = $request->get('role');
        $unit        = $request->get('unit');
        $name 		 = $request->get('name');
    	$email       = $request->get('email');
        $title 		 = $request->get('title');
    	$username    = $request->get('username');        
        $password	 = $request->get('pass');
        $conpass  	 = $request->get('passcon');       
        $avatar  	 = $request->get('emp_pict');       
        $tahun  	 = $request->get('tahun');       

        $saveData = array("EMPLOYEE_ID"=>$noemp,"ROLE_ID"=>$role,"UNIT_ID"=>$unit,"EMPLOYEE_NAME"=>$name,"EMPLOYEE_EMAIL"=>$email,"EMPLOYEE_TITLE"=>$title,"username"=>$username,"password"=>bcrypt($password),"avatar"=> $avatar );
		

        $simpan = DB::select("call spInputEmp('".$noemp."', '".$role."', '".$unit."', '".$name."', '".$email."', '".$title."', '".$username."', '".bcrypt($password)."','".$avatar."','".$tahun."')");
       
	   
	   
	   
        //dd($simpan);
        if($noemp!=null && $role!=null && $unit!=null && $name!=null && $email!=null && $title!=null && $username!=null && $password!=null && $avatar){
                    $msg['msg'] = 'Success Insert';
        }
        else{
                    $msg['msg'] = 'Gagal Insert';
        }


        return json_encode($msg);
	}
}