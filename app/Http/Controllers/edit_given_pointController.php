<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_given_pointController extends Controller
{
	public function showElement(){

        $areaHRD = DB::select("call splistinsertheader_kpi('1')");

        $areaPMO = DB::select("call splistinsertheader_kpi('2')");

        $areaUNIT = DB::select("call splistinsertheader_kpi('3')");                                    
		
        return view('edit_given_point',compact(['areaHRD','areaPMO','areaUNIT']));
	}

    public function update(Request $request){

        $list = $request->get('list_final');

        if (is_array($list) || is_object($list)){ 
            foreach ($list as $key) {
                
                $listid = $key['list'];
                $status = $key['status'];

                DB::raw("call spupdateheader_kpi('".$listid."', '".$status."')");               
            }
            $msg['msg'] = 'Success Update';
        }

        return json_encode($msg);
    }
}


?>