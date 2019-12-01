<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\BranchOffice;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class BranchOfficeController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }    

    public function save(Request $request){
        if($request->id==-1){
            $clasex = new BranchOffice();
        }else{
            $clasex = BranchOffice::findOrFail($request->id);
        }
        
        $clasex->name = $request->name;
        $clasex->address = $request->address;
        $clasex->date_init = $request->date_init;
        $clasex->state = "1";
        $clasex->phone =  $request->phone;
        $clasex->notes = $request->notes;
        //$DateOfRequest= date("Y-m-d H:i:s");
    
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
            
    }

    public function edit(Request $request){
        $queyDependency="SELECT * FROM branch_office where id='$request->id' ";
        $listDependency = DB::select($queyDependency);
        return [
            'datax'=>$listDependency
        ];
    }

    public function combo_list(Request $request){
        $queyDependency="SELECT id, name FROM branch_office where state='1' order by name";
        $listDependency = DB::select($queyDependency);
        return [
            'datax'=>$listDependency
        ];
    }

    public function list(Request $request){       
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }
        $sqlx="";
        $search=$request->search;
        $sqlx="SELECT * FROM branch_office WHERE concat(name,' ',address,' ',date_init,' ',phone)  like '%$search%' order by id limit 8 offset $curre_pagex";
        $datax=DB::select($sqlx);
        
        $sqltotal="SELECT count(id) as total from branch_office where concat(name,' ',address,' ',date_init,' ',phone)  like '%$search%' ";
        $total=DB::select($sqltotal);
        $t = json_decode(json_encode($total), true);
        $totalx=intdiv((int)$t[0]['total'], 8);
        $cocientex=((int)$t[0]['total']%8);
        if($cocientex>0){$totalx=$totalx+1;}
        return [
        'pagination' => [
            'total'        => (int)$t[0]['total'],
            'current_page' => $request->page,
            'per_page'     => 8,
            'last_page'    => $totalx,
            'from'         => 1,
            'to'           => 8,
        ],
            'datax'=>$datax,
        ];
    }

    public function delete(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = BranchOffice::findOrFail($request->id);
        $clasex->state ='0';
       //$clasex->update_user ='Eliminado '. $DateOfRequest;
        $clasex->save();
    
    }

    public function downloadProgram(Request $request){    
        
        $sqlx="";
        if(isset($request->id_program)){
            $id=$request->id_program;
            $sqlx="select * from budget_program where id_program=$id ";
        }else{
            $search=$request->search;
            $sqlx="select * from budget_program where active='t'  and concat(code,' ', name) like ('%$search%')  order by name";
            //  $sqlx="select * from budget_program where active='t' and concat (code,' ',name) like '%$buscar%' order by id_program";
        }

            $miListax=DB::select($sqlx);
            $miLista = json_decode(json_encode($miListax), true);
        //  return $miLista;

        Excel::create('Programas', function($excel) use($miLista) {
        $excel->sheet('DATA', function($sheet) use($miLista){
        $sheet->setScale('75');
            $array = json_decode(json_encode($miLista), true);               
            $sheet->row(1, [
                'N°', 'CODIGO', 'NOMBRE'
            ]); 
            $sheet->setBorder('A1:C1', 'thin');
            $sheet->cells('A1:C1', function($cells) { $cells->setFontWeight('bold');});
            //  $sheet->cells('F1', function($cells) { $cells->setFontWeight('bold');});
            $total=0;
            foreach($array as $index => $midatax) {
                $sheet->row($index+2, [
                    ($index+1), $midatax['code'], $midatax['name']
                    //Excel cv
                ]);	
                $col='A'.($index+2).':C'.($index+2);
                $sheet->setBorder($col, 'thin');
                $total++;
            }
            $col='A'.($total+1).':C'.($total+1);
            $sheet->setBorder($col, 'thin');
            
        });
        })->download('xls');
        
    }

}




