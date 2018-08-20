<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_days_project_touchController  extends Controller
{
	public function showElement(){
        $listproject = DB::table('project_detail')->select('PROJECT_DETAIL_ID','PROJECT_NAME')
                                                  ->orderBy('PROJECT_NAME','asc')
                                                  ->get();

        return view('edit_days_project_touch',compact('listproject'));
    }

    public function getEmployee_touch(Request $request){
        $idProject = $request->get('id');

        $data = DB::table('employee')->select('employee.EMPLOYEE_ID','EMPLOYEE_NAME')
                                    ->join('project','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                                    ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                                    ->where('project_detail.PROJECT_DETAIL_ID','=',$idProject)
                                    ->orderBy('EMPLOYEE_NAME','asc')
                                    ->get();

        return response()->json($data);
    }

    public function getTimelapsStart(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        

        // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARI TIMELAPS DAN PROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('TIMELAPS')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',0)
                                     ->get();

        return response()->json($data);                        
    }


    public function delete_touch_start(Request $request){        
        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $startdate = $request->get('startdate');

         // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARIvPROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('PROJECT_ID')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',0)
                                     ->get();
        $getdataID = json_encode($data[0]->PROJECT_ID);                                     

        $query = DB::table('schedule')->where('PROJECT_ID','=',$getdataID)
                                      ->where('STATUS','=',0)
                                      ->where('TIMELAPS','=',$startdate)                                    
                                      ->delete();

         $msg['msg'] = 'Success Update';
         return json_encode($msg);
    }

    public function getTimelapsPause(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        

        // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARI TIMELAPS DAN PROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('TIMELAPS')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',1)
                                     ->get();

        return response()->json($data);                        
    }


    public function delete_touch_pause(Request $request){        
        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $pausedate = $request->get('pausedate');

         // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARIvPROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('PROJECT_ID')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',1)
                                     ->get();
        $getdataID = json_encode($data[0]->PROJECT_ID);                                     

        $query = DB::table('schedule')->where('PROJECT_ID','=',$getdataID)
                                      ->where('STATUS','=',1)
                                      ->where('TIMELAPS','=',$pausedate)                                    
                                      ->delete();

         $msg['msg'] = 'Success Update';
         return json_encode($msg);
    }

    public function getTimelapsStop(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        

        // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARI TIMELAPS DAN PROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('TIMELAPS')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',2)
                                     ->get();

        return response()->json($data);                        
    }


    public function delete_touch_stop(Request $request){

        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $stopdate  = $request->get('stopdate');

         // UNTUK MENCARI PROJECTID DARI TABLE PROJECT
        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$emp_id)
                                            ->where('PROJECT_DETAIL_ID','=',$pd_id)
                                            ->get();        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);


        // UNTUK MENCARIvPROJECTID DARI TABLE SCHEDULE
        $data = DB::table('schedule')->select('PROJECT_ID')                                   
                                     ->where('PROJECT_ID','=',$getID)                                     
                                     ->where('STATUS','=',2)
                                     ->get();
        $getdataID = json_encode($data[0]->PROJECT_ID);                                     

        $query = DB::table('schedule')->where('PROJECT_ID','=',$getdataID)
                                      ->where('STATUS','=',2)
                                      ->where('TIMELAPS','=',$stopdate)                                    
                                      ->delete();

        $msg['msg'] = 'Success Update';
        return json_encode($msg);
    }

}


?>