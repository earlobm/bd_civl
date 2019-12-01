<?php
namespace poi\Http\Controllers\Register\Mef;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\UnitMesuare;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class UnitMesuareController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
    public function getDataByRucSunat(Request $request){
        $ruc=$request->ruc;
        $json = file_get_contents('https://api.sunat.cloud/ruc/'.$ruc);
        $obj = json_decode($json);
       // print $obj->razon_social;
        return [
            'datax' => $obj
        ];
    }
    public function getUnit(Request $request){

        $sqlx="";
        if(isset($request->id_unit)){
            $id=$request->id_unit;
            $sqlx="select * from unit_mesuare where id_unit=$id ";
        }else{
            $buscar=$request->buscar;
            $sqlx="select * from unit_mesuare where active='t' and concat (code,' ',name) like '%$buscar%' order by id_unit";
        }
          
          $miLista = DB::select($sqlx);
          return [
              'datax' => $miLista
          ];
    }
    public function deleteUnit(Request $request){
        // $DateOfRequest= date("Y-m-d H:i:s");
         $clasex = UnitMesuare::findOrFail($request->id_unit);
         $clasex->active = 'f';
        // $clasex->modificado ='Eliminado por '.Auth::user()->nick.' '. $DateOfRequest;
         $clasex->update();
     
    }

    public function saveUnit(Request $request){
        if($request->id==-1){
            $clasex = new UnitMesuare();
        }else{
            $clasex = UnitMesuare::findOrFail($request->id);
        }
        $clasex->code = $request->code;
        $clasex->name = $request->name;
        $clasex->active = 't';
        $clasex->save(); 
        
        
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
        
   }

 



}




