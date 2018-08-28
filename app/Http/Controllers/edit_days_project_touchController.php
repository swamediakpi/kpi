<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_days_project_touchController  extends Controller
{
	public function showElement(){
        $listproject = DB::select('call spgetproject');;

        return view('edit_days_project_touch',compact('listproject'));
    }

    public function getEmployee_touch(Request $request){
        $idProject = $request->get('id');

        $data = DB::select('call spEmployeeFromProject('.$idProject.')');;

        return response()->json($data);
    }

    public function getTimelapsStart(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        
        $data = DB::select("call spGetschedule('".$emp_id."', '".$pd_id."', '0')");

        return response()->json($data);                        
    }


    public function delete_touch_start(Request $request){        
        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $startdate = $request->get('startdate');

        $query = DB::raw("call spDELETEschedule('".$emp_id."', '".$pd_id."', '0', '".$startdate."')");

         $msg['msg'] = 'Success Update';
         return json_encode($msg);
    }

    public function getTimelapsPause(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        
        $data = DB::select("call spGetschedule('".$emp_id."', '".$pd_id."', '1')");

        return response()->json($data);                        
    }


    public function delete_touch_pause(Request $request){        
        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $pausedate = $request->get('pausedate');

        $query = DB::raw("call spDELETEschedule('".$emp_id."', '".$pd_id."', '1', '".$pausedate."')");
         $msg['msg'] = 'Success Update';
         return json_encode($msg);
    }

    public function getTimelapsStop(Request $request){
        $pd_id  = $request->get('pd_id');
        $emp_id = $request->get('emp_id');
        $data = DB::select("call spGetschedule('".$emp_id."', '".$pd_id."', '2')");
        return response()->json($data);                        
    }


    public function delete_touch_stop(Request $request){

        $pd_id     = $request->get('pd_id');
        $emp_id    = $request->get('emp_id');
        $stopdate  = $request->get('stopdate');

        $query = DB::raw("call spDELETEschedule('".$emp_id."', '".$pd_id."', '2', '".$stopdate."')");


        $msg['msg'] = 'Success Update';
        return json_encode($msg);
    }

}


?>