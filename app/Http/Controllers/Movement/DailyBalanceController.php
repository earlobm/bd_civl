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

        $id_branch_office=$request->id_branch_office;
        $marketx=$request->market;
        $id_promoter=$request->id_promoter;
        $myfecha=$request->date_now;
        $namex=$request->search;
      
        $sqlx=" call daily_balance('$id_branch_office','$marketx','$id_promoter','$namex','$myfecha') ";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    
    
    }
 
 
    public function downloadPdf(Request $request){
        //obteniendo los datos de la compañia
        
        $id_branch_office=$request->id_branch_office;
        $marketx=$request->market;
        $id_promoter=$request->id_promoter;
        $myfecha=$request->date_now;
        $namex=$request->search;

        $date_pretty=$request->date_pretty;
        
      
        $sqlx=" call daily_balance('$id_branch_office','$marketx','$id_promoter','$namex','$myfecha') ";
        
        $listCust=DB::select($sqlx);
        $listCustomer = json_decode(json_encode($listCust), true);
        
        //fin de suma

        PDF::SetTitle('Balance Diario');
        PDF::SetFont('helvetica', '', 9);
        PDF::AddPage('L', 'A4', false, false); 
        //PDF::Write(0, 'COBRANZA DIARIA', '', 0, 'C', true, 0, false, false, 0);
         // $urlx = url('/img/logo-tumi.png');
          $urlx = storage_path().'/logo-tumi.png';
          // Storage::put('logo-tumi.png', $contents);
         // Storage::put('logo-tumi.png', $contents);
           $html = '
           <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td rowspan="4" style="width:80px"><img  style="width:60px; height:60px;" src="'.$urlx.'" alt="technoserve"  ></td>
                    <td style="width:130px"><b>BALANCE DIARIO </b></td>
                    <td style="width:130px"><b> </b></td>
                </tr>
                 <tr>
                    <td style="width:130px" >Fecha: '.$date_pretty.' </td>
                    <td><b> </b> </td>
                </tr>
             
            </table>
            ';
        $html .= '<br /><br /><br /><br />
            <font size="7" face="Courier New" >  
                <table cellspacing="0" cellpadding="2" border="1" >
                    <thead >                                   
                        <tr style="background-color:#F4F2F1;color:#2A2828;">
                            <th style="vertical-align: middle;">MERCADO</th>
                            <th style="vertical-align: middle;width:130px">PROMOTOR</th>
                            <th style="vertical-align: middle;">TOTAL</th>
                            <th style="vertical-align: middle;">PRESTAMO</th>
                            <th style="vertical-align: middle;width:35px">COBRO</th>
                            <th style="vertical-align: middle;width:40px">GASTOS ADMIN</th>
                            <th style="vertical-align: middle;">CENTRAL DE RIESGO</th>
                            <th style="vertical-align: middle;width:40px">MORA</th>
                            <th style="vertical-align: middle;width:60px">SOBRANTE</th>
                            <th style="vertical-align: middle;">FALTANTE</th>
                            <th style="vertical-align: middle;width:60px">ADELANTO FALTANTE</th>
                            <th style="vertical-align: middle;width:60px">T.ENTREGADO</th>
                            <th style="vertical-align: middle;width:60px">PANDERO</th>
                        </tr> 
                    </thead>
                    <tbody>
                    
                ';
                $rows="";
                foreach ($listCustomer as $key => $value) {
                        
                         $html .= '<tr>';
                         $html .= '<td style="vertical-align: middle;" >'.$value['mercado'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:130px" >'.$value['nombres'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['total'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['total_prestamo'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:35px;text-align:right" >'.$value['total_cobro'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:40px;text-align:right" >'.$value['total_gasto_admin'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['central_riesgo'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right;width:40px" >'.$value['total_mora'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:60px;text-align:right" >'.$value['total_sobrante'].'</td>';
                         $html .= '<td style="vertical-align: middle;text-align:right" >'.$value['total_faltante'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:60px;text-align:right" >'.$value['adelanto_faltante'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:60px;text-align:right" >'.$value['total_entregado'].'</td>';
                         $html .= '<td style="vertical-align: middle;width:60px;text-align:right" >'.$value['pandero'].'</td>';
                         $html .= '</tr>';
                }
              $html .='</tbody>
                    </table>';  
        PDF::writeHTML($html, true, 0, true, 0);
        PDF::Output('Balance_Diario.pdf');
         
    }
  

}




