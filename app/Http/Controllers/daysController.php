<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class daysController extends Controller
{
    public function showData(){
        
        $nameAuth = Auth::user()->EMPLOYEE_ID;
        $id_unit = Auth::user()->UNIT_ID;

        // $data = DB::table('project')
        //                 ->select('project_role_emp','project_name','WORK_DURATION')
        //                 ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
        //                 ->join('list_project_role','list_project_role.LIST_PROJECT_ROLE_ID','=','project.LIST_PROJECT_ROLE_ID')
        //                 ->join('employee','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
        //                 ->where('employee.employee_id','=',$nameAuth)
        //                 ->get();

        // $data1 = DB::table('project')
        //                 ->select(DB::raw('SUM(WORK_DURATION) as TOTAL'))
        //                 ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
        //                 ->join('list_project_role','list_project_role.LIST_PROJECT_ROLE_ID','=','project.LIST_PROJECT_ROLE_ID')
        //                 ->join('employee','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
        //                 ->where('employee.employee_id','=',$nameAuth)
        //                 ->get();

        // $dataPekerjaan = DB::table('project_detail')
        //                          ->select(DB::raw('COUNT(project_detail.project_detail_id) as total_prjct'))
        //                          ->join('project','project.project_detail_id','=','project_detail.project_detail_id')
        //                          ->join('employee','employee.employee_id','project.employee_id')
        //                          ->where('employee.employee_id','=',$nameAuth)
        //                          ->where(DB::raw('YEAR(start_work)'),'=','2017')
        //                          ->get();

        // $totalDays = DB::table('list_project_role')
        //                                 ->select('project_role_emp',DB::raw('SUM(work_duration) as tot_kerja'))
        //                                 ->join('project','project.list_project_role_id','=','list_project_role.list_project_role_id')
        //                                 ->join('employee','employee.employee_id','project.employee_id')
        //                                 ->where('employee.employee_id','=',$nameAuth)
        //                                 ->groupBy('project_role_emp')
        //                                 ->get();
        
        // $finalDays = DB::select("call spFinalDays('$nameAuth')");
        // $fixDays   = DB::select("call spGetScoreDays('$nameAuth')");

        if(Auth::user()->ROLE_ID == '1' || Auth::user()->ROLE_ID == '2' || Auth::user()->ROLE_ID == '5' || Auth::user()->ROLE_ID == '8')
        {
            $showUnit = DB::table('unit')->whereNotIn('UNIT',['HRD','NON Unit'])
                                         ->get();

        }else if(Auth::user()->ROLE_ID == '3'){

            $showUnit = DB::table('unit')->where('UNIT_ID','=',$id_unit)
                                         ->whereNotIn('UNIT',['HRD','NON Unit'])
                                         ->get();

        }else if(Auth::user()->ROLE_ID == '6' || Auth::user()->ROLE_ID == '7'){

            if(Auth::user()->ROLE_ID == '6'){

                $showUnit = DB::table('unit')->whereIn('UNIT_ID', array(1,3))
                                             ->get();
            }else{

                $showUnit = DB::table('unit')->whereIn('UNIT_ID', array(2,4))
                                             ->get();
            }
            
        }

        return view('days',compact(['showUnit']));//'data','data1','dataPekerjaan','totalDays','finalDays','fixDays'
    }

    public function getEmployeeFromUnit(Request $request){
        $idUnit = $request->get('id');

        $data = DB::table('employee')->select('EMPLOYEE_ID','EMPLOYEE_NAME')                                    
                                    ->where('UNIT_ID','=',$idUnit)
                                    ->whereNotIn('EMPLOYEE_NAME',['admin'])
                                    ->get();

        return response()->json($data);
    }

    public function filter_days_emp(Request $request){

        $emp_id   = Auth::user()->EMPLOYEE_ID;
        $year     = $request->get('year');
        
        $dataDays = DB::table('project')
                        ->select('project_role_emp','project_name','WORK_DURATION')
                        ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                        ->join('list_project_role','list_project_role.LIST_PROJECT_ROLE_ID','=','project.LIST_PROJECT_ROLE_ID')
                        ->join('employee','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                        ->where('employee.EMPLOYEE_ID','=',$emp_id)
                        ->get();

        $countWD = DB::table('project')->select(DB::raw('SUM(WORK_DURATION) as tot_WD'))
                                      ->where('employee_id','=',$emp_id)
                                      ->get();

        $dataPekerjaan = DB::table('project_detail')
                                 ->select(DB::raw('COUNT(project_detail.project_detail_id) as total_prjct'))
                                 ->join('project','project.project_detail_id','=','project_detail.project_detail_id')
                                 ->join('employee','employee.employee_id','project.employee_id')
                                 ->where('employee.employee_id','=',$emp_id)
                                 ->where(DB::raw('YEAR(start_work)'),'=','2017')
                                 ->get();

        $totalDays = DB::table('list_project_role')
                                        ->select('project_role_emp',DB::raw('SUM(work_duration) as tot_kerja'))
                                        ->join('project','project.list_project_role_id','=','list_project_role.list_project_role_id')
                                        ->join('employee','employee.employee_id','project.employee_id')
                                        ->where('employee.employee_id','=',$emp_id)
                                        ->groupBy('project_role_emp')
                                        ->get();
        
        $finalDays = DB::select("call spFinalDays('$emp_id','$year')");
        $fixDays   = DB::select("call spGetScoreDays('$emp_id','$year')");         

        
        $data ['content']      = $dataDays;
        $data ['contentdua']   = $dataPekerjaan;
        $data ['contenttiga']  = $totalDays;
        $data ['contentempat'] = $countWD;
        $data ['contentlima']  = $finalDays;
        $data ['contentenam']  = $fixDays;

        return json_encode($data);

    }

    public function filter_days(Request $request){
        
        $emp_id   = $request->get('emp_id');
        $year     = $request->get('year');
        
        $dataDays = DB::table('project')
                        ->select('project_role_emp','project_name','WORK_DURATION')
                        ->join('project_detail','project.PROJECT_DETAIL_ID','=','project_detail.PROJECT_DETAIL_ID')
                        ->join('list_project_role','list_project_role.LIST_PROJECT_ROLE_ID','=','project.LIST_PROJECT_ROLE_ID')
                        ->join('employee','employee.EMPLOYEE_ID','=','project.EMPLOYEE_ID')
                        ->where('employee.EMPLOYEE_ID','=',$emp_id)
                        ->get();

        $countWD = DB::table('project')->select(DB::raw('SUM(WORK_DURATION) as tot_WD'))
                                      ->where('employee_id','=',$emp_id)
                                      ->get();

        $dataPekerjaan = DB::table('project_detail')
                                 ->select(DB::raw('COUNT(project_detail.project_detail_id) as total_prjct'))
                                 ->join('project','project.project_detail_id','=','project_detail.project_detail_id')
                                 ->join('employee','employee.employee_id','project.employee_id')
                                 ->where('employee.employee_id','=',$emp_id)
                                 ->where(DB::raw('YEAR(start_work)'),'=','2017')
                                 ->get();

        $totalDays = DB::table('list_project_role')
                                        ->select('project_role_emp',DB::raw('SUM(work_duration) as tot_kerja'))
                                        ->join('project','project.list_project_role_id','=','list_project_role.list_project_role_id')
                                        ->join('employee','employee.employee_id','project.employee_id')
                                        ->where('employee.employee_id','=',$emp_id)
                                        ->groupBy('project_role_emp')
                                        ->get();
        
        $finalDays = DB::select("call spFinalDays('$emp_id','$year')");
        $fixDays   = DB::select("call spGetScoreDays('$emp_id','$year')");         

        
        $data ['content']      = $dataDays;
        $data ['contentdua']   = $dataPekerjaan;
        $data ['contenttiga']  = $totalDays;
        $data ['contentempat'] = $countWD;
        $data ['contentlima']  = $finalDays;
        $data ['contentenam']  = $fixDays;

        return json_encode($data);
    }

}