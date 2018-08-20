<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class plController extends Controller
{
    public function showElement(){

    	
        $EmployeeName  = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')
                                              ->where('ROLE_ID','=','5')
                                              ->get();
        

    	$bulan = DB::table('T_BULAN')->get();
    	$tahun = DB::table('T_TAHUN')->get();
        $rolepl = DB::table('role')->select('ROLE_ID')
                                    ->where('ROLE_NAME','=','Project_Leader')
                                    ->get();
        $listInsert = DB::table('header_kpi')->join('kinerja','header_kpi.KINERJA_ID','=','kinerja.KINERJA_ID')
                                             ->join('kpi','header_kpi.KPI_ID','=','kpi.KPI_ID')
                                             ->join('role','header_kpi.ROLE_ID','=','role.ROLE_ID')
                                             ->where('header_kpi.ROLE_ID','=','4')
                                             ->get();

         $countlist = count($listInsert);
   
    	
    	return view('projectleader',compact(['EmployeeName','bulan','tahun','rolepl','listInsert','countlist']));
    }
    
    public function filter_pl(Request $request){
    	
        $idEmployee = $request->get('nama');
    	$idBulan = $request->get('bulan');
        $idTahun = $request->get('tahun');
    	$idRole  = $request->get('role');

        $resultpl = DB::select("call spView('$idEmployee','$idBulan','$idTahun','$idRole')");
    	$data ['content'] = $resultpl;
        
        return json_encode($data);
    }

    public function insert_pl(Request $request){
        
        $nama = $request->get('nama');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
        $kritik = $request->get('kritik');
        $total = $request->get('total');
        $role = $request->get('role');
        $list = $request->get('list_bobot');
        

        $compareNama =  DB::table('penilaian')
                        ->select('EMPLOYEE_ID')
                        ->where('EMPLOYEE_ID','=',$nama)                              
                        ->get();
        $cekKosongNama = json_decode($compareNama);

        if($cekKosongNama == []){
            $cekNama = json_decode($compareNama);
        }else{
            $cekNama = json_decode($compareNama[0]->EMPLOYEE_ID);    
        }        

        $compareBulan =  DB::table('penilaian')->select('BULAN_ID')                          
                              ->where('BULAN_ID','=',$bulan)                              
                              ->get();
        $cekKosongBulan = json_decode($compareBulan);
        if($cekKosongBulan == []){
            $cekBulan = json_decode($compareBulan);
        }else{
            $cekBulan = json_decode($compareBulan[0]->BULAN_ID);  
        }    
       
        $compareTahun =  DB::table('penilaian')->select('TAHUN_ID')                              
                              ->where('TAHUN_ID','=',$tahun)
                              ->get();
        $cekKosongTahun = json_decode($compareTahun);
        if($cekKosongTahun == []){
            $cekTahun = json_decode($compareTahun);
        }else{
            $cekTahun = json_decode($compareTahun[0]->TAHUN_ID);  
        }    
        

        if($nama == $cekNama && $bulan == $cekBulan && $tahun == $cekTahun){
            $msg['msg'] = 'Data is already available!';
        }else{

            $savePenilaian = array("EMPLOYEE_ID"=>$nama,"BULAN_ID"=>$bulan,"TAHUN_ID"=>$tahun,"ROLE_ID"=>$role,"KRITIK_SARAN"=>$kritik,"TOTAL"=>$total);

            DB::table('penilaian')->insert($savePenilaian);

            $b = DB::table('penilaian')->select('PENILAIAN_ID')
                                             ->orderby('PENILAIAN_ID','DESC')                                      
                                             ->take(1)
                                             ->get();

            $getLastID = json_encode($b[0]->PENILAIAN_ID);

            if (is_array($list) || is_object($list)){                                 
                foreach ($list as $key) {
                    $listid = $key['list_id'];
                    $bobot = $key['bobot'];
                    $saveHasilKinerja = array("PENILAIAN_ID"=>$getLastID,"LIST_ID"=>$listid,"BOBOT"=>$bobot);
                    DB::table('hasil_kinerja')->insert($saveHasilKinerja);
                }
                $msg['msg'] = 'Success Insert';
            }else{                
                $msg['msg'] = 'Assembly Error!';
            }
        }
        return json_encode($msg);
    }
}