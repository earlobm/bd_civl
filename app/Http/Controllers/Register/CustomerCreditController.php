<?php
namespace poi\Http\Controllers\Register;

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

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class CustomerCreditController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }
    public function getDniJne2(Request $request){
        $dni=$request->dni;
        $datos=array();
        $html = file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni); //Convierte la información de la URL en cadena
        $datos = explode("|", $html);
        return [
            'datax' => $datos
        ];
    }
    public function getDniJne(Request $request){
        $dni=$request->dni;
        libxml_use_internal_errors(true);
        $htmlContent = file_get_contents('http://clientes.reniec.gob.pe/padronElectoral2012/consulta.htm?hTipo=2&hDni='.$dni.'&hApPat=&hApMat=&hNombre=');
		$aDataTableHeaderHTML=[];
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
        //var_dump($out);
        $datos=array();
        $datos = explode(",", $out[7]);
        
        $apellidosx=array();
        $apellidosx = explode(" ", $datos[0]);
        if(count($apellidosx)==2){
            $datos[2]=$datos[1];
            $datos[0]=$apellidosx[0] ;
            $datos[1]=$apellidosx[1];
        }
       
        return [
            'datax' => $datos
        ];
    }
    public function getDataByRucSunat(Request $request){
        $ruc=$request->ruc;
        $json = file_get_contents('https://api.sunat.cloud/ruc/'.$ruc);
        $obj = json_decode($json);
       // print $obj->razon_social;
        return [
            'datax' => $obj
        ];
    }
    public function get_customer_by_dni(Request $request){
        
            $sqlx="";
            $tipo='';
        
            $dni=$request->nro_doc;
            $sqlx="SELECT p.id, c.id as id_customer_credit, c.code, p.id_type_document, p.number_doc, p.paternal_last_name, p.maternal_last_name, p.names,
            p.phone, p.address, p.birthdate, p.sex, p.marital_status, p.email, p.reference, p.id_district,di.id_province, pr.id_department, c.id_job, c.id_promoter, c.id_type_business
            FROM person p 
            inner join customer c on c.id_person=p.id
            inner join district di on di.id=p.id_district
            inner join province pr on pr.id=di.id_province
            inner join department de on de.id=pr.id_department
            where p.number_doc='$dni' ";
            $miArrayx = DB::select($sqlx);
            $miArray = json_decode(json_encode($miArrayx), true);

            //Para traer los requerimientos que tiene el cliente
            $sql="SELECT ct.id_type_document
            FROM person p 
            inner join customer c on c.id_person=p.id
            inner join customer_type_doc ct on ct.id_customer=c.id
            where ct.state=1 and p.number_doc='$dni' ";
            $ArrayR = DB::select($sql);
            $ArrayReq = json_decode(json_encode($ArrayR), true);

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
                'tipo'=>$tipo,
                'requirements_data'=>$ArrayReq
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
    public function delete(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = CustomerCredit::findOrFail($request->id);
        $clasex->state = 0;
    //    $clasex->update_user ='Eliminado '. $DateOfRequest;
        $clasex->save();
    
    }

    public function save_data(Request $request){
        
        //preguntamos si el cliente ya existe
        if($request->id_customer_credit==-1){
            $clase_customer = new CustomerCredit();
            $clase_customer->code = $request->code;
        }else{
            $clase_customer = CustomerCredit::findOrFail($request->id_customer_credit);
        }
        ///p/reguntamos si la persona existe
        if($request->id==-1){
            $clasex = new Person();
        }else{
            $clasex = Person::findOrFail($request->id);
        }        
        $clasex->number_doc = trim($request->nro_doc);
        $clasex->paternal_last_name = trim($request->paternal_last_name);
        $clasex->maternal_last_name =trim($request->maternal_last_name);
        $clasex->names = trim($request->name);
        $clasex->phone = $request->phone;
        $clasex->address = $request->address;
        $clasex->state = 1;
        $clasex->birthdate =  $request->birthdate;
        $clasex->id_district =  $request->id_district;
        $clasex->email =  $request->email;
        $clasex->reference =  $request->reference;
        $clasex->id_type_document =  $request->id_type_document;
        $clasex->sex = $request->sex;
        $clasex->marital_status = $request->marital_status;        
        $clasex->save(); 
        //registrando en la tabla de cliente empeño
        $DateOfRequest= date("Y-m-d H:i:s");
        $clase_customer->state=1;
        $clase_customer->id_type_business=$request->id_type_business;
        $clase_customer->date_inscription=$DateOfRequest;
        $clase_customer->id_person=$clasex->id;
        $clase_customer->id_promoter =$request->id_employee;
        $clase_customer->id_job =$request->id_job;
        $clase_customer->save(); 

        $t = json_decode(json_encode($request->requirements), true);
        foreach ($t as $key => $value) {
            
            //id_type_document 	id_customer 
            if($value['check']){
                $controller =CustomerTypeDocument::where('id_type_document','=', $value['id_type_requerement'])->where('id_customer', '=', $clase_customer->id)
                ->select('id')->take(1)->get();
                if(count($controller)==0){
                    $controller = new CustomerTypeDocument();
                    $controller->id_type_document = $value['id_type_requerement'];
                    $controller->id_customer = $clase_customer->id;
                    $controller->state =1;
                    $controller->save(); 
                }else{
                    $id=$controller[0]['id'];
                    $controller = CustomerTypeDocument::findOrFail($id); 
                    $controller->state =1;
                    $controller->save(); 
                }
            }else{
                $controller =CustomerTypeDocument::where('id_type_document','=', $value['id_type_requerement'])->where('id_customer', '=', $clase_customer->id)
                ->select('id')->take(1)->get();
                if(count($controller)>0){
                    $id=$controller[0]['id'];
                    $controller = CustomerTypeDocument::findOrFail($id);     
                    $controller->state =0;
                    $controller->save(); 
                }                
            }
            
        }
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
          return  $clasex->id; 
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

    public function list_department(Request $request){
        $sqlx="SELECT * FROM department order by name";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_province(Request $request){       
        $id=$request->id;
        $sqlx="SELECT *
          FROM province  where id_department=$id
         order by name";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_district(Request $request){       
        $id=$request->id;
        $sqlx="SELECT *
          FROM district  where id_province=$id
         order by name";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_type_document(Request $request){
        $sqlx="SELECT * FROM type_document where state=1 and type=1 order by name";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
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
    public function list_type_requerement(Request $request){
        $sqlx="";
        $sqlx="SELECT id as id_type_requerement,
        name from type_document where type=2 and state=1
        order by name";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function list_type_business(Request $request){
        $sqlx="";
        $sqlx="SELECT id,
        name from type_business where state=1
        order by name";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }
    public function list_job(Request $request){
        $sqlx="";
        $sqlx="SELECT id,
        names from job WHERE state=1 
        order by names";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

}




