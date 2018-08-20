<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class asmanController extends Controller
{
    public function showElement(){
        
        $unitAuth   = Auth::user()->UNIT_ID;
        $bulan     = DB::table('t_bulan')->get();
        $tahun     = DB::table('t_tahun')->get();
        $roleasman = DB::table('role')->select('ROLE_ID')
                                    ->where('ROLE_NAME','=','UNIT')
                                    ->get();
        $listInsert = DB::table('header_kpi')->join('kinerja','header_kpi.KINERJA_ID','=','kinerja.KINERJA_ID')
                                             ->join('kpi','header_kpi.KPI_ID','=','kpi.KPI_ID')
                                             ->join('role','header_kpi.ROLE_ID','=','role.ROLE_ID')
                                             ->where('header_kpi.ROLE_ID','=','3')
                                             ->where('STATUS','=','aktif')
                                             ->get();

        $countlist = count($listInsert);

    	if(Auth::user()->ROLE_ID == '4'){

            $showUnit  = DB::table('unit')->where('UNIT_ID','=',$unitAuth)
                                          ->whereNotIn('UNIT',['HRD','NON Unit'])->get();            

        }else if(Auth::user()->ROLE_ID == '6' || Auth::user()->ROLE_ID == '7'){

            if(Auth::user()->ROLE_ID == '6'){

                $showUnit = DB::table('unit')->whereIn('UNIT',['BIM','ERP'])->get();

            }else{

                $showUnit = DB::table('unit')->whereIn('UNIT',['BILLING','EAI'])->get();

            }

        }else if(Auth::user()->ROLE_ID == '3'){

            $showUnit = DB::table('unit')->where('UNIT_ID','=',$unitAuth)->get();

        }else{

            $showUnit = DB::table('unit')->whereNotIn('UNIT',['HRD','NON Unit'])->get();            
        }
    	
    	return view('asman',compact(['showUnit','bulan','tahun','roleasman','listInsert','countlist']));
    }

    public function getEmployeeFromUnit(Request $request){
        $idUnit  = $request->get('id');
        $empAuth = Auth::user()->EMPLOYEE_ID;
        
        if(Auth::user()->ROLE_ID == '4'){
        $data = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')
                                     ->where('UNIT_ID','=',$idUnit)
                                     ->where('EMPLOYEE_ID','=',$empAuth)
                                     ->get();}
        else{
        $data = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')
                                     ->where('UNIT_ID','=',$idUnit)
                                     ->get();}

        return response()->json($data);
    }

    public function getEmployeeFromUnit1(Request $request){
        
        $idUnit = $request->get('id');
        $nameAuth = Auth::user()->EMPLOYEE_NAME;

        $data = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')                                   
                                    ->where('UNIT_ID','=',$idUnit)
                                    ->where('EMPLOYEE_NAME','!=',$nameAuth)
                                    ->get();

        return response()->json($data);
    }

    public function filter_asman(Request $request){
    	
        $idEmployee = $request->get('nama');
    	$idBulan    = $request->get('bulan');
    	$idTahun    = $request->get('tahun');
        $idRole     = $request->get('role');

    	$resultasman = DB::select("call spView('$idEmployee','$idBulan','$idTahun','$idRole')");
    	$data ['content'] = $resultasman;
        
        return json_encode($data);
    }

    public function insert_asman(Request $request){
        
        $nama   = $request->get('nama');
        $bulan  = $request->get('bulan');
        $tahun  = $request->get('tahun');
        $role   = $request->get('role');
        $kritik = $request->get('kritik');
        $total  = $request->get('total');        
        $list   = $request->get('list_bobot');
        

        $compareDB =  DB::table('penilaian')
                        ->select('EMPLOYEE_ID','BULAN_ID','TAHUN_ID','ROLE_ID')
                        ->where('EMPLOYEE_ID','=',$nama)
                        ->where('BULAN_ID','=',$bulan)    
                        ->where('TAHUN_ID','=',$tahun)    
                        ->where('ROLE_ID','=',$role)                                
                        ->get();

        $cekKosongDB = json_decode($compareDB);

        if($cekKosongDB == []){

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

        }else{

            $msg['msg'] = 'Data is already available!';

        }  
       
        return json_encode($msg);
    }
}