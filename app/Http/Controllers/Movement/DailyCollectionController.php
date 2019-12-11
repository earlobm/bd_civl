<?php
namespace poi\Http\Controllers\Movement;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Movement;
use poi\EntityClass\Credit;
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


class DailyCollectionController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }

    public function getListDailyCollection(Request $request){
       
        //$id_pledge=$request->id_pledge;
        //$myfecha="2019-11-24";
      
        $id_branch_office=$request->id_branch_office;
        $marketx=$request->market;
        $id_promoter=$request->id_promoter;
        $myfecha=$request->date_now;
        $namex=$request->search;
        $sqlx=" call daily_collection('$id_branch_office','$marketx','$id_promoter','$myfecha','$namex') ";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    
    
    }
    public function save(Request $request){
        
        $idCredito= $request->idCredito;
        $monto= $request->monto;
        $fecha_vence= $request->fecha_vence;
        $cliente= $request->cliente;
        $idCliente= $request->idCliente;
        $saldo= $request->saldo;
        $mora= $request->mora;
        $idpromotor= $request->idpromotor;
        $fecha_registro= $request->fecha_registro;
        
        //haciendo las penejadas :v
        $query = "select id,total,amount_pending,mora_previous from movement where id_credit = $idCredito and date_register = '$fecha_registro' and alias_operation='PC' and state=1 ";
        $myquery=DB::select($query);
        $t = json_decode(json_encode($myquery), true);

        $pagoMora = 0;
        //si el el primer pago
        //fecha de hoy
        $date = date("Y-m-j H:i:s");
        $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
        $fecha_hoy = date ( 'Y-m-j' , $newDate); 
        $fechahora_hoy = date ( 'Y-m-j H:i:s' , $newDate); 
        //es el primer pago
        if(count($t)==0){
            if ($monto == 0) { return; }
            //
            $md = new Movement();
            $cred =  Credit::findOrFail($idCredito);
            //comparar mora
            $pagoMora = 0;
            //credito
            $md->mora_previous = 0;
            if ($mora > 0)
            {
                $pagoMora = $monto-$mora;
                //si queda debiendo la mora entonces pasamos la mora a su deuda principal
                if ($pagoMora < 0)
                {
                    $md->mora = $monto;
                    $cred->pay_mora = $monto;
                    //actualizamos el saldo y la fecha de vencimimento
                    $queryxz = "update credit set saldo = ($saldo + ($pagoMora * -1))
                    , date_expiration ='$fecha_hoy',mora=0,day_mora=0 where id =$idCredito";
                    DB::statement($queryxz);

                }
                if ($pagoMora >= 0)
                {
                    $md->mora = $mora; 
                    $cred->pay_mora = $mora;
                    //actualizamos el saldo y la fecha de vencimimento
                    $queryxz = "update credit set date_expiration ='$fecha_hoy',mora=0,day_mora=0 where id =$idCredito";
                    DB::statement($queryxz);
                }
                if ($pagoMora > 0)
                {
                    //state 2=cancelado
                    $md->capital = $pagoMora; 
                    $cred->saldo = ($saldo - $pagoMora);
                    if (($saldo - $pagoMora) <= 0) { $cred->state = 2; }
                }
                $md->mora_previous= $mora;
                }
                else
                {
                    $md->capital = $monto; 
                    $md->mora = 0;
                    //credito
                    $cred->saldo = ($saldo - $monto);
                    if (($saldo - $monto) <= 0) { $cred->state =2; }
                }
                $cred->save();

                $md->id_credit = $idCredito;
                $md->total = $monto;
                $md->mora_previous = $mora;
                $md->date_register =$fecha_registro;
                $md->date_previous =$fecha_vence;
                $md->date_system = $fechahora_hoy;
                $md->operation = "PAGO CUOTA";
                $md->alias_operation = "PC";
                $md->name_customer = $cliente;
                $md->id_customer = $idCliente;
                $md->state = 1;
                $md->amount_pending = $saldo;
                $md->id_promoter = $idpromotor;
                $md->save();
            }else{
               
                //actualizamos su pago
                ////eliminando
                $total = $t[0]['total'];
                if ($total != $monto)
                {
                    $idmovimiento =$t[0]['id'];
                    $datos=  $this->deletePayCredit($idmovimiento,$idCredito);
                    $separadas=array();
                    $separadas = explode(",",$datos);
                    var_dump($separadas);
                    $fecha_vencex  = $separadas[2];
                    $morax =  $separadas[1];
                    $saldox =  $separadas[0];

                     $this->paymentDayli($idCredito, $monto, $fecha_registro, $cliente, $idCliente,
                     $saldox, $morax, $idpromotor, $fecha_vencex);
                }
            }
    
            return 1;
            /* $DateOfRequest= date("Y-m-d H:i:s");
                $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
                
    }
    //pago diario
    public function paymentDayli( $idCredito, $monto, $fecha_registro, $cliente, $idCliente,
            $saldo, $mora, $idpromotor, $fecha_vence){
       
        
        //haciendo las penejadas :v
        $query = "select id,total,amount_pending,mora_previous from movement where id_credit = $idCredito and date_register = '$fecha_registro' and alias_operation='PC' and state=1 ";
        $myquery=DB::select($query);
        $t = json_decode(json_encode($myquery), true);

        $pagoMora = 0;
        //si el el primer pago
        //fecha de hoy
        $date = date("Y-m-j H:i:s");
        $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
        $fecha_hoy = date ( 'Y-m-j' , $newDate); 
        $fechahora_hoy = date ( 'Y-m-j H:i:s' , $newDate); 
        //es el primer pago
        if(count($t)==0){
            if ($monto == 0) { return; }
            //
            $md = new Movement();
            $cred =  Credit::findOrFail($idCredito);
            //comparar mora
            $pagoMora = 0;
            //credito
            $md->mora_previous = 0;
            if ($mora > 0)
            {
                $pagoMora = $monto-$mora;
                //si queda debiendo la mora entonces pasamos la mora a su deuda principal
                if ($pagoMora < 0)
                {
                    $md->mora = $monto;
                    $cred->pay_mora = $monto;
                    //actualizamos el saldo y la fecha de vencimimento
                    $queryxz = "update credit set saldo = ($saldo + ($pagoMora * -1))
                    , date_expiration ='$fecha_hoy',mora=0,day_mora=0 where id =$idCredito";
                    DB::statement($queryxz);

                }
                if ($pagoMora >= 0)
                {
                    $md->mora = $mora; 
                    $cred->pay_mora = $mora;
                    //actualizamos el saldo y la fecha de vencimimento
                    $queryxz = "update credit set date_expiration ='$fecha_hoy',mora=0,day_mora=0 where id =$idCredito";
                    DB::statement($queryxz);
                }
                if ($pagoMora > 0)
                {
                    //state 2=cancelado
                    $md->capital = $pagoMora; 
                    $cred->saldo = ($saldo - $pagoMora);
                    if (($saldo - $pagoMora) <= 0) { $cred->state = 2; }
                }
                $md->mora_previous= $mora;
                }
                else
                {
                    $md->capital = $monto; 
                    $md->mora = 0;
                    //credito
                    $cred->saldo = ($saldo - $monto);
                    if (($saldo - $monto) <= 0) { $cred->state =2; }
                }
                $cred->save();

                $md->id_credit = $idCredito;
                $md->total = $monto;
                $md->mora_previous = $mora;
                $md->date_register =$fecha_registro;
                $md->date_previous =$fecha_vence;
                $md->date_system = $fechahora_hoy;
                $md->operation = "PAGO CUOTA";
                $md->alias_operation = "PC";
                $md->name_customer = $cliente;
                $md->id_customer = $idCliente;
                $md->state = 1;
                $md->amount_pending = $saldo;
                $md->id_promoter = $idpromotor;
                $md->save();
            }
    
            return 1;
            /* $DateOfRequest= date("Y-m-d H:i:s");
                $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
                
    }
    public  function deletePayCredit($idmov,$idcredito){
             $queryxz = "update movement set state=0 where id=$idmov";
             DB::statement($queryxz);
            //obtener datos historiso
             $query = "select date_previous from movement where id=$idmov";
             $myquery=DB::select($query);
             $dt = json_decode(json_encode($myquery), true);
             $fecha_vence = $dt[0]['date_previous'];
            //actualizar
            $queryxz = " update credit set saldo=total-( select case when sum(total) is null then 0 
                        else sum(total) end  from movement where id_credit =$idcredito 
                         and alias_operation = 'PC' and state = 1),state=1,date_expiration='$fecha_vence',
                         day_mora=case when DATEDIFF(NOW(),date_expiration+1)>0  
                        then DATEDIFF(NOW(),date_expiration+1) else 0 end
                        , mora = round((0.00385) * case when DATEDIFF(NOW(),date_expiration+1)>0  
                        then DATEDIFF(NOW(),date_expiration+1) else 0 end * saldo, 1) 
                         where id = $idcredito";
            DB::statement($queryxz);
            //obteniendo los ultimos datos
            $query = "select saldo,mora,date_expiration from credit where id=$idcredito";
            $myquery=DB::select($query);
            $dt = json_decode(json_encode($myquery), true);
            
            return $dt[0]['saldo'].",".$dt[0]['mora'].",".$dt[0]['date_expiration'];
    }
   
    public function downloadDayliCollection(Request $request){
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
        //obteniendo los clientes
        $id_promoter=$request->id_promoter;
        $date_register=$request->date_register;

        $sqlx=" call daily_collection_print($id_promoter,'$date_register') ";
        $listCust=DB::select($sqlx);
        $listCustomer = json_decode(json_encode($listCust), true);
        

        $page_format = array(
            'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 75, 'ury' => 180), 
            'Dur' => 3,  'trans' => array( 'D' => 1.5,  'S' => 'Split','Dm' => 'V','M' => 'O' ), 
            'PZ' => 1, 
        ); 
        

        PDF::SetTitle('Comprobante El Tumi');
        PDF::SetFont('helvetica', '', 9);
        PDF::AddPage('P', 'A4', false, false); 
        PDF::Write(0, 'Cobranza Diaria', '', 0, 'L', true, 0, false, false, 0);
         // $urlx = url('/img/logo-tumi.png');
          $urlx = storage_path().'/logo-tumi.png';
          // Storage::put('logo-tumi.png', $contents);
         // Storage::put('logo-tumi.png', $contents);
           $html = '
           <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td rowspan="4"><img  style="width:60px; height:60px;" src="'.$urlx.'" alt="technoserve"  ></td>
                    <td>Representante: </td>
                    <td>Sucursal : '.$listCustomer[0]['sucursal'].' </td>
                    <td>Fecha : 09/12/2019</td>
                </tr>
                <tr>
                    <td >'.$listCustomer[0]['promotor'].'</td>
                    <td>Capital :550</td>
                    <td>Mercado: '.$listCustomer[0]['mercado'].'</td>
                    
                </tr>
                <tr>
                    <td>Total de prestamos: 51</td>
                    <td>Desembolso :550</td>
                    <td>Porcentaje de cobro :'.round($listCustomer[0]['porcentaje'],0).'%</td>
                </tr>
            </table>
            ';
        $html .= '<br /><br /><br /><br />
        <font size="8" face="Courier New" >
                <table cellspacing="0" cellpadding="2" border="1" >
                    <thead >                                                    
                        <tr style="background-color:#F4F2F1;color:#2A2828;">
                            <th style="vertical-align: middle;">CODIGO</th>
                            <th style="vertical-align: middle;width:100px">NOMBRES</th>
                            <th style="vertical-align: middle;">F. PRÉSTAMO</th>
                            <th style="vertical-align: middle;">F. VENCE</th>
                            <th style="vertical-align: middle;width:30px">DIAS X COBRAR</th>
                            <th style="vertical-align: middle;width:40px">MONTO</th>
                            <th style="vertical-align: middle;">MONTO TOTAL</th>
                            <th style="vertical-align: middle;width:40px">TASA</th>
                            <th style="vertical-align: middle;width:40px">MORA</th>
                            <th style="vertical-align: middle;">SALDO</th>
                            <th style="vertical-align: middle;width:35px">CUOTA</th>
                            <th style="vertical-align: middle;width:35px">PAGO</th>
                        </tr> 
                    </thead>
                    <tbody>
                ';
                $rows="";
                foreach ($listCustomer as $key => $value) {
                         $code=$value['code'];
                         $html .= '<tr  >';

                         $html .= '<td style="vertical-align: middle;" >'.$value['code'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:100px" >'.$value['nombres'].'</td>';
                         $html .= '<td style="vertical-align: middle;" >'.$value['fecha_prestamo'].'</td>';
                         $html .= '<td style="vertical-align: middle;" >'.$value['fecha_vencimiento'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:30px" >'.$value['dias_x_cobrar'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px" >'.$value['monto'].'</td>';
                         $html .= '<td style="vertical-align: middle;" >'.$value['monto_total'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px" >'.$value['tasa'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px" >'.$value['mora'].'</td>';
                         $html .= '<td style="vertical-align: middle;" >'.$value['saldo'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:35px" >'.$value['cuota'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:35px" >'.$value['pago'].'</td>';
                         
                         
                         $html .= '</tr>';
                           
                          
                }
              $html .='                    
                            </tbody>
                        </table>';  
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




