<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Market;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class MarketController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }    

    public function save(Request $request){
        if($request->id==-1){
            $clasex = new Market();
        }else{
            $clasex = Market::findOrFail($request->id);
        }        
        $clasex->code = $request->code;
        $clasex->name = $request->name;
        $clasex->date_creation = $request->date_creation;
        $clasex->state = "1";
        $clasex->id_person =  $request->id_person;
        $clasex->id_branch_office = $request->id_branch_office;
        //$DateOfRequest= date("Y-m-d H:i:s");
    
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
            
    }

    public function editMercado(Request $request){
        $queyListEmploye="select mer.id_person,mer.date_creation,mer.id_branch_office,mer.id,mer.code,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc,su.name as name_sucursal,mer.name as name_mercado
        from tumi.branch_office su 
        inner join tumi.market mer on su.id=mer.id_branch_office 
        inner join tumi.employee em on mer.id=em.id_market
        inner join tumi.person per on per.id= em.id_person
        where su.state=1
        and mer.state=1 and em.state=1 and per.state=1 and mer.id='$request->id'";
        $listEmploye = DB::select($queyListEmploye);
        return [
            'datax'=>$listEmploye
        ];
    }

    public function combo_list(Request $request){
        $queyDependency="SELECT id, name FROM market where state='1' order by name";
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
        $search=$request->search_market;
        $sqlx="SELECT m.id,m.code, m.name, m.date_creation, b.name as name_branch_office, 
        concat(p.number_doc,' ', p.names, ' ', p.paternal_last_name, ' ', p.maternal_last_name) as personal 
        FROM market m 
        INNER JOIN branch_office b ON b.id=m.id_branch_office 
        INNER JOIN person p ON p.id=m.id_person
        WHERE m.state=1 and p.state=1 and concat(m.code,' ', m.name,' ', p.number_doc,' ', p.names, ' ', p.paternal_last_name, ' ', p.maternal_last_name)  like '%$search%' order by m.name limit 8 offset $curre_pagex";        
        $datax=DB::select($sqlx);
        
        $sqltotal="SELECT count(m.id) as total from market m 
        INNER JOIN branch_office b ON b.id=m.id_branch_office 
        INNER JOIN person p ON p.id=m.id_person 
        where m.state=1 and p.state=1 and concat(m.code,' ', m.name,' ', p.number_doc,' ', p.names, ' ', p.paternal_last_name, ' ', p.maternal_last_name) like '%$search%' ";
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
    public function deleteMercado(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = Market::findOrFail($request->id);
        $clasex->state =0;
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




