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
        $listInsert = DB::select('call splistinsertheader_kpi(3)'); 

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
        
        if(Auth::user()->ROLE_ID == '3'){
        $data = DB::select('call spGetEmployeeFromUnitLogin('.$empAuth.')');}
        else{
        $data = DB::select('call spGetEmployeeFromUnit('.$idUnit.')');}
        return response()->json($data);                                                      

        return response()->json($data);
    }

    public function getEmployeeFromUnit1(Request $request){
        
        $idUnit = $request->get('id');
        $nameAuth = Auth::user()->EMPLOYEE_NAME;

        $data = DB::select('call spGetEmployeeFromUnit('.$idUnit.')');

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
        

        $compareDB =  DB::select("call spcompareDBinserheader_kpi('$nama', '$bulan', '$tahun', '$role')");

        if($compareDB == null){
            DB::select("call spinsertpenilaiankpi('".$nama."', '".$bulan."', '".$tahun."', '".$role."', '".$kritik."', '".$total."')");

            $b = DB::table('penilaian')->select('PENILAIAN_ID')
                                       ->orderby('PENILAIAN_ID','DESC')                                      
                                       ->take(1)
                                       ->get();

            $getLastID = json_encode($b[0]->PENILAIAN_ID);

            if (is_array($list) || is_object($list)){                                 
                foreach ($list as $key) {
                    $listid = $key['list_id'];
                    $bobot = $key['bobot'];
                    DB::select("call spinsertpenilaian_hasil_kinerja('".$getLastID."', '".$listid."', '".$bobot."')");
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