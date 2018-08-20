<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_given_pointController extends Controller
{
	public function showElement(){

        $areaHRD = DB::table('header_kpi')->join('kinerja','header_kpi.KINERJA_ID','=','kinerja.KINERJA_ID')
                                        ->join('kpi','header_kpi.KPI_ID','=','kpi.KPI_ID')
                                        ->join('role','header_kpi.ROLE_ID','=','role.ROLE_ID')
                                        ->where('header_kpi.ROLE_ID','=','1')
                                        ->get();

        $areaPMO = DB::table('header_kpi')->join('kinerja','header_kpi.KINERJA_ID','=','kinerja.KINERJA_ID')
                                        ->join('kpi','header_kpi.KPI_ID','=','kpi.KPI_ID')
                                        ->join('role','header_kpi.ROLE_ID','=','role.ROLE_ID')
                                        ->where('header_kpi.ROLE_ID','=','2')
                                        ->get();

        $areaUNIT = DB::table('header_kpi')->join('kinerja','header_kpi.KINERJA_ID','=','kinerja.KINERJA_ID')
                                        ->join('kpi','header_kpi.KPI_ID','=','kpi.KPI_ID')
                                        ->join('role','header_kpi.ROLE_ID','=','role.ROLE_ID')
                                        ->where('header_kpi.ROLE_ID','=','3')
                                        ->get();                                    
		
        return view('edit_given_point',compact(['areaHRD','areaPMO','areaUNIT']));
	}

    public function update(Request $request){

        $list = $request->get('list_final');

        if (is_array($list) || is_object($list)){ 
            foreach ($list as $key) {
                
                $listid = $key['list'];
                $status = $key['status'];

                DB::table('header_kpi')                                    
                                    ->where('LIST_ID',$listid)
                                    ->update(['STATUS'=>$status]);               
            }
            $msg['msg'] = 'Success Update';
        }

        return json_encode($msg);
    }
}


?>