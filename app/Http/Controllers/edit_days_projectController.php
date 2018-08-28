<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_days_projectController extends Controller
{
    public function showElement(){
        $listproject = DB::select('call spgetproject');

        return view('edit_days_project',compact('listproject'));
    }

    public function getEmployee(Request $request){
        $idProject = $request->get('id');

        $data = DB::select('call spEmployeeFromProject('.$idProject.')');

        return response()->json($data);
    }

    public function insert_forget_start(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $startdate  = $request->get('startdate');

        DB::raw("call spInsertDaysProject_forget('".$prdetailID."', '".$empid."', 0, '".$startdate."')");


        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }

    public function insert_forget_pause(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $pausedate  = $request->get('pausedate');

        DB::raw("call spInsertDaysProject_forget('".$prdetailID."', '".$empid."', 1, '".$pausedate."')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }

     public function insert_forget_stop(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $stopdate  = $request->get('stopdate');

        DB::raw("call spInsertDaysProject_forget('".$prdetailID."', '".$empid."', 2, '".$stopdate."')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }        

}


?>