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

        $data = DB::table('project_detail')->select('PROJECT_DETAIL_ID','PROJECT_NAME')
                                    ->where('UNIT_ID','=',$idUnit)
                                    ->orderBy('PROJECT_NAME','asc')
                                    ->get();

        return response()->json($data);
    }

    public function getEmpFromPrjct(Request $request){
        $id_prjct = $request->get('id');

        $data = DB::table('employee')->select('employee.EMPLOYEE_ID','EMPLOYEE_NAME')
                            ->join('project','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                            ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                            ->groupBy('EMPLOYEE_NAME')
                            ->where('project_detail.PROJECT_DETAIL_ID','=',$id_prjct)
                            ->where('END_WORK','=',null)                            
                            ->get();

        return response()->json($data);
    }

    public function getStrDateFromEmp(Request $request){
        $id_emp = $request->get('id');
        $prjct_id = $request->get('prjct_id');

        $data = DB::table('project')->select('START_WORK')                            
                            ->where('EMPLOYEE_ID','=',$id_emp)
                            ->where('PROJECT_DETAIL_ID','=',$prjct_id)
                            ->get();            

        return response()->json($data);        
    }

    public function filter_prjct(Request $request){
    	$prjct_id   = $request->get('prjct_id');
        $emp_id   = $request->get('emp_id');
        $strdate  = $request->get('strdate');
    	
		$dataPrjct = DB::table('employee')
                        ->select('employee.EMPLOYEE_ID','project_detail.project_detail_id','employee.EMPLOYEE_NAME','project_name','project_role_emp','START_WORK','END_WORK','WORK_DURATION','project.PROJECT_ID')
                        ->join('project','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                        ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                        ->join('list_project_role','list_project_role.LIST_PROJECT_ROLE_ID','=','project.LIST_PROJECT_ROLE_ID')                        
                        ->where('employee.EMPLOYEE_ID','=',$emp_id)
                        ->where('project.PROJECT_DETAIL_ID','=',$prjct_id)
                        ->where('END_WORK','=',null)
                        ->where('START_WORK','=',$strdate)
                        ->get();

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