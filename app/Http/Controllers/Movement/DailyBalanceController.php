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


class DailyBalanceController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }

    public function getListDailyBalance(Request $request){
       
        //$id_pledge=$request->id_pledge;
        //$myfecha="2019-11-24";
      
        $marketx=$request->market;
        $myfecha=$request->date_now;
        $sqlx=" call daily_balance('$myfecha') ";
        //$sqlx=" call daily_balance('$id_branch_office','$marketx','$id_promoter','$myfecha','$namex') ";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    
    
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
        $date_pretty=$request->date_pretty;

        $sqlx=" call daily_collection_print($id_promoter,'$date_register') ";
        $listCust=DB::select($sqlx);
        $listCustomer = json_decode(json_encode($listCust), true);
        

        $page_format = array(
            'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 75, 'ury' => 180), 
            'Dur' => 3,  'trans' => array( 'D' => 1.5,  'S' => 'Split','Dm' => 'V','M' => 'O' ), 
            'PZ' => 1, 
        ); 
        
        //sumar desembolso  o monto
        $sumaMonto=0;
        $sumaMora=0;
        foreach ($listCustomer as $key => $value) {
            $sumaMonto += $value['monto'];
            $sumaMora += $value['mora'];
          }
        //fin de suma

        PDF::SetTitle('Comprobante El Tumi');
        PDF::SetFont('helvetica', '', 9);
        PDF::AddPage('P', 'A4', false, false); 
        //PDF::Write(0, 'COBRANZA DIARIA', '', 0, 'C', true, 0, false, false, 0);
         // $urlx = url('/img/logo-tumi.png');
          $urlx = storage_path().'/logo-tumi.png';
          // Storage::put('logo-tumi.png', $contents);
         // Storage::put('logo-tumi.png', $contents);
           $html = '
           <h3 style="text-align:center"><u>COBRANZA DIARIA</u></h3>
           <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td rowspan="4" style="width:80px"><img  style="width:60px; height:60px;" src="'.$urlx.'" alt="technoserve"  ></td>
                    <td style="width:130px"><b>Representante: </b></td>
                    <td><b>Sucursal : </b>'.$listCustomer[0]['sucursal'].' </td>
                    <td><b>Fecha : </b> '.$date_pretty.'</td>
                </tr>
                <tr>
                    <td style="width:130px" >'.$listCustomer[0]['promotor'].'</td>
                    <td><b>Mora: </b> '.$sumaMora.'</td>
                    <td><b>Mercado: </b> '.$listCustomer[0]['mercado'].'</td>
                </tr>
                <tr>
                    <td><b>Total de prestamos: </b> '.count($listCustomer).'</td>
                    <td><b>Capital : </b>'.$sumaMonto.'</td>
                    <td><b>Porcentaje de cobro : </b>'.round($listCustomer[0]['porcentaje'],0).'%</td>
                </tr>
            </table>
            ';
        $html .= '<br /><br /><br /><br />
            <font size="7" face="Courier New" >  
                <table cellspacing="0" cellpadding="2" border="1" >
                    <thead >                                   
                        <tr style="background-color:#F4F2F1;color:#2A2828;">
                            <th style="vertical-align: middle;">CODIGO</th>
                            <th style="vertical-align: middle;width:100px">NOMBRES</th>
                            <th style="vertical-align: middle;">FECHA DE PRÉSTAMO</th>
                            <th style="vertical-align: middle;">FECHA VENCE</th>
                            <th style="vertical-align: middle;width:35px">DIAS POR &nbsp;&nbsp;COBRAR</th>
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
                         $html .= '<td style="vertical-align: middle;width:35px;text-align:center" >'.$value['dias_x_cobrar'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px;text-align:right" >'.$value['monto'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['monto_total'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px" >'.$value['tasa'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px;text-align:right" >'.$value['mora'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['saldo'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:35px;text-align:right" >'.$value['cuota'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:35px;text-align:right" >'.$value['pago'].'</td>';
                         
                         $html .= '</tr>';
                }
              $html .='                    
                            </tbody>
                        </table>';  
        PDF::writeHTML($html, true, 0, true, 0);
        PDF::Output('hello_world.pdf');
         
    }
  

}




