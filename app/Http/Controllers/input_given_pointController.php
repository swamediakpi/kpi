<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class input_given_pointController extends Controller
{

    public function showAreaKinerja(){
        $showAreaKinerja = DB::table('kinerja')->get();

        return view('input_given_point',compact(['showAreaKinerja']));
    }


  public function inputAreaKinerjaHrd(Request $request){

        $areakinerjahrd = $request->get('areahrd');
        $kpihrd = $request->get('kpihrd');
        $bobothrd = $request->get('bobothrd');

        DB::select("call spInsertKinerjaHRD('$kpihrd','$areakinerjahrd','$bobothrd')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
  }

    public function inputAreaKinerjaPmo(Request $request){

        $areakinerjapmo = $request->get('areapmo');
        $kpipmo = $request->get('kpipmo');
        $bobotpmo = $request->get('bobotpmo');

        DB::select("call spInsertKinerjaPMO('$kpipmo','$areakinerjapmo','$bobotpmo')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }

    public function inputAreaKinerjaUnit(Request $request){

        $areakinerjaunit = $request->get('areaunit');
        $kpiunit = $request->get('kpiunit');
        $bobotunit = $request->get('bobotunit');

        DB::select("call spInsertKinerjaUNIT('$kpiunit','$areakinerjaunit','$bobotunit')");

        $msg['msg'] = 'Success Insert';

        return json_encode($msg);
    }
}
?>