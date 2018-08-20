<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class edit_days_projectController extends Controller
{
    public function showElement(){
        $listproject = DB::table('project_detail')->select('PROJECT_DETAIL_ID','PROJECT_NAME')
                                                  ->orderBy('PROJECT_NAME','asc')
                                                  ->get();

        return view('edit_days_project',compact('listproject'));
    }

    public function getEmployee(Request $request){
        $idProject = $request->get('id');

        $data = DB::table('employee')->select('employee.EMPLOYEE_ID','EMPLOYEE_NAME')
                                    ->join('project','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                                    ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                                    ->where('project_detail.PROJECT_DETAIL_ID','=',$idProject)
                                    ->orderBy('EMPLOYEE_NAME','asc')
                                    ->get();

        return response()->json($data);
    }

    public function insert_forget_start(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $startdate  = $request->get('startdate');

        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$empid)
                                            ->where('PROJECT_DETAIL_ID','=',$prdetailID)
                                            ->get();
        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);
        $insertSch = array('PROJECT_ID' => $getID, 'STATUS' => 0, 'TIMELAPS' => $startdate);

        DB::table('schedule')->insert($insertSch);

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }

    public function insert_forget_pause(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $pausedate  = $request->get('pausedate');

        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$empid)
                                            ->where('PROJECT_DETAIL_ID','=',$prdetailID)
                                            ->get();
        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);
        $insertSch = array('PROJECT_ID' => $getID, 'STATUS' => 1, 'TIMELAPS' => $pausedate);

        DB::table('schedule')->insert($insertSch);

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }

     public function insert_forget_stop(Request $request){

        $prdetailID = $request->get('projectid');
        $empid      = $request->get('empid');
        $stopdate  = $request->get('stopdate');

        $getProjectID = DB::table('project')->select('PROJECT_ID')
                                            ->where('EMPLOYEE_ID','=',$empid)
                                            ->where('PROJECT_DETAIL_ID','=',$prdetailID)
                                            ->get();
        
        $getID = json_encode($getProjectID[0]->PROJECT_ID);
        $insertSch = array('PROJECT_ID' => $getID, 'STATUS' => 2, 'TIMELAPS' => $stopdate);

        DB::table('schedule')->insert($insertSch);

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }        

}


?>