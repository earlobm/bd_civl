<?php
namespace poi\Http\Controllers\Register\Mef;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Programs;
use poi\EntityClass\Products;
use poi\EntityClass\Product_Program;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class ProductProgramController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
    public function add_update($id_program,$id_product, $valorcheck){
        //Inicio Actividad 1
        if($valorcheck){
            $clasey =Product_Program::where('id_program','=', $id_program)
            ->where('id_product', '=', $id_product)
            ->select('id')->take(1)->get();
            if(count($clasey)==0){
                $clasew = new Product_Program();     
                $clasew->active='t';
                $clasew->id_program=$id_program;
                $clasew->id_product=$id_product;
                $clasew->save();    
            }else{
                //Para actualizar el estado a activo de la actividad de visita
                if(count($clasey)>0){
                    $id=$clasey[0]['id'];
                    $clasew = Product_Program::findOrFail($id);     
                    $clasew->active='t';
                    $clasew->save(); 
                }
                
            }            
        }else{
            //Para actualizar el estado a inactivo de la actividad de visita
            $clasey =Product_Program::where('id_program','=', $id_program)->where('id_product', '=', $id_product)
            ->select('id')->take(1)->get();
            if(count($clasey)>0){
                $id=$clasey[0]['id'];
                $clasew = Product_Program::findOrFail($id);     
                $clasew->active='f';
              //  print 'Cambiado a inactivoddd'.$id_actividad;
                $clasew->save();      
            }
        } //Fin Actividad 1
    }
    
}




