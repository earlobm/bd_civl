<?php
namespace poi\Http\Controllers\PlanOperativo;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\PoiSchedule;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class PoiScheduleController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }
    
    public function add_update($id_schedule,  $id_poi_activity, $quanty){       
        $clasey =PoiSchedule::where('id_schedule','=', $id_schedule)->where('id_poi_activity', '=', $id_poi_activity)->select('id')->take(1)->get();
        if(count($clasey)==0){
            $clasew = new PoiSchedule();
            $clasew->id_schedule=$id_schedule;
            $clasew->id_poi_activity=$id_poi_activity;
            $clasew->id_period='2';
            $clasew->quanty=$quanty;
            $clasew->save();    
        }else{
            //Para actualizar el estado a activo de la actividad de capacitacion
            $clasey =PoiSchedule::where('id_schedule','=', $id_schedule)->where('id_poi_activity', '=', $id_poi_activity)
            ->select('id')->take(1)->get();
            if(count($clasey)>0){
                $id=$clasey[0]['id'];
                $clasew = PoiSchedule::findOrFail($id);
                $clasew->quanty=$quanty;
                $clasew->save(); 
            }
            
        }   
    }
    
}
