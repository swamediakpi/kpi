<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Image;

class obuController extends Controller {
	function getObuTotal(Request $request){
		$input = $request->all();
		$data['seriesData'] = new \stdClass;
		$data['seriesData']->name = 'Total';
		$data['seriesData']->colorByPoint = 'true';
		$totalNonRegis = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) jmlh FROM obu WHERE id_obu IS NULL or id_obu = ""'));
		$data['seriesData']->data[0] = new \stdClass;
		$data['seriesData']->data[0]->name = 'Belum Registrasi';
		$data['seriesData']->data[0]->y = $totalNonRegis[0]->jmlh;
		$totalRegis = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) jmlh FROM obu WHERE id_obu IS NOT NULL or id_obu = ""'));
		$data['seriesData']->data[1] = new \stdClass;
		$data['seriesData']->data[1]->name = 'Registrasi';
		$data['seriesData']->data[1]->y = $totalRegis[0]->jmlh;

		return json_encode($data);
	}

	function getOBUData(Request $request){
		$input = $request->all();
		$listUnit = DB::connection('mysql2')->select(DB::raw('SELECT erp_1_loc loc FROM obu WHERE erp_1_loc IS NOT NULL GROUP BY erp_1_loc'));
		$data['seriesData'] = new \stdClass;
		$data['seriesData']->name = 'Loc';
		$data['seriesData']->colorByPoint = 'true';
		$data['drilldownData'] = array();
		
		for($i = 0; $i < sizeof($listUnit); $i++) {
			$listSeriesData = DB::connection('mysql2')
								->select(DB::raw(
									'SELECT COUNT(1) jmlh FROM obu WHERE erp_1_loc = "'.$listUnit[$i]->loc.'" AND erp_1_loc IS NOT NULL'
								));
			$legend = DB::connection('mysql2')
						->select(DB::raw(
							'SELECT erp_1_loc loc, SUM(saldo_obu_total) jmlh FROM obu WHERE erp_1_loc = "'.$listUnit[$i]->loc.'"
							AND erp_1_loc IS NOT NULL'
						));
			$data['legend'][$i] = new \stdClass;
			if($legend[0]->loc != null){
				$data['legend'][$i]->name = ucwords($legend[0]->loc);
				$data['legend'][$i]->jmlh = $legend[0]->jmlh;
			}else {
				$data['legend'][$i]->name = ucwords($listUnit[$i]->loc);
				$data['legend'][$i]->jmlh = 0;
			}
			$data['seriesData']->data[$i] = new \stdClass;
			$data['seriesData']->data[$i]->name = ucwords($listUnit[$i]->loc);
			$data['seriesData']->data[$i]->y = $listSeriesData[0]->jmlh;
			$data['seriesData']->data[$i]->drilldown = $listUnit[$i]->loc;

			$listDrilldownData = DB::connection('mysql2')
									->select(DB::raw(
										'SELECT erp_2_loc loc2, COUNT(1) jmlh FROM obu
										WHERE erp_1_loc = "'.$listUnit[$i]->loc.'" AND erp_1_loc IS NOT NULL GROUP BY erp_2_loc'
									));
			$data['drilldownData'][$i] = new \stdClass;
			if($listDrilldownData != null) {
				$data['drilldownData'][$i]->name = ucwords($listUnit[$i]->loc);
				$data['drilldownData'][$i]->id = $listUnit[$i]->loc;
				for($j = 0; $j < sizeof($listDrilldownData); $j++) {
					if($listDrilldownData[$j]->loc2 != '' && $listDrilldownData[$j]->loc2 != null){
						$list = [ucwords($listDrilldownData[$j]->loc2), $listDrilldownData[$j]->jmlh];
					}else {
						$list = ['Belum Ada Tujuan', $listDrilldownData[$j]->jmlh];
					}
					$data['drilldownData'][$i]->data[] = $list;
				}
			}else{
				$data['drilldownData'][$i]->name = ucwords($listUnit[$i]->loc);
				$data['drilldownData'][$i]->id = $listUnit[$i]->loc;
				$data['drilldownData'][$i]->data[] = [$listUnit[$i]->loc, 0];
			}
		}
		return json_encode($data);
	}

	function getPercentData(Request $request){
		$input = $request->all();
		$getDataTotal = $this->getDataTotal();
		$data = $getDataTotal;
		$getDataSaldo = $this->getDataSaldo();
		$data += $getDataSaldo;
		return json_encode($data);
	}

	function getDataTotal() {
		$listLoc = DB::connection('mysql2')->select(DB::raw('SELECT erp_1_loc loc FROM obu GROUP BY erp_1_loc'));
		$data['seriesDataTotal'] = new \stdClass;
		$data['seriesDataTotal']->name = 'Total';
		$data['seriesDataTotal']->colorByPoint = 'true';
		$data['seriesDataTotal']->data = [];

		//percent PRK
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) total FROM obu'));
		$maksOBU = $sql[0]->total;
		
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) total FROM obu WHERE erp_1_loc = "" OR erp_1_loc IS NOT NULL'));
		$registrasiOBU = $sql[0]->total;

		$sql = DB::connection('mysql2')->select(DB::raw('SELECT COUNT(1) total FROM obu WHERE erp_1_loc = "" OR erp_1_loc IS NULL'));
		$nonRegistrasiOBU = $sql[0]->total;

		$percentObu = ($registrasiOBU / $maksOBU) * 100;
		$percentNon = ($nonRegistrasiOBU / $maksOBU) * 100;

		$data['seriesDataTotal']->data[0] = new \stdClass;
		$data['seriesDataTotal']->data[0]->name = 'Registrasi';
		$data['seriesDataTotal']->data[0]->y = round($percentObu,2);
		$data['seriesDataTotal']->data[1] = new \stdClass;
		$data['seriesDataTotal']->data[1]->name = 'Belum Registrasi';
		$data['seriesDataTotal']->data[1]->y = round($percentNon,2);
		
		return $data;
	}

	function getDataSaldo() {
		$listLoc = DB::connection('mysql2')->select(DB::raw(
			'SELECT erp_1_loc loc FROM obu WHERE erp_1_loc IS NOT NULL or erp_1_loc = "" GROUP BY erp_1_loc'
		));

		$data['seriesDataSaldo'] = new \stdClass;
		$data['seriesDataSaldo']->name = 'Saldo';
		$data['seriesDataSaldo']->colorByPoint = 'true';
		$data['seriesDataSaldo']->data = [];

		//percent Saldo
		$sql = DB::connection('mysql2')->select(DB::raw('SELECT SUM(saldo_obu_total) total FROM obu'));
		$maksSaldo = $sql[0]->total;
		
		for($i=0; $i < sizeof($listLoc); $i++){
			$sql = DB::connection('mysql2')->select(DB::raw('SELECT SUM(saldo_obu_total) total FROM obu WHERE erp_1_loc = "'.$listLoc[$i]->loc.'"'));
			$saldoLoc = $sql[0]->total;
			$percentSaldo = ($saldoLoc / $maksSaldo) * 100;
			$data['seriesDataSaldo']->data[$i] = new \stdClass;
			$data['seriesDataSaldo']->data[$i]->name = $listLoc[$i]->loc;
			$data['seriesDataSaldo']->data[$i]->y = round($percentSaldo);
		}
		
		return $data;
	}
}
