<?php
namespace poi\Http\Controllers\Operation;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Pledge;
use poi\EntityClass\DetailPledge;
use poi\EntityClass\MovementPledge;
use poi\EntityClass\DetailMovement;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;
use PDF; // at the top of the file
use poi\Http\Controllers\Util\StateController;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class PaymentPledgeController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
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
			$sqlx=" select p.id,concat(pe.names,' ', pe.paternal_last_name,' ',pe.maternal_last_name ) as nombres,
            p.capital,concat(p.date_init,' ',p.date_end ) as fechax,
            concat( EXTRACT( DAY FROM p.date_init ) ,'/',EXTRACT( MONTH FROM p.date_init ),'/',
            EXTRACT( YEAR FROM p.date_init ),' - ',EXTRACT( DAY FROM p.date_end ) ,'/',EXTRACT( MONTH FROM p.date_end ),'/',
            EXTRACT( YEAR FROM p.date_end )) as fecha,

            (select GROUP_CONCAT(guaranty SEPARATOR ', ') from detail_pledge where id_pledge=p.id) as guaranty,

             (SELECT count(p.id) FROM pledge p
            inner join person pe on pe.id=p.id_person where p.state=1 and pe.state=1 and
              concat(pe.number_doc,' ',pe.names,' ',pe.paternal_last_name,' ',pe.maternal_last_name)  like '%$buscar%') as total,

              p.total as totalamount,p.date_init,p.date_end,p.interest,p.tea
             
              FROM pledge p
            inner join person pe on pe.id=p.id_person where p.state=1 and pe.state=1 and
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
    public function get_movement_pledge(Request $request){
       
        $id_pledge=$request->id_pledge;
        
       // $sqlx="select *,count(id) OVER() AS total from person where state='ACTIVO' and  concat(nro_doc,' ',names,' ',paternal_last_name,' ',maternal_last_name)  like '%$buscar%' order by id limit 8 offset $curre_pagex";
        $sqlx=" select *
          FROM detail_movement p  where p.state=1 and id_pledge=$id_pledge
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
        $mystate = new StateController(); 
        //$DateOfRequest= date("Y-m-d H:i:s");
       
        //registrando en MovementPledge
            $controllerx = new MovementPledge();
            $controllerx->number_operation='PR0001';

            $controllerx->capital = $request->amountPayment;
            $controllerx->interest = $request->interest;
            $controllerx->date_movement =$request->dateModePayment;

            
            $date = date("Y-m-j H:i:s");
            $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
            $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

            $controllerx->date_system = $newDate;
            $controllerx->operation = $request->operation;
            $controllerx->state = 1;
            $controllerx->type = "PC";
            $controllerx->id_customer = $request->id_customer;
            $controllerx->id_pledge = $request->id_pledge;
            $controllerx->save(); 
        //registrando en movimiento el capital
            $controller = new DetailMovement();
            $controller->date_init=$request->dateModePayment;
            
            if($request->operation=="Interes")
            {   
                $controller->operation = "PAGO DE INTERES";
                $controller->type = "PI";
            }
            if($request->operation=="Liquidacion")
            {
                $controller->operation = "LIQUIDACIÓN";
                $controller->type = "LI";
                //ACTUALIZAMOS LA PRENDA Y EL DETALLE A CANCELADO
                $clasex = Pledge::findOrFail($request->id_pledge);
                $clasex->state=$mystate->statePledgepaid;
                $clasex->save();
                //actualizando el detalle de la prenda
                DB::table('detail_pledge')
                ->where('id_pledge', $request->id_pledge)
                ->update(['state' => $mystate->statePledgepaid]);
            }
            $controller->charge = 0;
            $controller->payment = $request->amountPayment;
            $controller->residue = $request->residue;
            $controller->state = 1;
            $controller->id_pledge =  $request->id_pledge;
            $controller->id_movement_pledge = $controllerx->id;
            $controller->save(); 
            //registrando en movimiento el interes
            
        return 1;
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
            
    }
   

    public function ticket_plegde(Request $request){
        //obteniendo los datos de la compañia
        
        $sqltotal="select * from company";
        $total=DB::select($sqltotal);
        $t = json_decode(json_encode($total), true);
        $name_company=$t[0]['name_company'];
        $name_company1=$t[0]['name_company1'];
        $ruc=$t[0]['ruc'];
        $address=$t[0]['address'];
        $phone=$t[0]['phone'];
        $phrase=$t[0]['phrase'];
        $url_logo=$t[0]['url_logo'];

        $page_format = array(
            'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 75, 'ury' => 180), 
            'Dur' => 3,  'trans' => array( 'D' => 1.5,  'S' => 'Split','Dm' => 'V','M' => 'O' ), 
            'PZ' => 1, 
        ); 
        
        $fecha = $request->date_movement;
        $newDate = date("d/m/Y", strtotime($fecha));
        $hora2="";
         if(isset($request->date_system)){
            $hora = $request->date_system;
            $hora2 = date("H:i:s", strtotime($hora));
         }else{
            $date = date("Y-m-j H:i:s");
            $newDatex = strtotime ( '-5 hour' , strtotime ($date) ) ; 
            $newDatex = date ( 'H:i:s' , $newDatex); 
            $hora2 = $newDatex;
         }

        $capital=0;
        $interest = $request->interest;
        $capital = $request->capital;
        $name_customer = $request->name_customer;
        
        $type_operation = "RECIBO DE EMPEÑO";
        $html1="<br>PRÉSTAMO: S/  $capital 
                <br>INTERÉS: S/  $interest 
        ";
        
        
        if(isset($request->type)){
            if($request->type=="Interes")
            {$type_operation = "PAGO DE INTERES";
            $html1=" <br>MONTO: S/ $capital ";}
            if($request->type=="Liquidacion")
            {$type_operation = "LIQUIDACIÓN";
            $html1=" <br>MONTO: S/ $capital ";}
         }

        PDF::SetTitle('Comprobante El Tumi');
        PDF::SetFont('helvetica', '', 9);
        PDF::AddPage('P', $page_format, false, false); 
         // $urlx = url('/img/logo-tumi.png');
          $urlx = storage_path().'/logo-tumi.png';
         // Storage::put('logo-tumi.png', $contents);
           $html = '
            <div align="center" style="padding-bottom: 1px;margin-bottom: 1px;">
                <img  style="width:60px; height:60px;" src="'.$urlx.'" alt="technoserve"  >
                <p align="center"><font size="8"> <b> '.$name_company.' </b> 
                    <br> <b> '.$name_company1.'</b> 
                    </font> 
                </p>
                <p align="center">
                    <font size="7">RUC : '.$ruc.'
                    <br> '.$address.'
                    <br> '.$phone.' 
                    <br> 
                    <br> 
                    </font> 

                    <font size="7">
                    FECHA : '.$newDate.' &nbsp;&nbsp;&nbsp;HORA : '.$hora2.'
                    <br> N° OPERACIÓN: 20110002
                    <br>
                    <br> <u><b>'. $type_operation.'</b></u>
                    </font>
                 </p>

                 <p align="left">
                    <font size="7">
                    <br>CLIENTE: '.$name_customer.'
                    '.$html1.'
                    <br>___________________________________
                    <br>TOTAL A PAGAR: S/ '.($interest+$capital).'
                    </font>
                 </p>
            </div>

            <p align="center"><font size="7"> '.$phrase.'
            </font> </p>
            ';
        
        PDF::writeHTML($html, true, 0, true, 0);
        PDF::Output('hello_world.pdf');
         

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

    

   
}




