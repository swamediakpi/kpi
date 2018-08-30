<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Image;

class indexController extends Controller {
	public function showElement(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_NAME;
		$tahun = DB::table('t_tahun')->get();
		Auth::user()->dashboard = 1;

		return view('index',compact(['EmployeeName', 'tahun']));
	}

	public function showElementyf(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_ID;
		Auth::user()->dashboard = 2; 
		$result = DB::table('employee')->where('employee.EMPLOYEE_ID','=',$nameAuth)
							->get();

		return view('index',compact(['yfAUTH','nameAuth','result']));
	}
	
	public function photo(Request $request){
	   if($request->hasFile('avatar')){
			$avatar   = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300,300)->save(public_path('/avatars/' . $filename));

			$user = Auth::user();
			$user->avatar = $filename;
			$user->save(); 
		}
		
		return view('index');
	}
	
	public function Graf_Emp(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_ID;
		$projectname = $request->get('nama');
		if($roleAuth == '4'){
			
			$result = DB::table('project_employee')->join('employee','project_employee.EMPLOYEE_ID','=','employee.EMPLOYEE_ID')
							->join('project','project_employee.PROJECT_DETAIL_ID','=','project.PROJECT_DETAIL_ID')
							->select('EMPLOYEE_NAME',DB::raw('SUM(WORK_DURATION) AS WORK_DURATION'),'PROJECT_DURATION')
							->where('project_employee.PROJECT_DETAIL_ID','=',$projectname)
							->where('employee.EMPLOYEE_ID','=',$nameAuth)
							->groupBy('EMPLOYEE_NAME')
							->get();
		}else{
			$result =	DB::table('project_employee')->join('employee','project_employee.EMPLOYEE_ID','=','employee.EMPLOYEE_ID')
							->join('project','project_employee.PROJECT_DETAIL_ID','=','project.PROJECT_DETAIL_ID')  
							->select('EMPLOYEE_NAME', DB::raw('SUM(WORK_DURATION) AS WORK_DURATION'),'PROJECT_DURATION')
							->where('project.PROJECT_DETAIL_ID','=',$projectname)
							->groupBy('EMPLOYEE_NAME')
							->get();
		}
				
		return json_encode($result);
	}

	public function Graf_Evo(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_NAME;
		$pr_tahun = $request->get('p_tahun');
		if($request -> ajax()){
			if($roleAuth == '4'){
				$temp =	DB::table('project')->select('PROJECT_NAME','PROJECT_DURATION','WORK_DURATION',DB::raw('IFNULL( REALIZE_TIME, 0 ) as realize_time') )
							->join('project','project_detail.PROJECT_DETAIL_ID','=','project_employee.PROJECT_DETAIL_ID')
							->join('employee','project_employee.EMPLOYEE_ID','=','employee.EMPLOYEE_ID')
							->where('employee.EMPLOYEE_NAME','=',$nameAuth)
							->whereYear('PROJECT_START','=',$pr_tahun)
							->groupBy('PROJECT_NAME')
							->get();
			}else{
				$temp =	DB::table('project')
							->join('project_employee','project.PROJECT_DETAIL_ID','=','project_employee.PROJECT_DETAIL_ID')
							->select('PROJECT_NAME','PROJECT_DURATION', DB::raw('AVG(WORK_DURATION) AS WORK_DURATION'),DB::raw('IFNULL( REALIZE_TIME, 0 ) as realize_time'))
							->whereYear('PROJECT_START','=',$pr_tahun)
							->groupBy('PROJECT_NAME','PROJECT_DURATION')
							->get();
			}
			$x = json_encode($temp);
			return $x;
		}
	}

	public function Graf_Mnd(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_NAME;
		$pr_tahun = $request->get('p_tahun');
		if($request -> ajax()){
			if($roleAuth == '4'){
				$temp = DB::table('project')->select('PROJECT_NAME','PROJECT_DURATION')
							->join('project_employee','project.PROJECT_DETAIL_ID','=','project_employee.PROJECT_DETAIL_ID')
							->join('employee','project_employee.EMPLOYEE_ID','=','employee.EMPLOYEE_ID')
							->where('employee.EMPLOYEE_NAME','=',$nameAuth)
							->whereYear('PROJECT_START','=',$pr_tahun)
							->groupBy('PROJECT_NAME')
							->get();
			}else{
				$temp = DB::table('project')->select('PROJECT_NAME','PROJECT_DURATION')
							->whereYear('PROJECT_START','LIKE',$pr_tahun)   
							->get();
			}
			$x = json_encode($temp);
			return $x;
		}
	}

	public function showProjectbyYear(Request $request){
		$roleAuth = Auth::user()->ROLE_ID;
		$nameAuth = Auth::user()->EMPLOYEE_NAME;
		$pr_tahun = $request->get('p_tahun');
		if($roleAuth == '4'){
			$projectname =	DB::table('project')->select('PROJECT_NAME','project_detail.PROJECT_DETAIL_ID')
								->join('project_employee','project.PROJECT_DETAIL_ID','=','project_employee.PROJECT_DETAIL_ID')
								->join('employee','project_employee.EMPLOYEE_ID','=','employee.EMPLOYEE_ID')
								->where('employee.EMPLOYEE_NAME','=',$nameAuth)
								->whereYear('PROJECT_START','=',$pr_tahun)
								->groupBy('PROJECT_NAME')
								->get();
		}else{
			$projectname =	DB::table('project')->select('PROJECT_NAME','PROJECT_DETAIL_ID')
								->whereYear('PROJECT_START','=',$pr_tahun)
								->orderBy('PROJECT_NAME','asc')
								->get();
		}
		return response()->json($projectname);
	}
}