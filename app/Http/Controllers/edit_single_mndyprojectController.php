<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class edit_single_mndyprojectController extends Controller
{
	
	public function showElement(){

		$showUnit = DB::table('unit')->get();

		return view('edit_single_mndyproject',compact('showUnit'));
	}
	public function getProjectFromUnit(Request $request){
        
        $idUnit = $request->get('id');

        $data = DB::select("call spgetProjectfromunit('".$idUnit."')");

        return response()->json($data);
    }

    public function getEmpFromPrjct(Request $request){
        $id_prjct = $request->get('id');

        $data = DB::select("call spEmployeeFromProject('".$id_prjct."')");

        return response()->json($data);
    }

    // public function getStrDateFromEmp(Request $request){
    //     $id_emp = $request->get('id');
    //     $prjct_id = $request->get('prjct_id');

    //     $data = DB::table('project_employee')->select('START_WORK')                            
    //                         ->where('EMPLOYEE_ID','=',$id_emp)
    //                         ->where('PROJECT_DETAIL_ID','=',$prjct_id)
    //                         ->get();            

    //     return response()->json($data);        
    // }

    public function filter_prjct(Request $request){
    	$prjct_id   = $request->get('prjct_id');
        $emp_id   = $request->get('emp_id');
    	
        $dataPrjct = DB::select("call spMandaysfilter_prjct('".$emp_id."', '".$prjct_id."')");
        $data ['content'] = $dataPrjct;
        
        return json_encode($data);
    }

    public function update_prjct(Request $request){

        $prjct_id = $request->get('prjct_id');
        $emp_id   = $request->get('emp_id');
        $start    = $request->get('start');
        $finish   = $request->get('finish');
        $duration = $request->get('duration');
        $PROJECT  = $request->get('PROJECT');
        
        $updateArr = array('START_WORK' => $start,'END_WORK' => $finish,'WORK_DURATION' => $duration);
        
        DB::table('project')
            ->where('PROJECT_ID', $PROJECT)
            ->update($updateArr);            

        $msg['msg'] = 'Success Update';

        return json_encode($msg);
    }

}