<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\AmountDay;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class AmountDayController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function save_Amount(Request $request){
        $date = date("Y-m-j H:i:s");
        $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
        $newDate = date ( 'Y-m-j H:i:s' , $newDate); 
        if($request->id==-1){
            $clasex = new AmountDay();
        }else{
            $clasex = AmountDay::findOrFail($request->id);
        }
        $clasex->amount_assigned = $request->amount_assigned;
        $clasex->amount_delivered = $request->amount_delivered;
        $clasex->date_register = $request->date_register;
        $clasex->date_system = $newDate;
        $clasex->state ="1";
        $clasex->id_employee =$request->id_employee;
        $clasex->id_market =$request->id_market;
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
         
        }
        public function comboEmploye_list(Request $request){
            $queyRole="";
            if(isset($request->id)){
                $idx=$request->id;
                $queyRole="select * from role where id=$idx ";
            }else{
                $queyRole="select * from role "; 
            }
           
            $listRole = DB::select($queyRole);
              return [
                  'datax'=>$listRole,
              ];
        }
        
    public function delete_AmountDay(Request $request){
        $clasex = AmountDay::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
        public function getEditListAmountDay(Request $request){
            $queyAmount="select amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount_delivered,amo.amount_assigned,
            mer.id as id_market,su.id as id_sucursal,em.id as id_employee
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            inner join employee em on mer.id=em.id_market
            inner join person per on per.id= em.id_person
            inner join amount_day amo on em.id=amo.id_employee
            where su.state=1
            and mer.state=1 and amo.state=1  and amo.id='$request->id'";
            $listAmount = DB::select($queyAmount);
            //obteniendo la actividad
              return [
                  'datax'=>$listAmount
              ];
        }
        public function getEditListAmountDayRecibido(Request $request){
            $queyAmount="select amo.type,amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            inner join employee em on mer.id=em.id_market
            inner join person per on per.id= em.id_person
            inner join amount_day amo on em.id=amo.id_employee
            where su.state=1
            and mer.state=1 and amo.state=1 and amo.type='RECIBIDO' and amo.id='$request->id'";
            $listAmount = DB::select($queyAmount);
            //obteniendo la actividad
              return [
                  'datax'=>$listAmount
              ];
        }
        public function getlistSucursal(Request $request){
            $queySucursal="select su.id,su.name  from branch_office su inner join market mer on su.id=mer.id_branch_office where su.state=1 and mer.state=1 ";
            $listSucursal = DB::select($queySucursal);
            return [
                'datax'=>$listSucursal
            ];
        }
        public function getMercado(Request $request){
        $id=$request->id;
            $queyMercado="SELECT mer.id, mer.name
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            where su.state=1
            and mer.state=1 and su.id=$id";
            $listMercado = DB::select($queyMercado);
            return [
                'datax'=>$listMercado
            ];
        }
        public function getResumenDayFecha(Request $request){
            $id=$request->id;
            $date_register=$request->date_register;
            $queyMercado="SELECT amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc,amo.amount_delivered, su.name as name_sucursal,mer.name as name_mercado,amo.date_register
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            inner join employee em on mer.id=em.id_market
            inner join person per on per.id= em.id_person
            inner join amount_day amo on em.id=amo.id_employee
            where su.state=1 and amo.amount_delivered <> 0
            and mer.state=1 and amo.state=1 
            and mer.id='$id' and amo.date_register='$date_register'" ;
            $listMercado = DB::select($queyMercado);
            return [
                'datax'=>$listMercado
            ];
        }
        public function getAmountDayFecha(Request $request){
            $id=$request->id;
            $date_register=$request->date_register;
           // $date_register=$request->date_register;
            $queyMercado="SELECT amo.id,per.names, per.paternal_last_name,per.maternal_last_name, 
            per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount_delivered,amo.amount_assigned
                                from branch_office su 
                                inner join market mer on su.id=mer.id_branch_office 
                                inner join employee em on mer.id=em.id_market
                                inner join person per on per.id= em.id_person
                                inner join amount_day amo on em.id=amo.id_employee
                                where su.state=1 and em.id='$id' and amo.date_register='$date_register'
                                and mer.state=1 and amo.state=1 order by amo.date_register desc" ;
            $listMercado = DB::select($queyMercado);
            return [
                'datax'=>$listMercado
            ];
        }
        public function getEmpleado(Request $request){
            $id=$request->id;
                $queyMercado="SELECT em.id as id_promoter,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc
                from branch_office su 
                inner join market mer on su.id=mer.id_branch_office 
                inner join employee em on mer.id=em.id_market
                inner join person per on per.id= em.id_person
                where su.state=1
                and mer.state=1 and mer.id=$id";
                $listMercado = DB::select($queyMercado);
                return [
                    'datax'=>$listMercado
                ];
            }
            public function getListaEmpleado(Request $request){
                    $queyListEmploye="select amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount_delivered,amo.amount_assigned
                    from branch_office su 
                    inner join market mer on su.id=mer.id_branch_office 
                    inner join employee em on mer.id=em.id_market
                    inner join person per on per.id= em.id_person
                    inner join amount_day amo on em.id=amo.id_employee
                    where su.state=1
                    and mer.state=1 and amo.state=1 order by amo.date_register desc";
                    $listEmploye = DB::select($queyListEmploye);
                    return [
                        'datax'=>$listEmploye
                    ];
                }
                public function getListaResumenDay(Request $request){
                    $ldate = date('Y-m-d');
                    
                    $queyListEmployeDay="SELECT amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc,amo.amount_delivered, su.name as name_sucursal,mer.name as name_mercado,amo.date_register
                    from branch_office su 
                    inner join market mer on su.id=mer.id_branch_office 
                    inner join employee em on mer.id=em.id_market
                    inner join person per on per.id= em.id_person
                    inner join amount_day amo on em.id=amo.id_employee
                    where su.state=1 and amo.amount_delivered <> 0 and mer.state=1 and amo.state=1 and amo.date_register='$ldate'";
                    $listEmployeDay = DB::select($queyListEmployeDay);
                    return [
                        'datax'=>$listEmployeDay
                    ];
                }
                public function getListaEmpleadoRecibido(Request $request){
                    $queyListEmploye="select amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount
                    from branch_office su 
                    inner join market mer on su.id=mer.id_branch_office 
                    inner join employee em on mer.id=em.id_market
                    inner join person per on per.id= em.id_person
                    inner join amount_day amo on em.id=amo.id_employee
                    where su.state=1
                    and mer.state=1 and amo.state=1 and amo.type='RECIBIDO'";
                    $listEmploye = DB::select($queyListEmploye);
                    return [
                        'datax'=>$listEmploye
                    ];
                }
        public function getDatabyNroDoc(Request $request){

            if(isset($request->id)){
                $id=$request->id;
                $sqlx="select *  from employee where id_person=$id";
                $datax=DB::select($sqlx);
                  return [
                      'datax'=>$datax
                  ];
    
            }else{
            $sqlx="";
            $tipo='';
          
            $dni=$request->nro_doc;
            $sqlx="select * from person p inner join employee em on p.id=em.id_person where  p.number_doc='$dni' ";
            $miArrayx = DB::select($sqlx);
            $miArray = json_decode(json_encode($miArrayx), true);
            if(count($miArray)==0){
                $url = 'http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/api/AfiliadoApi/GetNombresCiudadano';
                $ch = curl_init($url);
                $data = array( 'CODDNI' => $dni);
                $json = json_encode($data);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','RequestVerificationToken:LGJ_UzYRpe-uIfvAURygyhbasD2M-vngQeRNRk_7USURjBavQZxwmgIAHZ9SpTnjEPjEQcimXcavv4iLbaN5fFvnxqN3ml31qxzJIWpK5Mc1:1N7LY5_JphRxTF7psEYSVcnSx_t5RwzXnyxpYBcsV8-eO_XcFRsip1UOk_C1JjDSAQXwXPZwp6tdZe5bgU2SYHQpml2-1zdS_DV2QyYD2QE1'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                $resultado = json_decode($result);
                $html=$resultado->data;
                curl_close($ch);
                $miArray = explode("|", $html);
                if(count($miArray)==4){
                    //buscamos en el otro web service
                       libxml_use_internal_errors(true);
                       $htmlContent = file_get_contents('http://clientes.reniec.gob.pe/padronElectoral2012/consulta.htm?hTipo=2&hDni='.$dni.'&hApPat=&hApMat=&hNombre=');
                       $dom = new \DOMDocument();
                       $dom->loadHTML($htmlContent);
                       $dom->preserveWhiteSpace = false;
                       $dom->strictErrorChecking = false;
                       $content = $dom->getElementsByTagname('td');
                       $out = array();
                       foreach ($content as $item)
                       {
                           $out[] = $item->nodeValue;
                       }
       
                       $miArray=array();
                       $miArray = explode(",", $out[7]);
                       $apellidosx=array();
                       $apellidosx = explode(" ", $miArray[0]);
                       $nombre=$miArray[1];
                       if(count($apellidosx)==2){
                           $miArray[0]=$apellidosx[0] ;
                           $miArray[2]=$apellidosx[1];
                           $miArray[1]=$nombre;
                       }
                       
                    }else{
                        $nombre=$miArray[2];
                    // $datos[0]=$datos[0];
                        $miArray[2]=$miArray[1];
                        $miArray[1]=$nombre;
                    }
    
                    $tipo='reniec';
                
            }else {$tipo='bd';}
              return [
                'datax' => $miArray,
                'tipo'=>$tipo
              ];
            }
        }

   

}




