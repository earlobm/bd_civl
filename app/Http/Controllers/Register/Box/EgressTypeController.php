<?php
namespace poi\Http\Controllers\Register\Box;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\EgressType;


use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class EgressTypeController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
  
    public function getListEgressType(Request $request){
        $queyEgressType="";
        if(isset($request->id)){
            $idx=$request->id;
            $queyEgressType="select * from egress_type where id=$idx and state =1";
        }
        else{
            $queyEgressType="select * from egress_type where state =1";
        }
       
        $listEgressType = DB::select($queyEgressType);
          return [
              'datax'=>$listEgressType,
          ];
    }
    public function comboTypeEgress_list(Request $request){
        $queyEgressType="";
        if(isset($request->id)){
            $idx=$request->id;
            $queyEgressType="select * from egress_type where id=$idx and state=1";
        }else{
            $queyEgressType="select * from egress_type where state=1"; 
        }
       
        $listEgressType = DB::select($queyEgressType);
          return [
              'datax'=>$listEgressType,
          ];
    }
    public function getDependencyList(Request $request){
        $year=$request->year;
        $data=$request->data;

        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }

        $queyDependency="select * from dependency where active ='t' and operation_year =$year and concat(code,' ',name) like '%$data%' order by code limit 8 offset $curre_pagex ";
        $listDependency = DB::select($queyDependency);

        $sqltotal="select count(id_dependency) as cant from dependency where active ='t' and operation_year =$year and concat(code,' ',name) like '%$data%' ";
        $total=DB::select($sqltotal);
        $t = json_decode(json_encode($total), true);
        $totalx=intdiv((int)$t[0]['cant'], 8);
        $cocientex=((int)$t[0]['cant']%8);
              if($cocientex>0){$totalx=$totalx+1;}  
          return [
            'pagination' => [
                'total'        => (int)$t[0]['cant'],
                'current_page' => $request->page,
                'per_page'     => 8,
                'last_page'    => $totalx,
                'from'         => 1,
                'to'           => 8,
            ],
              'datax'=>$listDependency,
          ];
    }

    public function getEditEgressType(Request $request){
        $queyEgressType="select * from egress_type where state =1 and id='$request->id' ";
        $listEgressType = DB::select($queyEgressType);
        //obteniendo la actividad
          return [
              'datax'=>$listEgressType
          ];
    }

    public function delete_EgressType(Request $request){
        $clasex = EgressType::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    public function delete_FamilyProduct(Request $request){
        $clasex = Dependence::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    
    public function saveEgressType(Request $request){
        
        if($request->id==-1){
            $clasex = new EgressType();
        }else{
            $clasex = EgressType::findOrFail($request->id);
            //DependencyActivity::where('id_dependency', $request->id)->delete();
            //DependencyActivity::where('id', $request->id)->update(['state' => false]);
        }
        $clasex->name = $request->name;
        $clasex->state = 1;
        //($request->idParent!=''?$clasex->id_parent=$request->idParent:'');
        $clasex->save(); 
       
    }
            
    }

 








