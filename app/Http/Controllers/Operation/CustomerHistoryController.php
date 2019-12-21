<?php
namespace poi\Http\Controllers\Operation;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Person;
use poi\EntityClass\CustomerCredit;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
use poi\EntityClass\CustomerTypeDocument; // at the top of the file
use poi\Http\Controllers\Util\Curlx;
use poi\EntityClass\DetailCredit;
use poi\EntityClass\Credit;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class CustomerHistoryController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }
    
    public function getDataByRucSunatNew(Request $request){
        $ruc=$request->ruc;
        $this->cc = new Curlx();
        $this->cc->setReferer( "http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/frameCriterioBusqueda.jsp" );
        $this->cc->useCookie( true );
        $this->cc->setCookiFileLocation( __DIR__ . "/cookie.txt" );
        //obteneidendo randows
        $url = "http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/captcha?accion=random";
        $numRand = $this->cc->send($url);
        //20604720746 de pixel
        $data = array(
            "nroRuc" => $ruc,
            "accion" => "consPorRuc",
            "numRnd" => $numRand
        );
        $url = "http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias";
        $page = $this->cc->send( $url, $data );
    
        //RazonSocial
        $patron='/<input type="hidden" name="desRuc" value="(.*)">/';
        $output = preg_match_all($patron, $page, $matches, PREG_SET_ORDER);
        $RS="";
        if(isset($matches[0]))
        {
            $RS = utf8_encode(str_replace('"','', ($matches[0][1])));
            $RS=trim($RS);
        }
        //direccion
        $patron='/<td class="bgn"[ ]*colspan=1[ ]*>Direcci&oacute;n del Domicilio Fiscal:[ ]*<\/td>\r\n[\t]*[ ]+<td class="bg" colspan=[1|3]+>(.*)<\/td>/';
        $output = preg_match_all($patron, $page, $matches, PREG_SET_ORDER);
        $rtn="";
        if( isset($matches[0]) )
        {
            $rtn = trim($matches[0][1]);
        }
        
        //return $RS.'-dir-'.$rtn;
       // print $obj->razon_social;
        return [
            'nombres' => $RS,
            'direccion'=>$rtn
        ];
    }
  
    public function list_customer(Request $request){
       
            $curre_pagex=$request->page;
            if($curre_pagex=='1'){
                $curre_pagex=0;
            }else{
                $curre_pagex=$curre_pagex-1;
                $curre_pagex=$curre_pagex*8;
            }
            $sqlx="";
            $buscar=$request->buscar;
            $sqlx="SELECT p.id, p.code, p.id_type_document, p.number_doc,p.names,p.paternal_last_name,
            p.maternal_last_name, p.email,
            p.address,p.phone,p.id_district, p.reference,
            (select count(id) from credit 
                where id_customer=c.id
                and state=1) as cred_active, 
            (select count(id) from credit 
                where id_customer=c.id
                and state=2) as cred_cancel,
            c.id as id_customer_credit,
            (select count(p.id) 
            from person p inner join customer c on c.id_person=p.id 
            where c.state=1 and  concat(p.number_doc,' ',p.names,' ',p.paternal_last_name,' ',p.maternal_last_name) like '%$buscar%') AS total 
            from person p 
            inner join customer c on c.id_person=p.id 
            where c.state=1 and  concat(p.number_doc,' ',p.names,' ',p.paternal_last_name,' ',p.maternal_last_name)  like '%$buscar%' order by c.id limit 8 offset $curre_pagex";
    
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
    public function creditByCustomer(Request $request){
       
        $sqlx="";
        $sqlxdetail="";

        $detailCredit="";

        $id_customer="";
        $id_credit="";
        if(isset($request->id_customer))
        {
            $id_customer=$request->id_customer;
            $sqlx="SELECT id,code_credit from credit where id_customer=$id_customer";
        }else{
            $id_credit=$request->id_credit;
            $sqlx="SELECT * from credit where id=$id_credit";
            //obtiendo los detalles
            $sqlxdetail="SELECT * from detail_credit where id_credit=$id_credit";
            $detailCredit=DB::select($sqlxdetail);
        }

        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
              'detailCredit'=>$detailCredit
          ];
    
    
}

    public function generate_code(Request $request){    
        $fecha =date("Y");   
        $fecha=substr($fecha,2,3); 
        $sqlx ="";
        $sqlx = "SELECT CONCAT($fecha,right(CONCAT('000000', (COUNT(cp.id) + 1)),6)) as code
        FROM person p INNER JOIN customer cp ON cp.id_person=p.id";
        $miArrayx=DB::select($sqlx);
        $miArray = json_decode(json_encode($miArrayx), true);
        // if(count($miArray)>0){
        //     $nombre = $miArray[0]['user'];            
        // }
        return [
           // 'datax' => $nombre
            'datax' => $miArray
        ];
    }
  

    public function download_detail_credit(Request $request){
        //obteniendo los clientes
        $id_credit=$request->id;

        $sqlz="SELECT concat(names,' ', paternal_last_name,' ', maternal_last_name) as customer,
        number_doc, cr.number_quota, cr.period, cr.amount_admin,
        cr.capital, cr.interest_rate, DATE_FORMAT(cr.date_credit,'%d/%m/%Y') as date_credit
         from credit cr
        inner join customer cu on cu.id=cr.id_customer
        inner join person p on p.id=cu.id_person
        where cr.id=$id_credit";
        $listCustomer=DB::select($sqlz);
        $listCustomerCredit = json_decode(json_encode($listCustomer), true);
        
        $sqlx="SELECT number_quota, DATE_FORMAT(date_expired,'%d/%m/%Y') as date_expired, quota, capital, interest,
        saldo_projected  from detail_credit where id_credit=$id_credit";
        $listSchedule=DB::select($sqlx);
        $listScheduleCredit = json_decode(json_encode($listSchedule), true);

        PDF::SetTitle('Cronograma de Pagos');
        PDF::SetFont('helvetica', '', 9);
        PDF::AddPage('P', 'A4', false, false); 
        //PDF::Write(0, 'COBRANZA DIARIA', '', 0, 'C', true, 0, false, false, 0);
        //$urlx = url('/img/logo-tumi.png');
        $urlx = storage_path().'/logo-tumi.png';
        // Storage::put('logo-tumi.png', $contents);
        // Storage::put('logo-tumi.png', $contents);
        $html = '
        <h3 style="text-align:center"><u>CRONOGRAMA DE PAGOS</u></h3>
        <table cellspacing="0" cellpadding="1" border="0">
            <tr>
                <td rowspan="4" style="width:80px">
                    <img  style="width:60px; height:60px;" src="'.$urlx.'" alt="technoserve" >
                </td>
                <td colspan="2">
                    <b>DNI : </b> '.$listCustomerCredit[0]['number_doc'].' 
                </td>
                <td colspan="3">
                    <b>CLIENTE : </b>'.$listCustomerCredit[0]['customer'].' 
                </td>
            </tr>
            <tr>                
                <td colspan="2">
                    <b>MONTO: </b> S/ '.$listCustomerCredit[0]['capital'].'</td>
                <td colspan="2">
                    <b>TASA DE INTERÉS: </b> '.$listCustomerCredit[0]['interest_rate'].' %
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>GASTO ADMINISTRATIVO: </b> '.$listCustomerCredit[0]['amount_admin'].'
                </td>
                <td>
                    <b>PLAZO: </b> '.round($listCustomerCredit[0]['number_quota'],0).' '.$listCustomerCredit[0]['period'].'
                </td>
            </tr>
            <tr>
                
                <td colspan="3">
                    <b>FECHA DE DESEMBOLSO : </b>'.$listCustomerCredit[0]['date_credit'].'
                </td>
            </tr>
        </table>
        ';
        $html .= '<br/><br/>
            <font size="7" face="Courier New" >  
                <table cellspacing="0" cellpadding="2" border="1" >
                    <thead >                                   
                        <tr style="background-color:#EEE; color:#000;">
                            <th style="text-align: center;vertical-align: middle;">N°</th>
                            <th style="text-align: center;vertical-align: middle;">FECHA DE VENCIMIENTO</th>
                            <th style="text-align: center;vertical-align: middle;">CUOTA</th>
                            <th style="text-align: center;vertical-align: middle;">CAPITAL</th>
                            <th style="text-align: center;vertical-align: middle;">INTERES</th>
                            <th style="text-align: center;vertical-align: middle;">ABONO</th>
                            <th style="text-align: center;vertical-align: middle;">SALDO PROYECTADO</th>
                        </tr> 
                    </thead>
                    <tbody>
                    
                ';
                $rows="";
                $total_quota=0;
                $total_capital=0;
                $total_interest=0;
                foreach ($listScheduleCredit as $key => $value) {
                         $html .= '<tr>';
                         $html .= '<td style="text-align: center;vertical-align: middle;">'.$value['number_quota'].'</td>';
                         $html .= '<td style="text-align: center;vertical-align: middle;">'.$value['date_expired'].'</td>';
                         $html .= '<td style="text-align: right;vertical-align: middle;">'.$value['quota'].'</td>';
                         $html .= '<td style="text-align: right;vertical-align: middle;">'.$value['capital'].'</td>';
                         $html .= '<td style="text-align: right;vertical-align: middle;">'.$value['interest'].'</td>';
                         $html .= '<td style="text-align: center;vertical-align: middle;"></td>';
                         $html .= '<td style="text-align: right;vertical-align: middle;">'.$value['saldo_projected'].'</td>';                         
                         $html .= '</tr>';
                        $total_quota += ($value['quota']);
                        $total_capital += ($value['capital']);
                        $total_interest += ($value['interest']);

                }
                $html .= '<tr>';
                $html .= '<td colspan="2" style="text-align: right;vertical-align: middle; background-color:#EEE; color:#000;">TOTAL</td>';
                $html .= '<td style="text-align: right;vertical-align: middle;">'.$total_quota.'</td>';
                $html .= '<td style="text-align: right;vertical-align: middle;">'.$total_capital.'</td>';
                $html .= '<td style="text-align: right;vertical-align: middle;">'.$total_interest.'</td>';
                $html .= '<td colspan="2" style="text-align: center;vertical-align: middle;background-color:#EEE; color:#000;"></td>';
                $html .= '</tr>';
              $html .='                    
            </tbody>
        </table>';  
        PDF::writeHTML($html, true, 0, true, 0);
        PDF::Output('hello_world.pdf');
         
    }

}




