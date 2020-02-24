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
use poi\Http\Controllers\Util\Curlx;
use poi\EntityClass\DetailCredit;
use poi\EntityClass\Credit;

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
    public function get_customer_by_dni(Request $request){        
        if(isset($request->id)){
            $id=$request->id;
            $sqlx="select *  from person where idperson=$id";
            $datax=DB::select($sqlx);
              return [
                  'datax'=>$datax
              ];

        }else{
        $sqlx="";
        $tipo='';
      
        $dni=$request->number_doc;
        $sqlx="select * from person  where  number_doc='$dni' ";
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

    public function get_aval_by_dni(Request $request){        
        $sqlx="";  
        $tipo='';  
        $dni=$request->nro_doc_aval;
        $sqlx="SELECT c.id_guarantor
        FROM customer c 
        inner join person g on g.id=c.id_guarantor
        inner join district dg on dg.id=g.id_district
        inner join province pg on pg.id=dg.id_province
        inner join department deg on deg.id=pg.id_department
        where g.number_doc='$dni' ";
        $miArray_pg = DB::select($sqlx);
        $Array_pg = json_decode(json_encode($miArray_pg), true);

        if(count($Array_pg)==0){
            $sql_pg="";  
            $sql_pg="SELECT g.id as id_guarantor,
            g.id_type_document as id_type_document_aval, g.number_doc as number_doc_aval, 
            g.paternal_last_name as paternal_last_name_aval, g.maternal_last_name as maternal_last_name_aval, g.names as names_aval,        
            g.phone as phone_aval, g.address as address_aval, g.birthdate as birthdate_aval, 
            g.sex as sex_aval, g.marital_status as marital_status_aval, g.email as email_aval,
            g.reference as reference_aval,         
            g.id_district as id_district_aval,di.id_province as id_province_aval, pr.id_department as id_department_aval,
            g.id_job as id_job_aval,  g.id_type_business as id_type_business_aval
            FROM person g 
            inner join district di on di.id=g.id_district
            inner join province pr on pr.id=di.id_province
            inner join department de on de.id=pr.id_department
            where g.number_doc='$dni' ";
            $miArray_pg = DB::select($sql_pg);
            $Array_pg = json_decode(json_encode($miArray_pg), true);
            if(count($Array_pg)==0){
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
                $Array_pg = explode("|", $html);
                if(count($Array_pg)==4){
                    //buscamos en el otro web service
                    libxml_use_internal_errors(true);
                    $htmlContent = file_get_contents('http://clientes.reniec.gob.pe/padronElectoral2012/consulta.htm?hTipo=2&hDni='.$dni.'&hApPat=&hApMat=&hNombre=');
                    $dom = new \DOMDocument();
                    $dom->loadHTML($htmlContent);
                    $dom->preserveWhiteSpace = false;
                    $dom->strictErrorChecking = false;
                    $content = $dom->getElementsByTagname('td');
                    $out = array();
                    foreach ($content as $item){
                        $out[] = $item->nodeValue;
                    }
                    $Array_pg=array();
                    $Array_pg = explode(",", $out[7]);
                    $apellidosx=array();
                    $apellidosx = explode(" ", $Array_pg[0]);
                    $nombre=$Array_pg[1];
                    if(count($apellidosx)==2){
                        $Array_pg[0]=$apellidosx[0] ;
                        $Array_pg[2]=$apellidosx[1];
                        $Array_pg[1]=$nombre;
                    }
                    
                }else{
                    $nombre=$Array_pg[2];
                    // $datos[0]=$datos[0];
                    $Array_pg[2]=$Array_pg[1];
                    $Array_pg[1]=$nombre;
                }
                $tipo='reniec';
            }else{
                $tipo='person';
            }
            
        }else {
            $tipo='bd';
        }
        return [
            'datax' => $Array_pg,
            'tipo' => $tipo
        ];
        
    }
    public function list_customer(Request $request){
       
            $curre_pagex=$request->page;
            if($curre_pagex=='1'){
                $curre_pagex=0;
            }else{
                $curre_pagex=$curre_pagex-1;
                $curre_pagex=$curre_pagex*10;
            }
            $sqlx="";
            $buscar=$request->buscar;
            $sqlx="SELECT per.idperson,de.id as id_departamento,dis.id as id_distrito,pro.id as id_provicnia,per.number_doc,per.name_materno,per.name_paterno,per.name,dis.distrito as distritos,pro.provincia as provincias,de.departamento as departamentos,per.sexo,per.fecha_nacimiento,per.estado_civil,per.edad, 
            (select count(p.idperson) 
            from person p 
            where p.estado=1 and  concat(p.number_doc,' ',p.name,' ',p.name_paterno,' ',p.name_materno) like '%$buscar%') AS total
            from person per 
            inner join distric dis on per.id_district=dis.id 
            inner join province pro on pro.id=dis.idProv 
            inner join departament de on de.id=pro.id_departmen 
            where per.estado=1 and  concat(per.number_doc,' ',per.name,' ',per.name_paterno,' ',per.name_materno)  like '%$buscar%' order by per.idperson limit 10 offset $curre_pagex";
    
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
    public function saveCiudadano(Request $request){
        if($request->idperson==-1){
            $clasex = new Person();
        }else{
            $clasex = Person::findOrFail($request->idperson);
        }
        $clasex->name_paterno = $request->name_paterno;
        $clasex->estado = 1;
        $clasex->name_materno = $request->name_materno;
        $clasex->name =$request->name;
        $clasex->fecha_nacimiento =$request->fecha_nacimiento;
        $clasex->sexo =$request->sexo;
        $clasex->estado_civil =$request->estado_civil;
        $clasex->edad =$request->edad;
        $clasex->id_type_document =$request->id_type_document;
        $clasex->profesion_oficio =$request->profesion_oficio;
        $clasex->number_doc =$request->number_doc;
        $clasex->id_district =$request->id_district;


        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
          return  $clasex->idperson; 
        }

    public function save_data(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        //preguntamos si el cliente ya existe
        if($request->id_customer_credit==-1){
            $clase_customer = new CustomerCredit();
            $clase_customer->code = $request->code;
        }else{
            $clase_customer = CustomerCredit::findOrFail($request->id_customer_credit);
            $clase_customer->date_inscription=$DateOfRequest;
        }
        ///Preguntamos si la persona existe
        if($request->id==-1){
            $clasex = new Person();
        }else{
            $clasex = Person::findOrFail($request->id);
        }  
        ///Preguntamos si el aval existe
        if($request->nro_doc_aval!=null || $request->nro_doc_aval!=''){
            if($request->id_guarantor==-1){
                $clase_guarantor = new Person();
            }else{
                $clase_guarantor = Person::findOrFail($request->id_guarantor);
                
            } 
            $clase_guarantor->id_type_document =  $request->id_type_document_aval;
            $clase_guarantor->number_doc = trim($request->nro_doc_aval);
            $clase_guarantor->paternal_last_name = trim($request->paternal_last_name_aval);
            $clase_guarantor->maternal_last_name =trim($request->maternal_last_name_aval);
            $clase_guarantor->names = trim($request->name_aval);
            $clase_guarantor->phone = $request->phone_aval;
            $clase_guarantor->address = $request->address_aval;
            $clase_guarantor->state = 1;
            $clase_guarantor->birthdate =  $request->birthdate_aval;
            $clase_guarantor->email =  $request->email_aval;
            $clase_guarantor->id_district =  $request->id_district_aval;        
            $clase_guarantor->reference =  $request->reference_aval;        
            $clase_guarantor->sex = $request->sex_aval;
            $clase_guarantor->marital_status = $request->marital_status_aval;  
            $clase_guarantor->id_type_business=$request->id_type_business_aval; 
            $clase_guarantor->id_job =$request->id_job_aval;       
            $clase_guarantor->save();
        }
             
        $clasex->id_type_document =  $request->id_type_document;
        $clasex->number_doc = trim($request->nro_doc);
        $clasex->paternal_last_name = trim($request->paternal_last_name);
        $clasex->maternal_last_name =trim($request->maternal_last_name);
        $clasex->names = trim($request->name);
        $clasex->phone = $request->phone;
        $clasex->address = $request->address;
        $clasex->state = 1;
        $clasex->birthdate =  $request->birthdate;
        $clasex->email =  $request->email;
        $clasex->id_district =  $request->id_district;        
        $clasex->reference =  $request->reference;        
        $clasex->sex = $request->sex;
        $clasex->marital_status = $request->marital_status;    
        $clasex->id_type_business=$request->id_type_business; 
        $clasex->id_job =$request->id_job;   
        $clasex->save(); 

         
        //registrando en la tabla de cliente empeño
        
        $clase_customer->state=1; 
        $clase_customer->id_person=$clasex->id;
        if($request->nro_doc_aval!=null || $request->nro_doc_aval!=''){
            $clase_customer->id_guarantor=$clase_guarantor->id;
        }
        $clase_customer->id_promoter =$request->id_employee;        
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
          return  $clase_customer->id; 
    }
    public function save_detail_credit(Request $request){
        $date_system = date("Y-m-d H:i:s");
        
        $sqlx = "SELECT CONCAT('CRE',right(CONCAT('000', (COUNT(id) + 1)),3)) as code
        FROM credit";
        $miArrayx=DB::select($sqlx);
        $miArray = json_decode(json_encode($miArrayx), true);
        $code_credit = $miArray[0]['code'];    
        
        $clase_credit = new Credit();
        $clase_credit->code_credit = $code_credit;
        $clase_credit->date_credit = $request->date_credit;
        $clase_credit->date_init_payment = $request->date_init_payment;
        $clase_credit->date_expiration = $request->date_expiration;
        $clase_credit->capital = $request->capital;
        $clase_credit->interest = $request->interest;
        $clase_credit->total = $request->total;
        $clase_credit->interest_rate = $request->interest_rate;
        $clase_credit->rate_admin = $request->rate_admin;
        $clase_credit->amount_admin = $request->amount_admin;

        $clase_credit->quota = $request->quota;
        $clase_credit->number_quota = $request->number_quota;
        $clase_credit->period = $request->period_credit;
        $clase_credit->mora = 0;
        $clase_credit->saldo = $request->total;
        $clase_credit->state = 1;
        
        $clase_credit->date_system = $date_system;
        $clase_credit->date_expired_original = $request->date_expiration;
        $clase_credit->risk_center = $request->risk_center;
        $clase_credit->grace_day = $request->grace_day;
        $clase_credit->apply_mora = $request->apply_mora;
        $clase_credit->id_customer = $request->id_customer;
        $clase_credit->id_promoter = $request->id_promoter;
        $clase_credit->save(); 

        $t = json_decode(json_encode($request->array_credit_detail), true);
        foreach ($t as $key => $value) {        
            $controller = new DetailCredit();
            $controller->date_expired = $value['date_expiration_detail'];
            $controller->number_quota = $value['id'];
            $controller->quota = $value['quota'];
            $controller->capital = $value['capital'];
            $controller->interest = $value['interest'];
            $controller->saldo_projected  = $value['saldo'];
            $controller->id_credit = $clase_credit->id;
            $controller->deposit  =0;
            $controller->state =1;
            $controller->save();             
        }
        return  $clase_credit->id; 

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
        $sqlx="SELECT * FROM departament order by departamento";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_province(Request $request){       
        $id=$request->id;
        $sqlx="SELECT *
          FROM province  where id_departmen=$id
         order by provincia";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_district(Request $request){       
        $id=$request->id;
        $sqlx="SELECT *
          FROM distric  where idProv=$id
         order by distrito";
        $datax=DB::select($sqlx);
          return [
              'datax'=>$datax,
          ];
    }
    public function list_type_document(Request $request){
        $sqlx="SELECT iddocument, name FROM type_document where state=1 ";
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




