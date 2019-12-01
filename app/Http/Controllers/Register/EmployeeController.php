<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Employee;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class EmployeeController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function saveEmployee(Request $request){
        if($request->id==-1){
            $clasex = new Employee();
        }else{
            $clasex = Employee::findOrFail($request->id);
        }
        $clasex->code = $request->code;
        $clasex->state = 1;
        $clasex->id_person = $request->id_person;
        $clasex->id_market =$request->id_market;
        $clasex->role_id =$request->role_id;

        $clasex->save(); 
        /* $DateOfRequest= date("Y-m-d H:i:s");
            $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
          return  $clasex->id; 
        }
        public function delete_PersonalEmploye(Request $request){
            $clasex = Employee::findOrFail($request->id);
            $clasex->state =0;
            $clasex->save();
        }
        public function getListaEmpleadoList(Request $request){
            $queyListEmploye="select em.id,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc,ro.name as name_role, su.name as name_sucursal,mer.name as name_mercado
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            inner join employee em on mer.id=em.id_market
            inner join person per on per.id= em.id_person
			inner join role ro on ro.id=em.role_id
            where su.state=1
            and mer.state=1 and em.state=1";
            $listEmploye = DB::select($queyListEmploye);
            return [
                'datax'=>$listEmploye
            ];
        }
        public function geEdittListaEmpleadoList(Request $request){
            $queyListEmploye="select em.id,em.id_person,em.code,per.names, per.paternal_last_name,per.maternal_last_name, per.number_doc,ro.name as name_role, su.name as name_sucursal,mer.name as name_mercado
            from branch_office su 
            inner join market mer on su.id=mer.id_branch_office 
            inner join employee em on mer.id=em.id_market
            inner join person per on per.id= em.id_person
			inner join role ro on ro.id=em.role_id
            where su.state=1
            and mer.state=1 and em.state=1 and em.id='$request->id'";
            $listEmploye = DB::select($queyListEmploye);
            return [
                'datax'=>$listEmploye
            ];
        }
        
        public function getDatabyNroDocP(Request $request){

            if(isset($request->id)){
                $id=$request->id;
                $sqlx="select *  from person where id=$id";
                $datax=DB::select($sqlx);
                  return [
                      'datax'=>$datax
                  ];
    
            }else{
            $sqlx="";
            $tipo='';
          
            $dni=$request->nro_doc;
            $sqlx="select * from person where number_doc='$dni' ";
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




