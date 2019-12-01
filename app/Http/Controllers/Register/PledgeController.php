<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Pledge;
use poi\EntityClass\Person;
use poi\EntityClass\DetailPledge;
use poi\EntityClass\MovementPledge;
use poi\EntityClass\DetailMovement;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class PledgeController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
        // 0 ELMINADO
        // 1 EMPEÑADO
        // 2 vencido
        // 3 en venta
        // 4 VENDIDO
        // 5 CANCELADO (YA PAGO)
    }

    public function getListActive(Request $request){
       
            $curre_pagex=$request->page;
            if($curre_pagex=='1'){
                $curre_pagex=0;
            }else{
                $curre_pagex=$curre_pagex-1;
                $curre_pagex=$curre_pagex*8;
            }
            $sqlx="";
            $buscar=$request->buscar;
           // $sqlx="select *,count(id) OVER() AS total from person where state='ACTIVO' and  concat(nro_doc,' ',names,' ',paternal_last_name,' ',maternal_last_name)  like '%$buscar%' order by id limit 8 offset $curre_pagex";
			$sqlx="SELECT p.id,
            concat(pe.names,' ', pe.paternal_last_name,' ',pe.maternal_last_name ) as nombres,
            p.capital,
            concat(p.date_init,' ',p.date_end ) as fechax,
            concat( EXTRACT( DAY FROM p.date_init ) ,'/',EXTRACT( MONTH FROM p.date_init ),'/', EXTRACT( YEAR FROM p.date_init ),' - ',EXTRACT( DAY FROM p.date_end ) ,'/',EXTRACT( MONTH FROM p.date_end ),'/', EXTRACT( YEAR FROM p.date_end )) as fecha,
            (SELECT GROUP_CONCAT(guaranty SEPARATOR ', ') from detail_pledge where id_pledge=p.id) as guaranty,
            (SELECT count(p.id) FROM pledge p
            inner join customer_pledge cp on cp.id=p.id_customer_pledge
            inner join person pe on pe.id=cp.id_person 
            where p.state=1 and pe.state=1 and
            concat(pe.number_doc,' ',pe.names,' ',pe.paternal_last_name,' ',pe.maternal_last_name)  like '%$buscar%') as total,
            p.total as totalamount,p.date_init,p.date_end,p.interest,p.tea, cp.id_person
            FROM pledge p
            inner join customer_pledge cp on cp.id=p.id_customer_pledge
            inner join person pe on pe.id=cp.id_person 
            WHERE p.state=1 and pe.state=1 and
            concat(pe.number_doc,' ',pe.names,' ',pe.paternal_last_name,' ',pe.maternal_last_name)  like '%$buscar%'
             order by p.id limit 8 offset $curre_pagex ";
    
            $lastPagex=0;
            $totalx=0;
            $datax=DB::select($sqlx);
            $t = json_decode(json_encode($datax), true);
            if(count($datax)>0){
                $lastPagex=intdiv((int)$t[0]['total'], 8);
                $cocientex=((int)$t[0]['total']%8);
                $totalx=(int)$t[0]['total'];
                if($cocientex>0){$lastPagex=$lastPagex+1;}  
            }
         
              return [
                     'pagination' => [
                    'total'        => $totalx,
                    'current_page' => $request->page,
                    'per_page'     => 8,
                    'last_page'    => $lastPagex,
                    'from'         => 1,
                    'to'           => 8,
                ],
                  'datax'=>$datax,
              ];
        
        
    }
    public function get_detail_movement_pledge(Request $request){
       
        $id_pledge=$request->id_pledge;
        $sqlx=" select *
          FROM detail_movement p  where p.state=1 and id_pledge=$id_pledge
         order by p.id ";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function get_movement_pledge(Request $request){
       
        $id_pledge=$request->id_pledge;
        $sqlx=" select *
          FROM movement_pledge p  where p.state=1 and id_pledge=$id_pledge
         order by p.id ";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function delete(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = Pledge::findOrFail($request->id);
        $clasex->state = 0;
    //$clasex->update_user ='Eliminado '. $DateOfRequest;
        $clasex->save();
    
    }

    public function save(Request $request){
        $date = date("Y-m-j H:i:s");
        $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
        $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

        $clasex = new Pledge();
        $clasex->id_user = Auth::user()->id;
        //$clasex->id_type_doc = $request->id_type_doc;
        $clasex->id_customer_pledge = $request->idcustomerpledge;
        $clasex->date_init =$request->date_init;
        $clasex->date_end = $request->date_end;
        $clasex->total = $request->total;
        $clasex->state = 1;
        $clasex->capital =  $request->capital;
        $clasex->interest = $request->interest;
        $clasex->period = $request->period;
        $clasex->term = $request->term;
        $clasex->tea = $request->tea;
        $clasex->date_system =$newDate;
        //$DateOfRequest= date("Y-m-d H:i:s");
        $clasex->save(); 

        $t = json_decode(json_encode($request->detail_pledge), true);
        foreach ($t as $key => $value) {
            $controller = new DetailPledge();
            $controller->date_init=$request->date_init;
            $controller->date_end = $request->date_end;
            $controller->capital = $value['capital'];
            $controller->interest = $value['interest'];
            $controller->total =($value['capital']+$value['interest']);
            $controller->state =1;
            $controller->guaranty = strtoupper ( $value['guaranty']);
            $controller->characteristic =strtoupper ( $value['characteristic']);
            $controller->note =strtoupper ($value['note']);
            $controller->licence_plate =strtoupper ($value['licence_plate']);
            $controller->serie =strtoupper ($value['serie']);
           // $controller->id_person = $request->id_customer;
            $controller->id_pledge = $clasex->id;
            $controller->id_dependence = $value['id_guaranty'];
            $controller->period = $request->period;
            $controller->term = $request->term;
            $controller->tea = $request->tea;
            $controller->id_warehouse = $request->id_warehouse;
            $controller->save(); 
        }
        //registrando en MovementPledge
            $controllerx = new MovementPledge();
            $controllerx->number_operation='PR0001';
            $controllerx->capital = $request->capital;
            $controllerx->interest = $request->interest;
            $controllerx->date_movement =$request->date_init;
            $controllerx->date_system = $newDate;
            $controllerx->operation = "PRESTAMO";
            $controllerx->state = 1;
            $controllerx->type = "PR";
            $controllerx->id_customer = $request->idcustomerpledge;
            $controllerx->id_pledge = $clasex->id;
            $controllerx->save(); 
        //registrando en movimiento el capital
            $controller = new DetailMovement();
            $controller->date_init=$request->date_init;
            $controller->date_end = $request->date_end;
            $controller->type = "P";
            $controller->operation = "PRÉSTAMO";
            $controller->charge = $request->capital;
            $controller->payment = 0;
            $controller->residue = $request->capital;
            $controller->state = 1;
            $controller->period = $request->period;
            $controller->term = $request->term;
            $controller->tea = $request->tea;
            $controller->id_pledge = $clasex->id;
            $controller->id_movement_pledge = $controllerx->id;
            $controller->save(); 
            //registrando en movimiento el interes
            $controller = new DetailMovement();
            $controller->date_init=$request->date_init;
            $controller->date_end = $request->date_end;
            $controller->type = "IG";
            $controller->operation = "INTERÉS GENERADO";
            $controller->charge = $request->interest;
            $controller->payment = 0;
            $controller->residue = $request->total;
            $controller->state = 1;
            $controller->period = $request->period;
            $controller->term = $request->term;
            $controller->tea = $request->tea;
            $controller->id_pledge = $clasex->id;
            $controller->id_movement_pledge = $controllerx->id;
            $controller->save(); 
        return $clasex->id;
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
            
    }
    public function dowloadContract(Request $request){
        
        $templateProcessor =new \PhpOffice\PhpWord\TemplateProcessor('doc/Contrato.docx');   
        $templateProcessor->setValue('parametronombre', $request->name_customer);
        $templateProcessor->setValue('dnix', $request->nro_doc);
        $templateProcessor->setValue('codex', '00007');
        $templateProcessor->setValue('dateinitx',$request->dateinit);
        $templateProcessor->setValue('dateendx',$request->dateend);
        
       $wordDocumentFile = $templateProcessor->save();
       $headers = [
                   'Content-Type' => 'application/msword',
                   'Cache-Control' => 'max-age=0'
               ];
               return response()->download($wordDocumentFile, 'Contrato.docx', $headers);
      
    }

    public function downloadProgram(Request $request){    
        
        $sqlx="";
        if(isset($request->id_program)){
            $id=$request->id_program;
            $sqlx="select * from budget_program where id_program=$id ";
        }else{
            $buscar=$request->buscar;
            $sqlx="select * from budget_program where active='t'  and concat(code,' ', name) like ('%$buscar%')  order by name";
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

    public function list_data(Request $request){       
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }
        $sqlx="";
        $buscar=$request->search;
        $sqlx="SELECT pe.number_doc as dni,
        concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name) as cliente,
        d.name as producto,
        dp.characteristic as caracteristicas,
        dp.note as observaciones,
        dp.interest as interes,
        dp.capital,
        dp.suggested_price,
        dp.date_init as fecha_inicial,
        dp.date_end as fecha_final
        FROM pledge p
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN person pe ON pe.id=cp.id_person
        WHERE dp.state in (1,2,3)
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%'
        order by p.id limit 8 offset $curre_pagex ";
        $listOnSales = DB::select($sqlx);

        $sqltotal="SELECT COUNT(p.id) as cant FROM pledge p
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN person pe ON pe.id=cp.id
        WHERE dp.state in (1,2,3)
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%' ";
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
            'datax'=>$listOnSales,
        ];
    }

    public function list_on_sale(Request $request){       
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }
        $sqlx="";
        $buscar=$request->search;
        $sqlx="SELECT dp.id, pe.number_doc as dni,
        concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name) as cliente,
        d.name as producto,
        dp.characteristic as caracteristicas,
        dp.note as observaciones,
        dp.interest as interes,
        dp.capital,
        dp.suggested_price,
        dp.date_init as fecha_inicial,
        dp.date_end as fecha_final
        FROM pledge p
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN person pe ON pe.id=cp.id_person
        WHERE dp.state=3
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%'
        order by p.id limit 8 offset $curre_pagex ";
        $listOnSales = DB::select($sqlx);

        $sqltotal="SELECT COUNT(p.id) as cant FROM pledge p
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN person pe ON pe.id=cp.id
        WHERE dp.state=1
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%' ";
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
            'datax'=>$listOnSales,
        ];
    }

    public function list_pawned(Request $request){       
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }
        $sqlx="";
        $buscar=$request->search;
        $sqlx="SELECT pe.number_doc as dni,
        concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name) as cliente,
        d.name as producto,
        dp.characteristic as caracteristicas,
        dp.note as observaciones,
        dp.interest as interes,
        dp.capital,
        dp.date_init as fecha_inicial,
        dp.date_end as fecha_final
        FROM pledge p
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN person pe ON pe.id=cp.id_person
        WHERE dp.state=1
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%'
        order by p.id limit 8 offset $curre_pagex ";
        $listOnSales = DB::select($sqlx);

        $sqltotal="SELECT COUNT(p.id) as cant FROM pledge p
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN person pe ON pe.id=cp.id
        WHERE dp.state=1
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%' ";
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
            'datax'=>$listOnSales,
        ];
    }

    public function list_defeated(Request $request){       
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }
        $sqlx="";
        $buscar=$request->search;
        $sqlx="SELECT p.id, pe.number_doc as dni,
        concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name) as cliente,
        d.name as producto,
        dp.characteristic as caracteristicas,
        dp.note as observaciones,
        dp.interest as interes,
        dp.capital,
        dp.date_init as fecha_inicial,
        dp.date_end as fecha_final
        FROM pledge p
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN person pe ON pe.id=cp.id_person
        WHERE dp.state=2
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%'
        order by p.id limit 8 offset $curre_pagex ";
        $listOnSales = DB::select($sqlx);

        $sqltotal="SELECT COUNT(p.id) as cant FROM pledge p
        INNER JOIN customer_pledge cp on cp.id=p.id_customer_pledge
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        INNER JOIN person pe ON pe.id=cp.id
        WHERE dp.state=1
        and concat(pe.names, ' ', pe.paternal_last_name, ' ', pe.maternal_last_name,' ', d.name,' ', dp.characteristic)  like '%$buscar%' ";
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
            'datax'=>$listOnSales,
        ];
    }

    public function send_to_sales(Request $request){       
        $id=$request->id;        
        $sqlx="SELECT id, capital+capital*0.1 as suggested_price
        FROM detail_pledge WHERE state=2 AND id=$id";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
        ];        
    }
    // Obtener info del producto a vender
    public function product_sales(Request $request){       
        $id=$request->id;        
        $sqlx="SELECT dp.id, 
        d.name as producto,
        dp.characteristic as caracteristicas,
        dp.suggested_price
        FROM pledge p
        INNER JOIN detail_pledge dp ON dp.id_pledge=p.id
        INNER JOIN dependence d ON d.id=dp.id_dependence
        WHERE dp.state=3 and dp.id=$id";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
        ];        
    }
    public function save_suggested_price(Request $request){
        if($request->id==-1){
            $clasex = new DetailPledge();
        }else{
            $clasex = DetailPledge::findOrFail($request->id);
        }
        
        $clasex->suggested_price = $request->suggested_price;
        $clasex->state = 3;
        
        //$DateOfRequest= date("Y-m-d H:i:s");
    
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
            
    }
    public function save_final_price(Request $request){
        if($request->id==-1){
            $clasex = new DetailPledge();
        }else{
            $clasex = DetailPledge::findOrFail($request->id);
        }        
        $clasex->final_price = $request->final_price;      
        $clasex->state = 4;  
        //$DateOfRequest= date("Y-m-d H:i:s");    
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/        
        $dni=$request->nro_doc;
        $sqlx="select * from person where number_doc='$dni' ";
        $miArrayx = DB::select($sqlx);
        $miArray = json_decode(json_encode($miArrayx), true);
        if(count($miArray)==0){
            $clasey = new Person();
            $clasey->number_doc = trim($request->nro_doc);
            $clasey->paternal_last_name = trim($request->paternal_last_name);
            $clasey->maternal_last_name =trim($request->maternal_last_name);
            $clasey->names = trim($request->name);
            $clasey->address = $request->address;
            $clasey->save();  
                        
        } 
    }
}




