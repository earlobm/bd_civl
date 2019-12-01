<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Reference;


use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class ReferenceController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
  
    public function getDependenceParent(Request $request){
        $queyDependence="";
        if(isset($request->id_parent)){
            $idx=$request->id_parent;
            $queyDependence="select * from dependence where id_parent=$idx and state=1";
        }else{
            $queyDependence="select * from dependence where id_parent is null and state=1"; 
        }
       
        $listDependence = DB::select($queyDependence);
          return [
              'datax'=>$listDependence,
          ];
    }
    public function getListReference(Request $request){
        
        $queyReference="SELECT id,name,mark,characteristic,price_from,price_to FROM reference where state=1;";
       
        $listReference = DB::select($queyReference);
          return [
              'datax'=>$listReference,
          ];
    }

    public function getEditDependenceTypeProduct(Request $request){
        $queyDependence="select * from dependence where state ='1' and id='$request->id' ";
        $listDependence = DB::select($queyDependence);
        //obteniendo la actividad
          return [
              'datax'=>$listDependence
          ];
    }
    public function getEditReference(Request $request){
        $queyReference="select * from reference where state =1 and id='$request->id'";
        $listReference = DB::select($queyReference);
        //obteniendo la actividad
          return [
              'datax'=>$listReference
          ];
    }

    public function delete_Reference(Request $request){
        $clasex = Reference::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    public function saveReference(Request $request){
        
        if($request->id==-1){
            $clasex = new Reference();
        }else{
            $clasex = Reference::findOrFail($request->id);
            //DependencyActivity::where('id_dependency', $request->id)->delete();
            //DependencyActivity::where('id', $request->id)->update(['state' => false]);
        }
        $clasex->name = $request->name;
        $clasex->mark = $request->mark;
        $clasex->characteristic = $request->characteristic;
        $clasex->price_from = $request->price_from;
        $clasex->price_to = $request->price_to;
        $clasex->state = 1;
        $clasex->id_dependence=$request->id_dependence;
        //($request->idParent!=''?$clasex->id_parent=$request->idParent:'');
        $clasex->save(); 
       
    }
            
    }

 








