<?php
namespace poi\Http\Controllers\Security;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Rol;


use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class RoleController extends Controller
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
    public function getListRol(Request $request){
        
        $queyRol="SELECT * FROM role";
       
        $listRol = DB::select($queyRol);
          return [
              'datax'=>$listRol,
          ];
    }

    
    public function getEditRol(Request $request){
        $queyRol="select * from role where id='$request->id'";
        $listRol = DB::select($queyRol);
        //obteniendo la actividad
          return [
              'datax'=>$listRol
          ];
    }

    public function delete_Reference(Request $request){
        $clasex = Reference::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    public function saveRole(Request $request){
        
        if($request->id==-1){
            $clasex = new Rol();
        }else{
            $clasex = Rol::findOrFail($request->id);
            //DependencyActivity::where('id_dependency', $request->id)->delete();
            //DependencyActivity::where('id', $request->id)->update(['state' => false]);
        }
        $clasex->name = $request->name;
        $clasex->descripcion = $request->descripcion;
        $clasex->edit = $request->edit;
        $clasex->delete_role = $request->delete_role;
        $clasex->add_role = $request->add_role;
        //($request->idParent!=''?$clasex->id_parent=$request->idParent:'');
        $clasex->save(); 
       
    }
            
    }

 








