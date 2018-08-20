<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class edit_projectController extends Controller
{
	public function showElement(){

		$showUnit = DB::table('unit')->get();

		return view("edit_project",compact(["showUnit"]));
	}
	public function getProjectFromUnit(Request $request){

		$idUnit = $request->get('id');

        $data = DB::table('project_detail')->select('PROJECT_DETAIL_ID','PROJECT_NAME')
                                    ->where('UNIT_ID','=',$idUnit)
                                    ->get();

        return response()->json($data);
	}
	
	public function filter_prjct(Request $request){
		
		$prjct_id = $request->get('prjct_detail_id');
		$unit_id  = $request->get('unit');

		$dataPrjct = DB::table('project_detail')
			->select('project_detail_id','project_name','project_start','project_end','project_duration')
			->where('UNIT_ID','=',$unit_id)
			->where('PROJECT_DETAIL_ID','=',$prjct_id)
			->get();

		$data ['content'] = $dataPrjct;

		return json_encode($data);
	}

	public function update_prjct(Request $request){

		$prjct_id = $request->get('prjct_id');
		$start    = $request->get('start');
		$finish   = $request->get('finish');
		$duration = $request->get('duration');
		
		$updateArr = array('PROJECT_START' => $start,'PROJECT_END' => $finish,'PROJECT_DURATION' => $duration);
		
		DB::table('project_detail')
            ->where('PROJECT_DETAIL_ID', $prjct_id)
            ->update($updateArr);            

		$msg['msg'] = 'Success Update';

		return json_encode($msg);
	}


}