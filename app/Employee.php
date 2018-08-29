<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'EMPLOYEE_ID','EMPLOYEE_NAME','EMPLOYEE_EMAIL','EMPLOYEE_TITLE','avatar', 'NIK'        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $table = 'employee';
    protected $primaryKey = 'EMPLOYEE_ID';
    
    // public function User(){
    //     return $this->hasMany('App/User');
    // }

}
