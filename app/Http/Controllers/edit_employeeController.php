<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Upload_file;
use Validator;

class edit_employeeController extends Controller
{
	public function showRoleUnit()
	{

		$showRole = DB::table('role')->get();
        $showUnit = DB::table('unit')->get();
        return view('edit_employee',compact(['showRole','showUnit']));
    }

    public function edit_employee(Request $request){
		
      $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
	  $no_emp = $request->get('empid');
	  $emp_name = $request->get('empname');
	  $emp_email = $request->get('emp-email');
	  $emp_title = $request->get('emp-title');
      if ($validator->passes()) {


        $input = $request->all();

        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
		$fileName   = $request->image->getClientOriginalName();
        $request->image->move(public_path('avatars'), $input['image']);
        $simpan = DB::select("call spupdateemp('".$no_emp."', '".$emp_email."', '".$emp_title."', '".$input['image']."','".$emp_name."')");

		if($no_emp!=null  &&$emp_name!=null && $emp_email!=null && $emp_title!=null && $fileName){
                    $msg['msg'] = 'Success Insert';
        }
        else{
                    $msg['msg'] = 'Gagal Insert';
        }


      }
	  return Redirect('/edit_employee')->with('message', 'Saved');
    }
}
?>