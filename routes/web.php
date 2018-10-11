<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
	Route::get('/days_project','daysProjectController@showElement');
	Route::post('/days_project/input','daysProjectController@insert_project');
	Route::post('/mandays/search','daysProjectController@search_mandays');
	Route::post('/days_project/action','daysProjectController@action');
	Route::post('/days_project/getMandays','daysProjectController@getMandays');
	Route::get('/history/{project_id}/{last_status}','daysProjectController@history');
	Route::get('getjbtn','daysProjectController@getJabatan');
	Route::get('getInfoProjek','daysProjectController@getInfoProjek');

	Route::get('/newcase','newcaseController@showElement');
	Route::post('/newcase/search','newcaseController@getEmpPrjct');
	Route::post('/newcase/input','newcaseController@insert_Prjct');

	Route::get('/hrd','hrdController@showElement');
	Route::get('getEmployeeFromUnithrd','hrdController@getEmployeeFromUnit');
	Route::get('getEmployeeFromUnit1hrd','hrdController@getEmployeeFromUnit1');	
	Route::post('/hrd/search','hrdController@filter_hrd');
	Route::post('/hrd/input','hrdController@insert_hrd');	
	Route::post('/hrd/update','hrdController@update_hr_nilai');
	Route::post('/hrd/delete','holidayController@delete_holiday');

	Route::get('/asman','asmanController@showElement');
	Route::get('getEmployeeFromUnitasman','asmanController@getEmployeeFromUnit');
	Route::get('getEmployeeFromUnit1asman','asmanController@getEmployeeFromUnit1');
	Route::post('/asman/search','asmanController@filter_asman');
	Route::post('/asman/input','asmanController@insert_asman');
	Route::post('/asman/update','asmanController@update_asman_nilai');
	Route::post('/asman/delete','holidayController@delete_asman');

	Route::get('/pmo','pmoController@showElement');
	Route::get('getEmployeeFromUnitpmo','pmoController@getEmployeeFromUnit');
	Route::get('getEmployeeFromUnit1pmo','pmoController@getEmployeeFromUnit1');
	Route::post('/pmo/search','pmoController@filter_pmo');
	Route::post('/pmo/input','pmoController@insert_pmo');	
	Route::post('/pmo/update','pmoController@update_pmo_nilai');

	Route::get('/pl','plController@showElement');
	Route::post('/pl/search','plController@filter_pl');
	Route::post('/pl/input','plController@insert_pl');

	Route::get('/input_emp','input_empController@showRoleUnit');
	Route::post('/input_emp/input','input_empController@insert_emp');
	
	Route::post('/integrasi/input','integrasiController@insert_emp');
	Route::get('/integrasi/update_data','integrasiController@update_data');
	Route::get('/integrasi/cek','integrasiController@cek_data');
	Route::get('/get/emp','integrasiController@getemp');
	Route::get('/integrasi','integrasiController@showRoleUnit'); 
	Route::get('/get/api','integrasiController@getapi');
	Route::get('/integrasi/updateAPI','integrasiController@updateAPI');

	Route::get('/view_emp','view_empController@showElement');
	Route::post('/view_emp/search','view_empController@filter_emp');

	Route::get('/index','indexController@showElement');
	Route::get('/index/yf','indexController@showElementyf');
	Route::get('/index/dashboard2','indexController@showElement2');
	Route::post('/indexphoto','indexController@photo');
	Route::get('getProjectFromYear','indexController@showProjectbyYear');
	Route::post('/index/GrafMnd','indexController@Graf_Mnd');
	Route::post('/index/GrafEmp','indexController@Graf_Emp');
	Route::post('/index/GrafEvo','indexController@Graf_Evo');	
	
	Route::get('/reportkpi','reportkpiController@showElement');
	Route::post('/reportkpi/search','reportkpiController@filter_report');
	Route::get('getEmployeeFromUnitreport','reportkpiController@getEmployeeFromUnit');
	
	Route::get('/days','daysController@showData');
	Route::post('/days/search','daysController@filter_days');
	Route::post('/days-emp/search','daysController@filter_days_emp');
	Route::get('getEmployeeFromUnit','daysController@getEmployeeFromUnit');

	Route::any('/edit_employee','edit_employeeController@showRoleUnit');
	Route::any('/edit_employee/edit','edit_employeeController@edit_employee');
	Route::any('/for/unit','view_empController@forunit');

	Route::get('/absensi','absensiController@showData');
	Route::post('/absensi/search','absensiController@filter_absensi');
	Route::get('getEmployeeFromUnit','absensiController@getEmployeeFromUnit');

	Route::get('/pmis',function() {
		return view('pmis');
	});

	Route::get('/holiday','holidayController@show');
	Route::get('getHoliday','holidayController@getholiday');
	Route::post('/holiday/input','holidayController@input_holiday');
	Route::post('/holiday/update','holidayController@update_holiday');
	Route::post('/holiday/delete','holidayController@delete_holiday');
	Route::post('/holiday/filter','holidayController@filter_tahun_holiday');
	
	Route::get('/input_given_point','input_given_pointController@showAreaKinerja');
	Route::get('/input_given_point','input_given_pointController@showAreaKinerja');
  	Route::post('/givenpointhrd/input','input_given_pointController@inputAreaKinerjaHrd');
  	Route::post('/givenpointpmo/input','input_given_pointController@inputAreaKinerjaPmo');
  	Route::post('/givenpointunit/input','input_given_pointController@inputAreaKinerjaUnit');

	Route::get('/edit_given_point','edit_given_pointController@showElement');
	Route::post('/editGPHRD/update','edit_given_pointController@update');
	Route::post('/editGPPMO/update','edit_given_pointController@update');
	Route::post('/editGPUNIT/update','edit_given_pointController@update');
  	Route::post('/givenpoint/update','edit_given_pointController@update_value');
  	Route::post('/givenpoint/delete','edit_given_pointController@delete_value');

	Route::get('/edit_mandays_project','edit_mandays_projectController@showElement');
	Route::get('getProjectFromUnitEM','edit_mandays_projectController@getProjectFromUnit');
	Route::get('getEmpFromPrjct','edit_mandays_projectController@getEmpFromPrjct');
	Route::get('getStrDateFromEmp','edit_mandays_projectController@getStrDateFromEmp');
	Route::post('/editMandaysProject/view','edit_mandays_projectController@filter_prjct');
	Route::post('/editMandaysProject/update','edit_mandays_projectController@update_prjct');
	
	Route::get('/edit_single_mndyproject','edit_single_mndyprojectController@showElement');
	Route::get('getProjectFromUnit1','edit_single_mndyprojectController@getProjectFromUnit');
	Route::get('getEmpFromPrjct1','edit_single_mndyprojectController@getEmpFromPrjct');
	Route::get('getStrDateFromEmp1','edit_single_mndyprojectController@getStrDateFromEmp');
	Route::post('/edit_single_mndyproject/view','edit_single_mndyprojectController@filter_prjct');
	Route::post('/edit_single_mndyproject/update','edit_single_mndyprojectController@update_prjct');
	
	Route::get('/edit_project','edit_projectController@showElement');
	Route::get('getProjectFromUnit','edit_projectController@getProjectFromUnit');
	Route::post('/edit_project/view','edit_projectController@filter_prjct');
	Route::post('/edit_project/update','edit_projectController@update_prjct');
	
	Route::get('/project','projectController@showElement');
	Route::post('/project/input','projectController@insert_project');

	Route::get('/admin',function() { return view('admin');} );

	Route::get('/input_unit',function() { return view('input_unit');} );

	Route::get('/edit_days_project','edit_days_projectController@showElement');
	Route::get('getEmployee','edit_days_projectController@getEmployee');
	Route::post('/forgetstart/input','edit_days_projectController@insert_forget_start');
	Route::post('/forgetpause/input','edit_days_projectController@insert_forget_pause');
	Route::post('/forgetstop/input','edit_days_projectController@insert_forget_stop');

	Route::get('/edit_days_project_touch','edit_days_project_touchController@showElement');
	Route::get('getEmployee_touch','edit_days_project_touchController@getEmployee_touch');	
	Route::get('getTimelapsStart','edit_days_project_touchController@getTimelapsStart');
	Route::get('getTimelapsPause','edit_days_project_touchController@getTimelapsPause');
	Route::get('getTimelapsStop','edit_days_project_touchController@getTimelapsStop');
	Route::post('/touchstart/del','edit_days_project_touchController@delete_touch_start');
	Route::post('/touchpause/del','edit_days_project_touchController@delete_touch_pause');
	Route::post('/touchstop/del','edit_days_project_touchController@delete_touch_stop');
	Route::post('/penilaian/del','globalController@delete_penilaian');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
//Route::get('/api/test', ['middleware' => 'cros', function() {return "hello";}]);
Route::get('/api/test', function() {return "hello";});

Route::get('/obu', 'ObuPlnController@index');
Route::any('/getObuTotal', 'obuController@getObuTotal');
Route::any('/getOBUData', 'obuController@getOBUData');
Route::any('/getPercentData', 'obuController@getPercentData');

Route::get('/obu/yf', 'ObuPlnController@ObuYf');

Route::get('/pln', 'ObuPlnController@pln');
Route::any('/getKontrakData', 'plnController@getKontrakData');
Route::any('/getKontrakBulanData', 'plnController@getKontrakBulanData');
Route::any('/getVsData', 'plnController@getVsData');
Route::any('/getVsDataBulan', 'plnController@getVsDataBulan');

Route::get('/indexdasboardyf', 'index_dasboard_yfController@index');
Route::get('/indexdasboardyf/absen', 'index_dasboard_yfController@index2');
Route::get('/indexdasboardyf/duateratas', 'index_dasboard_yfController@duateratas');
Route::get('/indexdasboardyf/duaterbawah', 'index_dasboard_yfController@duaterbawah');

Auth::routes();