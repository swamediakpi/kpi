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

	public function graphObu(){
		
		// return view('ObuPln',compact(['dashboard']));
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

	function getKontrakData(Request $request){
		$input = $request->all();
		$listUnit = DB::connection('mysql2')
						->select(DB::raw(
							'SELECT prk_unit unit FROM drp_new GROUP BY prk_unit'
						));
		$data['seriesData'] = new \stdClass;
		$data['seriesData']->name = 'Unit';
		$data['seriesData']->colorByPoint = 'true';
		$data['drilldownData'] = array();
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['type'] == 'kontrak_type_p'){
				$listSeriesData = DB::connection('mysql2')
									->select(DB::raw(
										'SELECT
											COUNT(1) jmlh
										FROM drp_new
										WHERE prk_unit = "'.$listUnit[$i]->unit.'"
										AND kontrak_no IS NOT NULL'
									));
				$legend = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit unit, SUM(kontrak_rupiah) jmlh
								FROM drp_new
								WHERE prk_unit = "'.$listUnit[$i]->unit.'"
								AND kontrak_no IS NOT NULL'
							));
				$data['legend'][$i] = new \stdClass;
				if($legend[0]->unit != null){
					$data['legend'][$i]->name = $legend[0]->unit;
					$data['legend'][$i]->jmlh = $legend[0]->jmlh;
				}else {
					$data['legend'][$i]->name = $listUnit[$i]->unit;
					$data['legend'][$i]->jmlh = 0;
				}
				$data['seriesData']->data[$i] = new \stdClass;
				$data['seriesData']->data[$i]->name = $listUnit[$i]->unit;
				$data['seriesData']->data[$i]->y = $listSeriesData[0]->jmlh;
				$data['seriesData']->data[$i]->drilldown = $listUnit[$i]->unit;

				$listDrilldownData = DB::connection('mysql2')
										->select(DB::raw(
											'SELECT
												prk_unit_pelaksanan pelaksanaan, COUNT(1) jmlh
											FROM drp_new
											WHERE prk_unit = "'.$listUnit[$i]->unit.'" AND kontrak_no IS NOT NULL
											GROUP BY prk_unit_pelaksanan'
										));
				$data['drilldownData'][$i] = new \stdClass;
				if($listDrilldownData != null) {
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					for($j = 0; $j < sizeof($listDrilldownData); $j++) {
						$list = [$listDrilldownData[$j]->pelaksanaan, $listDrilldownData[$j]->jmlh];
						$data['drilldownData'][$i]->data[] = $list;
					}
				}else{
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->data[] = [$listUnit[$i]->unit, 0];
				}
			}else {
				$listSeriesData = DB::connection('mysql2')
									->select(DB::raw(
										'SELECT
											SUM(kontrak_rupiah) jmlh
										FROM drp_new
										WHERE prk_unit = "'.$listUnit[$i]->unit.'"
										AND kontrak_no IS NOT NULL'
									));
				$legend = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit unit, COUNT(1) jmlh
								FROM drp_new
								WHERE prk_unit = "'.$listUnit[$i]->unit.'"
								AND kontrak_no IS NOT NULL'
							));
				$data['legend'][$i] = new \stdClass;
				if($legend[0]->unit != null){
					$data['legend'][$i]->name = $legend[0]->unit;
					$data['legend'][$i]->jmlh = $legend[0]->jmlh;
				}else {
					$data['legend'][$i]->name = $listUnit[$i]->unit;
					$data['legend'][$i]->jmlh = 0;
				}
				$data['seriesData']->data[$i] = new \stdClass;
				$data['seriesData']->data[$i]->name = $listUnit[$i]->unit;
				$data['seriesData']->data[$i]->y = round($listSeriesData[0]->jmlh,2);
				$data['seriesData']->data[$i]->drilldown = $listUnit[$i]->unit;
				$listDrilldownData = DB::connection('mysql2')
										->select(DB::raw(
											'SELECT
												prk_unit_pelaksanan pelaksanaan, SUM(kontrak_rupiah) jmlh
											FROM drp_new
											WHERE prk_unit = "'.$listUnit[$i]->unit.'" AND kontrak_no IS NOT NULL
											GROUP BY prk_unit_pelaksanan'
										));
				$data['drilldownData'][$i] = new \stdClass;
				if($listDrilldownData != null) {
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					for($j = 0; $j < sizeof($listDrilldownData); $j++) {
						$list = [$listDrilldownData[$j]->pelaksanaan, $listDrilldownData[$j]->jmlh];
						$data['drilldownData'][$i]->data[] = $list;
					}
				}else{
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->data[] = [$listUnit[$i]->unit, 0];
				}
			}
		}
		return json_encode($data);
	}

	function getKontrakBulanData(Request $request){
		$input = $request->all();
		$listUnit = DB::connection('mysql2')
						->select(DB::raw(
							'SELECT
								prk_unit unit
							FROM drp_new
							GROUP BY prk_unit'
						));
		$data['seriesData'] = new \stdClass;
		$data['seriesData']->name = 'Unit';
		$data['seriesData']->colorByPoint = 'true';
		$data['drilldownData'] = array();
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['type'] == 'kontrak_type_p'){
				$listSeriesData = DB::connection('mysql2')
									->select(DB::raw(
										'SELECT
											COUNT(1) jmlh
										FROM drp_new
										WHERE prk_unit = "'.$listUnit[$i]->unit.'"
										AND prk_date = "'.$input['bulan'].'"
										AND kontrak_no IS NOT NULL'
									));
				$legend = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit unit, SUM(kontrak_rupiah) jmlh
								FROM drp_new
								WHERE prk_unit = "'.$listUnit[$i]->unit.'"
								AND prk_date = "'.$input['bulan'].'"
								AND kontrak_no IS NOT NULL'
							));
				$data['legend'][$i] = new \stdClass;
				if($legend[0]->unit != null){
					$data['legend'][$i]->name = $legend[0]->unit;
					$data['legend'][$i]->jmlh = $legend[0]->jmlh;
				}else {
					$data['legend'][$i]->name = $listUnit[$i]->unit;
					$data['legend'][$i]->jmlh = 0;
				}
				$data['seriesData']->data[$i] = new \stdClass;
				$data['seriesData']->data[$i]->name = $listUnit[$i]->unit;
				$data['seriesData']->data[$i]->y = $listSeriesData[0]->jmlh;
				$data['seriesData']->data[$i]->drilldown = $listUnit[$i]->unit;

				$listDrilldownData = DB::connection('mysql2')
										->select(DB::raw(
											'SELECT
												prk_unit_pelaksanan pelaksanaan, COUNT(1) jmlh
											FROM drp_new
											WHERE prk_unit = "'.$listUnit[$i]->unit.'"
											AND prk_date = "'.$input['bulan'].'"
											AND kontrak_no IS NOT NULL
											GROUP BY prk_unit_pelaksanan'
										));
				$data['drilldownData'][$i] = new \stdClass;
				if($listDrilldownData != null) {
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					for($j = 0; $j < sizeof($listDrilldownData); $j++) {
						$list = [$listDrilldownData[$j]->pelaksanaan, $listDrilldownData[$j]->jmlh];
						$data['drilldownData'][$i]->data[] = $list;
					}
				}else{
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->data[] = [$listUnit[$i]->unit, 0];
				}
			}else {
				$listSeriesData = DB::connection('mysql2')->select(DB::raw(
					'SELECT SUM(kontrak_rupiah) jmlh FROM drp_new 
					WHERE prk_unit = "'.$listUnit[$i]->unit.'" AND prk_date = "'.$input['bulan'].'" AND kontrak_no IS NOT NULL'));
				$legend = DB::connection('mysql2')->select(DB::raw(
					'SELECT prk_unit unit, COUNT(1) jmlh FROM drp_new 
					WHERE prk_unit = "'.$listUnit[$i]->unit.'" AND prk_date = "'.$input['bulan'].'" AND kontrak_no IS NOT NULL'));
				$data['legend'][$i] = new \stdClass;
				if($legend[0]->unit != null){
					$data['legend'][$i]->name = $legend[0]->unit;
					$data['legend'][$i]->jmlh = $legend[0]->jmlh;
				}else {
					$data['legend'][$i]->name = $listUnit[$i]->unit;
					$data['legend'][$i]->jmlh = 0;
				}
				$data['seriesData']->data[$i] = new \stdClass;
				$data['seriesData']->data[$i]->name = $listUnit[$i]->unit;
				if($listSeriesData[0]->jmlh != null) $data['seriesData']->data[$i]->y = round($listSeriesData[0]->jmlh,2);
				else $data['legend'][$i]->name = $data['seriesData']->data[$i]->y = 0;
				$data['seriesData']->data[$i]->y = round($listSeriesData[0]->jmlh,2);
				$data['seriesData']->data[$i]->drilldown = $listUnit[$i]->unit;
				$listDrilldownData = DB::connection('mysql2')
										->select(DB::raw(
											'SELECT
												prk_unit_pelaksanan pelaksanaan, SUM(kontrak_rupiah) jmlh
											FROM drp_new
											WHERE prk_unit = "'.$listUnit[$i]->unit.'"
											AND prk_date = "'.$input['bulan'].'"
											AND kontrak_no IS NOT NULL
											GROUP BY prk_unit_pelaksanan'
										));
				$data['drilldownData'][$i] = new \stdClass;
				if($listDrilldownData != null) {
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					for($j = 0; $j < sizeof($listDrilldownData); $j++) {
						$list = [$listDrilldownData[$j]->pelaksanaan, $listDrilldownData[$j]->jmlh];
						$data['drilldownData'][$i]->data[] = $list;
					}
				}else{
					$data['drilldownData'][$i]->name = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->id = $listUnit[$i]->unit;
					$data['drilldownData'][$i]->data[] = [$listUnit[$i]->unit, 0];
				}
			}
		}
		return json_encode($data);
	}

	function getVsData(Request $request) {
		$input = $request->all();
		$getDataPRK = $this->getVsPRK($input);
		$data = $getDataPRK;
		$getDataAnggaran = $this->getVsAnggaran($input);
		$data += $getDataAnggaran;
		return json_encode($data);
	}

	function getVsDataBulan(Request $request) {
		$input = $request->all();
		$getDataPRK = $this->getVsPRKBulan($input);
		$data = $getDataPRK;
		$getDataAnggaran = $this->getVsAnggaranBulan($input);
		$data += $getDataAnggaran;
		return json_encode($data);
	}

	function getVsPRK($input) {
		if($input['unit'] != 'JTBN') {
			$strUnit = "WHERE prk_unit = '".$input['unit']."'";
			$strUnitAnd = "AND prk_unit = '".$input['unit']."'";
			$listUnit = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit_pelaksanan unit
								FROM drp_new '.$strUnit.'
								GROUP BY prk_unit_pelaksanan'
							));
		}else {
			$strUnit = "";
			$strUnitAnd = "";
			$listUnit = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit unit
								FROM drp_new '.$strUnit.'
								GROUP BY prk_unit'
							));
		}

		$data['seriesDataPRK'] = new \stdClass;
		$data['seriesDataPRK']->name = $input['unit'];
		$data['seriesDataPRK']->colorByPoint = 'true';
		$data['seriesDataPRK']->data = [];
		$data['drilldownDataPRK'] = [];

		//percent PRK
		$sql = DB::connection('mysql2')
					->select(DB::raw(
						'SELECT
							COUNT(1) total
						FROM drp_new '.$strUnit
					));
		$maksPRK = $sql[0]->total;
		
		$sql = DB::connection('mysql2')
					->select(DB::raw(
						'SELECT
							COUNT(1) total
						FROM drp_new WHERE kontrak_no IS NOT NULL '.$strUnitAnd
					));
		$kontrakPRK = $sql[0]->total;

		$sql = DB::connection('mysql2')
					->select(DB::raw(
						'SELECT
							COUNT(1) total
						FROM drp_new WHERE kontrak_no IS NULL '.$strUnitAnd
					));
		$sisaPRK = $sql[0]->total;

		$percentKontrak = ($kontrakPRK / $maksPRK) * 100;
		$percentSisa = ($sisaPRK / $maksPRK) * 100;

		$data['seriesDataPRK']->data[0] = new \stdClass;
		$data['seriesDataPRK']->data[0]->name = 'Kontrak';
		$data['seriesDataPRK']->data[0]->y = round($percentKontrak,2);
		$data['seriesDataPRK']->data[0]->drilldown = 'Kontrak';
		$data['seriesDataPRK']->data[1] = new \stdClass;
		$data['seriesDataPRK']->data[1]->name = 'Sisa';
		$data['seriesDataPRK']->data[1]->y = round($percentSisa,2);
		$data['seriesDataPRK']->data[1]->drilldown = 'Sisa';

		$rowDrill[0] = new \stdClass;
		$rowDrill[0]->name = 'Kontrak';
		$rowDrill[0]->data = [];
		$rowDrill[0]->id = 'Kontrak';
		$rowDrill[1] = new \stdClass;
		$rowDrill[1]->name = 'Sisa';
		$rowDrill[1]->data = [];
		$rowDrill[1]->id = 'Sisa';
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['unit'] != 'JTBN') {
				$strsqlKontrak = "SELECT COUNT(1) total, prk_unit_pelaksanan FROM drp_new
					WHERE prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnitAnd." AND kontrak_no IS NOT NULL
				";
				$strsqlSisa = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnitAnd." AND kontrak_no IS NULL
				";
			}else {
				$strsqlKontrak = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NOT NULL
				";
				$strsqlSisa = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NULL
				";
			}

			$sqlKontrak = DB::connection('mysql2')->select(DB::raw($strsqlKontrak));
			$kontrakPRK = $sqlKontrak[0]->total;
			
			$sqlSisa = DB::connection('mysql2')->select(DB::raw($strsqlSisa));
			$sisaPRK = $sqlSisa[0]->total;

			$percentKontrak = ($kontrakPRK / $maksPRK) * 100;
			$percentSisa = ($sisaPRK / $maksPRK) * 100;

			$rowDrill[0]->data[$i] = [$listUnit[$i]->unit, round($percentKontrak,2)];
			$rowDrill[1]->data[$i] = [$listUnit[$i]->unit, round($percentSisa,2)];
		}
		$data['drilldownDataPRK'] = $rowDrill;
		return $data;
	}

	function getVsAnggaran($input) {
		if($input['unit'] != 'JTBN') {
			$strUnit = "WHERE prk_unit = '".$input['unit']."'";
			$strUnitAnd = "AND prk_unit = '".$input['unit']."'";
			$listUnit = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit_pelaksanan unit
								FROM drp_new '.$strUnit.'
								GROUP BY prk_unit_pelaksanan'
							));
		}else {
			$strUnit = "";
			$strUnitAnd = "";
			$listUnit = DB::connection('mysql2')
							->select(DB::raw(
								'SELECT
									prk_unit unit
								FROM drp_new '.$strUnit.'
								GROUP BY prk_unit'
							));
		}

		$data['seriesDataAnggaran'] = new \stdClass;
		$data['seriesDataAnggaran']->name = $input['unit'];
		$data['seriesDataAnggaran']->colorByPoint = 'true';
		$data['seriesDataAnggaran']->data = [];
		$data['drilldownDataAnggaran'] = [];

		//percent Anggaran
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT SUM(ai_rupiah) total FROM drp_new '.$strUnit));
		$maksAnggaran = $sql[0]->total;
		
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT SUM(kontrak_rupiah) total FROM drp_new WHERE kontrak_no IS NOT NULL '.$strUnitAnd));
		$kontrakAnggaran = $sql[0]->total;
		$sisaAnggaran = $maksAnggaran - $kontrakAnggaran;
		$TotalSisaAnggaran = $sisaAnggaran;

		$percentKontrak = ($kontrakAnggaran / $maksAnggaran) * 100;
		$percentSisa = ($sisaAnggaran / $maksAnggaran) * 100;

		$data['seriesDataAnggaran']->data[0] = new \stdClass;
		$data['seriesDataAnggaran']->data[0]->name = 'Kontrak';
		$data['seriesDataAnggaran']->data[0]->y = round($percentKontrak,2);
		$data['seriesDataAnggaran']->data[0]->drilldown = 'Kontrak';
		$data['seriesDataAnggaran']->data[1] = new \stdClass;
		$data['seriesDataAnggaran']->data[1]->name = 'Sisa';
		$data['seriesDataAnggaran']->data[1]->y = round($percentSisa,2);
		$data['seriesDataAnggaran']->data[1]->drilldown = 'Sisa';

		$rowDrill[0] = new \stdClass;
		$rowDrill[0]->name = 'Kontrak';
		$rowDrill[0]->data = [];
		$rowDrill[0]->id = 'Kontrak';
		$rowDrill[1] = new \stdClass;
		$rowDrill[1]->name = 'Sisa';
		$rowDrill[1]->data = [];
		$rowDrill[1]->id = 'Sisa';
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['unit'] != 'JTBN') {
				$strsqlKontrak = "SELECT SUM(kontrak_rupiah) total FROM drp_new
					WHERE prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnitAnd." AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT SUM(ai_rupiah) total FROM drp_new
					WHERE prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnitAnd." AND kontrak_no IS NULL";
			}else {
				$strsqlKontrak = "SELECT SUM(kontrak_rupiah) total FROM drp_new
					WHERE prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT SUM(ai_rupiah) total FROM drp_new
					WHERE prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NULL";
			}

			$sqlKontrak = DB::connection('mysql2')->select(DB::raw($strsqlKontrak));
			$kontrakAnggaran = $sqlKontrak[0]->total;
			
			$sqlSisa = DB::connection('mysql2')->select(DB::raw($strsqlSisa));
			$sisaAnggaran = $sqlSisa[0]->total;

			$percentKontrak = ($kontrakAnggaran / $maksAnggaran) * 100;
			$percentSisa = ($sisaAnggaran / $maksAnggaran) * 100;

			$rowDrill[0]->data[$i] = [$listUnit[$i]->unit, round($percentKontrak,2)];
			$rowDrill[1]->data[$i] = [$listUnit[$i]->unit, round($percentSisa,2)];
		}
		$data['drilldownDataAnggaran'] = $rowDrill;
		return $data;
	}

	function getVsPRKBulan($input) {
		if($input['unit'] != 'JTBN') {
			$strUnit = "AND prk_unit = '".$input['unit']."'";
			$listUnit = DB::connection('mysql2')->select(DB::raw(
				'SELECT prk_unit_pelaksanan unit FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit.' GROUP BY prk_unit_pelaksanan'));
		}else {
			$strUnit = "";
			$strUnitAnd = "";
			$listUnit = DB::connection('mysql2')->select(DB::raw(
				'SELECT prk_unit unit FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit.' GROUP BY prk_unit
			'));
		}

		$data['seriesDataPRK'] = new \stdClass;
		$data['seriesDataPRK']->name = $input['unit'];
		$data['seriesDataPRK']->colorByPoint = 'true';
		$data['seriesDataPRK']->data = [];
		$data['drilldownDataPRK'] = [];

		//percent PRK
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) total FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit));
		$maksPRK = $sql[0]->total;
		
		$sql = DB::connection('mysql2')->select(DB::raw(
			'SELECT COUNT(1) total FROM drp_new WHERE prk_date = "'.$input['bulan'].'" AND kontrak_no IS NOT NULL '.$strUnit));
		$kontrakPRK = $sql[0]->total;

		$sql = DB::connection('mysql2')->select(DB::raw(
			'SELECT COUNT(1) total FROM drp_new WHERE prk_date = "'.$input['bulan'].'" AND kontrak_no IS NULL '.$strUnit));
		$sisaPRK = $sql[0]->total;

		$percentKontrak = ($kontrakPRK / $maksPRK) * 100;
		$percentSisa = ($sisaPRK / $maksPRK) * 100;

		$data['seriesDataPRK']->data[0] = new \stdClass;
		$data['seriesDataPRK']->data[0]->name = 'Kontrak';
		$data['seriesDataPRK']->data[0]->y = round($percentKontrak,2);
		$data['seriesDataPRK']->data[0]->drilldown = 'Kontrak';
		$data['seriesDataPRK']->data[1] = new \stdClass;
		$data['seriesDataPRK']->data[1]->name = 'Sisa';
		$data['seriesDataPRK']->data[1]->y = round($percentSisa,2);
		$data['seriesDataPRK']->data[1]->drilldown = 'Sisa';

		$rowDrill[0] = new \stdClass;
		$rowDrill[0]->name = 'Kontrak';
		$rowDrill[0]->data = [];
		$rowDrill[0]->id = 'Kontrak';
		$rowDrill[1] = new \stdClass;
		$rowDrill[1]->name = 'Sisa';
		$rowDrill[1]->data = [];
		$rowDrill[1]->id = 'Sisa';
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['unit'] != 'JTBN') {
				$strsqlKontrak = "SELECT COUNT(1) total, prk_unit_pelaksanan FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnit." AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnit." AND kontrak_no IS NULL";
			}else {
				$strsqlKontrak = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT COUNT(1) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NULL";
			}

			$sqlKontrak = DB::connection('mysql2')->select(DB::raw($strsqlKontrak));
			$kontrakPRK = $sqlKontrak[0]->total;
			
			$sqlSisa = DB::connection('mysql2')->select(DB::raw($strsqlSisa));
			$sisaPRK = $sqlSisa[0]->total;

			$percentKontrak = ($kontrakPRK / $maksPRK) * 100;
			$percentSisa = ($sisaPRK / $maksPRK) * 100;

			$rowDrill[0]->data[$i] = [$listUnit[$i]->unit, round($percentKontrak,2)];
			$rowDrill[1]->data[$i] = [$listUnit[$i]->unit, round($percentSisa,2)];
		}
		$data['drilldownDataPRK'] = $rowDrill;
		return $data;
	}

	function getVsAnggaranBulan($input) {
		if($input['unit'] != 'JTBN') {
			$strUnit = "AND prk_unit = '".$input['unit']."'";
			$listUnit = DB::connection('mysql2')->select(DB::raw(
				'SELECT prk_unit_pelaksanan unit FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit.' GROUP BY prk_unit_pelaksanan'));
		}else {
			$strUnit = "";
			$listUnit = DB::connection('mysql2')->select(DB::raw(
				'SELECT prk_unit unit FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit.' GROUP BY prk_unit'));
		}

		$data['seriesDataAnggaran'] = new \stdClass;
		$data['seriesDataAnggaran']->name = $input['unit'];
		$data['seriesDataAnggaran']->colorByPoint = 'true';
		$data['seriesDataAnggaran']->data = [];
		$data['drilldownDataAnggaran'] = [];

		//percent Anggaran
		$sql = DB::connection('mysql2')->select(DB::raw(
			'SELECT SUM(ai_rupiah) total FROM drp_new WHERE prk_date = "'.$input['bulan'].'"'.$strUnit));
		$maksAnggaran = $sql[0]->total;
		
		$sql = DB::connection('mysql2')->select(DB::raw(
			'SELECT SUM(kontrak_rupiah) total FROM drp_new WHERE prk_date = "'.$input['bulan'].'" AND kontrak_no IS NOT NULL '.$strUnit));
		$kontrakAnggaran = $sql[0]->total;
		$sisaAnggaran = $maksAnggaran - $kontrakAnggaran;
		$TotalSisaAnggaran = $sisaAnggaran;

		$percentKontrak = ($kontrakAnggaran / $maksAnggaran) * 100;
		$percentSisa = ($sisaAnggaran / $maksAnggaran) * 100;

		$data['seriesDataAnggaran']->data[0] = new \stdClass;
		$data['seriesDataAnggaran']->data[0]->name = 'Kontrak';
		$data['seriesDataAnggaran']->data[0]->y = round($percentKontrak,2);
		$data['seriesDataAnggaran']->data[0]->drilldown = 'Kontrak';
		$data['seriesDataAnggaran']->data[1] = new \stdClass;
		$data['seriesDataAnggaran']->data[1]->name = 'Sisa';
		$data['seriesDataAnggaran']->data[1]->y = round($percentSisa,2);
		$data['seriesDataAnggaran']->data[1]->drilldown = 'Sisa';

		$rowDrill[0] = new \stdClass;
		$rowDrill[0]->name = 'Kontrak';
		$rowDrill[0]->data = [];
		$rowDrill[0]->id = 'Kontrak';
		$rowDrill[1] = new \stdClass;
		$rowDrill[1]->name = 'Sisa';
		$rowDrill[1]->data = [];
		$rowDrill[1]->id = 'Sisa';
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			if($input['unit'] != 'JTBN') {
				$strsqlKontrak = "SELECT SUM(kontrak_rupiah) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnit." AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT SUM(ai_rupiah) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit_pelaksanan = '".$listUnit[$i]->unit."'".$strUnit." AND kontrak_no IS NULL";
			}else {
				$strsqlKontrak = "SELECT SUM(kontrak_rupiah) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NOT NULL";
				$strsqlSisa = "SELECT SUM(ai_rupiah) total FROM drp_new
					WHERE prk_date = '".$input['bulan']."' AND prk_unit = '".$listUnit[$i]->unit."' AND kontrak_no IS NULL";
			}

			$sqlKontrak = DB::connection('mysql2')->select(DB::raw($strsqlKontrak));
			$kontrakAnggaran = $sqlKontrak[0]->total;
			
			$sqlSisa = DB::connection('mysql2')->select(DB::raw($strsqlSisa));
			$sisaAnggaran = $sqlSisa[0]->total;

			$percentKontrak = ($kontrakAnggaran / $maksAnggaran) * 100;
			$percentSisa = ($sisaAnggaran / $maksAnggaran) * 100;

			$rowDrill[0]->data[$i] = [$listUnit[$i]->unit, round($percentKontrak,2)];
			$rowDrill[1]->data[$i] = [$listUnit[$i]->unit, round($percentSisa,2)];
		}
		$data['drilldownDataAnggaran'] = $rowDrill;
		return $data;
	}

	function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function random_color() {
		return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
	}
}