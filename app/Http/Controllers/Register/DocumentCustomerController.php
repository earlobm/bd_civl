<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\DocumentCustomer;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class DocumentCustomerController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function save_Document(Request $request){
        if($request->id==-1){
            $clasex = new DocumentCustomer();
        }else{
            $clasex = DocumentCustomer::findOrFail($request->id);
        }
        $clasex->name = $request->name;
        $clasex->state =1;
        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
         
        }
        
       

    public function delete_Document(Request $request){
        $clasex = DocumentCustomer::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
        
        public function getEditListDocument(Request $request){
            $queyDocument="SELECT iddocument,name FROM type_document where  state=1 and iddocument='$request->id'";
            $listDocument = DB::select($queyDocument);
            //obteniendo la actividad
              return [
                  'datax'=>$listDocument
              ];
        }
        public function getlistDocument(Request $request){
            $queyDocument="SELECT iddocument,name FROM type_document where  state=1 ";
            $listDocument = DB::select($queyDocument);
            return [
                'datax'=>$listDocument
            ];
        }
        public function getMercado(Request $request){
        $id=$request->id;
            $queyMercado="select mer.id, mer.name
            from branch_office su inner join market mer on su.id=mer.id_branch_office where su.state=1
            and mer.state=1 and su.id=$id";
            $listMercado = DB::select($queyMercado);
            return [
                'datax'=>$listMercado
            ];
        }
        public function getEmpleado(Request $request){
            $id=$request->id;
                $queyMercado="select em.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc
                from tumi.branch_office su 
                inner join tumi.market mer on su.id=mer.id_branch_office 
                inner join tumi.employee em on mer.id=em.id_market
                inner join tumi.person per on per.id= em.id_person
                where su.state=1
                and mer.state=1 ";
                $listMercado = DB::select($queyMercado);
                return [
                    'datax'=>$listMercado
                ];
            }
            public function getListaEmpleado(Request $request){
                    $queyListEmploye="select amo.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc, su.name as name_sucursal,mer.name as name_mercado,amo.date_register,amo.amount
                    from branch_office su 
                    inner join market mer on su.id=mer.id_branch_office 
                    inner join employee em on mer.id=em.id_market
                    inner join person per on per.id= em.id_person
                    inner join amount_day amo on em.id=amo.id_employee
                    where su.state=1
                    and mer.state=1 and amo.state=1 and amo.type='ENTREGADO'";
                    $listEmploye = DB::select($queyListEmploye);
                    return [
                        'datax'=>$listEmploye
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




