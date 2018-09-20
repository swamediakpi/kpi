<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class integrasiController extends Controller
{
	public function showRoleUnit()
	{
		$tahun = DB::table('t_tahun')->get();
		$showRole = DB::table('role')->get();
        $showUnit = DB::table('unit')->get();
        

       	return view('integrasi_emp',compact(['showRole','showUnit','tahun']));
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
public function insertJSONtoDB($kode_unit,$month,$date)
{
    $connect = mysqli_connect("172.17.3.11","kpibim","kpi123","petamudi_kpi");

    $tanggal =  date("mY");
    $url = "http://portal.swamedia.co.id/index.php/hrm/json/".$kode_unit."/".$month.$date; 
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_HTTPGET, 1);

    $json_response = curl_exec($curl);
    curl_close($curl);
		//$response = json_decode($json_response, true);
		//$responeencod = json_encode($response, true);

    $array = json_decode($json_response,true);

    $periode = $array['periode']['date1'];
    $periode1 = $array['periode']['date2'];
    $harikerja = $array['jmlharikerja'];
	//$save = DB::select("call spinsertharikerjabulan('".$harikerja."', '".$month."','".$date."')");
  //  var_dump($array);

    $hadir = $array['absen'][0]['hadir'];



    for ($i=0; $i < count($array['absen']) ; $i++) 
    { 
       $no = $array['absen'][$i]['no'];
       $hadir = $array['absen'][$i]['hadir'];
	   $kid = $array['absen'][$i]['kid'];
	   $nik = $array['absen'][$i]['nik'];
       $tidakabsen = $array['absen'][$i]['tidakabsen'];
       $terlambat = $array['absen'][$i]['terlambat'];
       $jmlharikerja = $array['jmlharikerja'];
       $periode_awal = $array['periode']['date1'];
       $periode_akhir = $array['periode']['date2'];
    	//var_dump($periode_awal);   
    	//var_dump($jmlharikerja);

        $simpan = DB::select("call spinsertabsen('".$no."', '".$hadir."', '". $tidakabsen."', '".$terlambat."', '".$jmlharikerja."', '".$periode_awal."', '".$periode_akhir."', '".$kid."')");
       
	   
       for ($j=0; $j < count($array['absen'][$i]['rincian']); $j++) 
       { 
          $no = $array['absen'][$i]['no'];
          $kid = $array['absen'][$i]['kid'];
		  $nik = $array['absen'][$i]['nik'];
          $hari = $array['absen'][$i]['rincian'][$j]['hari'];
          $tanggal = $array['absen'][$i]['rincian'][$j]['tanggal'];
          $masuk = $array['absen'][$i]['rincian'][$j]['masuk'];
          $pulang = $array['absen'][$i]['rincian'][$j]['pulang'];
          $telat = $array['absen'][$i]['rincian'][$j]['telat'];
          $keterangan = $array['absen'][$i]['rincian'][$j]['keterangan'];

			$simpan = DB::select("call spinsertrincianabsen('".$no."','".$kid."', '". $hari ."', '".$tanggal."', '".$masuk."', '".$pulang."', '". $telat ."')");
		
		   
    		// var_dump($hari);
    		// var_dump($tanggal);
    		// var_dump($masuk);
    		// var_dump($pulang);
    		// var_dump($telat);
    		// var_dump($keterangan);

       
		 // var_dump($sql1);

        //     $sql1 = "INSERT INTO waktu(employee_id,masuk,pulang) VALUES ('$no','$masuk','$pulang')";
        // mysqli_query($connect, $sql1);
      }
    }
	  

}
	public function update_data(Request $request)
	{
		$year =  $request->get('year');
		$month =  $request->get('month');
		for ($kd_unit=1;$kd_unit<=11;$kd_unit++)
		$this->insertJSONtoDB($kd_unit,$month,$year);
		
  $msg['msg'] = 'Success Insert';
        return json_encode($msg);	}

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
        $kid  	 	 = $request->get('kid'); 

		
        $saveData = array("EMPLOYEE_ID"=>$noemp,"ROLE_ID"=>$role,"UNIT_ID"=>$unit,"EMPLOYEE_NAME"=>$name,"EMPLOYEE_EMAIL"=>$email,"EMPLOYEE_TITLE"=>$title,"username"=>$username,"password"=>bcrypt($password),"avatar"=> $avatar );
		

        $simpan = DB::select("call spInputEmp('".$noemp."', '".$role."', '".$unit."', '".$name."', '".$email."', '".$title."', '".$username."', '".bcrypt($password)."','".$avatar."','".$tahun."','".$kid."')");
       
	   
	   
	   
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