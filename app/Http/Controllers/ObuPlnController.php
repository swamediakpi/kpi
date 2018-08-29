<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Image;

class ObuPlnController extends Controller {

	public function index(){
		$page_title = "Dashboard OBU";
		$dashboard = 1;
		return view('ObuPln',compact(['page_title', 'dashboard']));
	}

	public function ObuYf(){
		$page_title = "Dashboard OBU YellowFin";
		$dashboard = 2;
		return view('ObuPln',compact(['page_title', 'dashboard']));
	}

	public function pln(){
		$page_title = "Dashboard PLN";
		$dashboard = 3;
		return view('ObuPln',compact(['page_title', 'dashboard']));
	}
}