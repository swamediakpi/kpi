<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class reportkpiController extends Controller
{
    public function showElement(Request $request){

        //$EmployeeName = DB::table('employee')->whereNotIn('EMPLOYEE_NAME',['admin'])->get();
        $unitAuth = Auth::user()->UNIT_ID;                                       
        $bulan = DB::table('t_bulan')->get();
        $tahun = DB::table('t_tahun')->get();
		$showTarget = DB::table('kpi_target')->get();	
        if(Auth::user()->ROLE_ID == '4'){

            $showUnit  = DB::table('unit')->where('UNIT_ID','=',$unitAuth)
                                          ->whereNotIn('UNIT',['HRD','NON Unit'])->get();            

        }else if(Auth::user()->ROLE_ID == '6' || Auth::user()->ROLE_ID == '7'){

            if(Auth::user()->ROLE_ID == '6'){

                $showUnit = DB::table('unit')->whereIn('UNIT',['BIM','ERP'])->get();

            }else{

                $showUnit = DB::table('unit')->whereIn('UNIT',['BILLING','EAI'])->get();

            }

        }else if(Auth::user()->ROLE_ID == '3'){

            $showUnit = DB::table('unit')->where('UNIT_ID','=',$unitAuth)->get();

        }else{

            $showUnit = DB::table('unit')->whereNotIn('UNIT',['HRD','NON Unit'])->get();            
        }

        return view('reportkpi',compact(['showUnit','bulan','tahun','showTarget']));
    }

    public function filter_report(Request $request){
        
        $idBulan = $request->get('bulan');
        $idTahun = $request->get('tahun');
        $idEmployee = $request->get('nama');

        $result     = DB::select("call spViewReportNew('$idBulan','$idTahun','$idEmployee')");
        
        if($idTahun == '1'){

            $idTahun = '2017';
        }else if($idTahun == '2'){

            $idTahun = '2018';
        }else if($idTahun == '3'){

            $idTahun = '2019';
        }else if($idTahun == '4'){

            $idTahun = '2020';
        }else{
            $idTahun = '2021';
        }

        
        $resultdays = DB::select("call spGetScoreDaysReporting('".$idEmployee."','".$idTahun."')");

        $data ['content'] = $result;
        $data ['contentdays'] = $resultdays;        
        
        return json_encode($data);
    }

    public function getEmployeeFromUnit(Request $request){
        
        $idUnit  = $request->get('id');
        $empAuth = Auth::user()->EMPLOYEE_ID;
        		$tahun = date('Y');

        if(Auth::user()->ROLE_ID == '4'){
        $data = DB::select('call spGetEmployeeFromUnitLogin('.$empAuth.')');}
        else{
        $data = DB::select("call spGetEmployeeFromUnit('".$idUnit."','".$tahun."')");
		}

        return response()->json($data);
    }

}