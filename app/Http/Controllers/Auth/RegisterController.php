<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'EMPLOYEE_ID' => 'required',
            'ROLE_ID' => 'required',
            'UNIT_ID' => 'required',
            'EMPLOYEE_NAME' => 'required|max:255',            
            'EMPLOYEE_EMAIL' => 'required|email|max:255',
            'EMPLOYEE_TITLE' => 'required',
            'username' => 'required|unique:employee',
            'password' => 'required|min:6|confirmed',            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {        
        return User::create([
            'EMPLOYEE_ID' => $data['EMPLOYEE_ID'],
            'ROLE_ID' => $data['ROLE_ID'],
            'UNIT_ID' => $data['UNIT_ID'],
            'EMPLOYEE_NAME' => $data['EMPLOYEE_NAME'],            
            'EMPLOYEE_EMAIL' => $data['EMPLOYEE_EMAIL'],
            'EMPLOYEE_TITLE' => $data['EMPLOYEE_TITLE'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),           
        ]);
    }
}
