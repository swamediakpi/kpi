<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;


class globalController extends Controller
{
	public function delete_penilaian(Request $request){
		$hasil_id = $request->get('nilai_id');
		//$updateArr = array('bobot' => $bobot);
		//dd($updateArr);
		$compareDB =  DB::select("call spDeleteNilai('$hasil_id')");
		$msg['msg'] = 'Delete Sucses';
		return json_encode($msg);
	}
	public function getEmployeeFromUnit1(Request $request){

        $nameAuth = Auth::user()->EMPLOYEE_NAME;
        $idUnit = $request->get('id');


        $data = DB::select('call spGetEmployeeFromUnit('.$idUnit.')');

        return response()->json($data);                                                      
    }

}