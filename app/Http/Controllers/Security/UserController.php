<?php

namespace poi\Http\Controllers\Security;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\User;

use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller{
    public function __construct(){
		//$this->middleware('auth');
    }
    
    public function saveUser(Request $request){
        DB::beginTransaction();

        if($request->id==-1){
            $clasex = new User();            
        }else{
            $clasex = User::findOrFail($request->id);
        }

        try{
            $clasex->email = $request->email;
            $clasex->nick =$request->nick;
            $clasex->state =1;
            $clasex->id_person =$request->id_person;
            $clasex->id_role =$request->id_role;
            // $user->id_dependency =$request->id_dependency;
            $clasex->password = bcrypt( $request->password); 
           // $user->url_foto = ($request->sexo=='F'?'img/users/f.png':'img/users/m.png'); 

            $clasex->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function getDataDNI(Request $request){
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

    public function listUser(Request $request){
		$buscar =  strtoupper($request->buscar);        
        if ($buscar==''){
            $datax= User::orderBy('active', 'desc')->orderBy('last_date', 'desc')->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $datax = User::where(DB::raw("concat(UPPER(name),' ',UPPER(lastname),' ',dni)"), 'like', '%'. $buscar . '%')->orderBy('active', 'desc')->orderBy('last_date', 'desc')->orderBy('id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $datax->total(),
                'current_page' => $datax->currentPage(),
                'per_page'     => $datax->perPage(),
                'last_page'    => $datax->lastPage(),
                'from'         => $datax->firstItem(),
                'to'           => $datax->lastItem(),
            ],
            'datax' => $datax
        ];
		
    }
    public function getEditUser(Request $request){
        $queyUser="SELECT us.id,us.id_role,us.id_person, per.number_doc,rol.name, us.nick, us.email, us.password, per.names, per.paternal_last_name, per.maternal_last_name, rol.name  from person per inner join users us on us.id_person=per.id inner join role rol on rol.id=us.id_role where us.state=1 and us.id='$request->id' order by us.id  ";
        $listUser = DB::select($queyUser);
        //obteniendo la actividad
          return [
              'datax'=>$listUser
          ];
    }
    public function getListUser(Request $request){
        
        $queyUser="SELECT us.id,us.id_role,us.id_person, per.number_doc,rol.name, us.nick, us.email, us.password, per.names, per.paternal_last_name, per.maternal_last_name, rol.name  from person per inner join users us on us.id_person=per.id inner join role rol on rol.id=us.id_role where us.state=1";
       
        $listUser = DB::select($queyUser);
          return [
              'datax'=>$listUser,
          ];
    }
    public function delete_User(Request $request){
        $clasex = User::findOrFail($request->id);
        $clasex->state =0;
        $clasex->save();
    }
    public function comboRole_list(Request $request){
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
}