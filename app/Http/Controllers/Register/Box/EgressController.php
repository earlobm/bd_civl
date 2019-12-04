<?php
namespace poi\Http\Controllers\Register\Box;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\BookBox;


use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class EgressController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
  
    public function getListEgress(Request $request){
        $search=$request->buscar;
        $queyEgress="SELECT er.id, tip.names,er.description,er.amount,er.date 
        FROM account_book tip inner join book_box er on er.account_book_id=tip.id 
        WHERE tip.category='EGRESO' and  er.state=1
        AND concat(tip.names,' ', er.description,' ',er.amount) like '%$search%'";
        $listEgress = DB::select($queyEgress);
          return [
              'datax'=>$listEgress,
          ];
    }
    
    public function comboTypeIncome_list(Request $request){
        $queyIncomeType="";
        if(isset($request->id)){
            $idx=$request->id;
            $queyIncomeType="select * from income_type where id=$idx and state=1";
        }else{
            $queyIncomeType="select * from income_type where  state=1"; 
        }
       
        $listIncomeType = DB::select($queyIncomeType);
          return [
              'datax'=>$listIncomeType,
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

    public function getEditEgress(Request $request){
        $queyEgress="select * from book_box where state =1 and id='$request->id' ";
        $listEgress = DB::select($queyEgress);
        //obteniendo la actividad
          return [
              'datax'=>$listEgress
          ];
    }

    public function delete_Egress(Request $request){
        $clasex = BookBox::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    public function delete_FamilyProduct(Request $request){
        $clasex = Dependence::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    
    
    public function saveEgress(Request $request){
        
        if($request->id==-1){
            $clasex = new BookBox();
        }else{
            $clasex = BookBox::findOrFail($request->id);
            //DependencyActivity::where('id_dependency', $request->id)->delete();
            //DependencyActivity::where('id', $request->id)->update(['state' => false]);
        }
        //$clasex->name = $request->name;
        $clasex->description = $request->description;
        $clasex->amount = $request->amount;
        $clasex->date =  $request->date;
        $clasex->account_book_id =  $request->account_book_id;
        $clasex->state = 1;
        $clasex->id_market =  $request->id_market;
        //($request->idParent!=''?$clasex->id_parent=$request->idParent:'');
        $clasex->save(); 
       
    }
            
    }

 








