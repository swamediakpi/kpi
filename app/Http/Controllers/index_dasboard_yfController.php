<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Image;

class index_dasboard_yfController extends Controller {

	public function index(){
		$page_title = "Dashboard Absen";
		$dashboard = 0;
		return view('indexdasboardyf',compact(['page_title', 'dashboard']));
	}

	public function duateratas(){
		$page_title = "Project Berjalan";
		$dashboard = 2;
		return view('indexdasboardyf',compact(['page_title', 'dashboard']));
	}

	public function duaterbawah(){
		$page_title = "Rekap Absen";
		$dashboard = 3;
		return view('indexdasboardyf',compact(['page_title', 'dashboard']));
	}
		public function index2(){
		$page_title = "Absen Harian";
		$dashboard = 1;
		return view('indexdasboardyf',compact(['page_title', 'dashboard']));
	}
}