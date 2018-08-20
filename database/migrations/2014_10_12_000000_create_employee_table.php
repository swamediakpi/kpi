<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->integer('EMPLOYEE_ID');
            $table->integer('ROLE_ID');
            $table->integer('UNIT_ID');     
            $table->string('EMPLOYEE_NAME');
            $table->string('EMPLOYEE_EMAIL');
            $table->string('EMPLOYEE_TITLE');                    
            $table->string('username')->unique();            
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employee');
    }
}
