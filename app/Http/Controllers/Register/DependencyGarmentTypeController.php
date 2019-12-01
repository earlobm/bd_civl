<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Dependency;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class DependencyGarmentTypeController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
    public function getDniJne(Request $request){
        $dni=$request->dni;
        $datos=array();
        $html = file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni); //Convierte la información de la URL en cadena
        $datos = explode("|", $html);
        return [
            'datax' => $datos
        ];
    }
    public function getDniJne2(Request $request){
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
        $datos[2]=$datos[1];
        $datos[0]=$apellidosx[0] ;
        $datos[1]=$apellidosx[1];
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
    public function getDatabyNroDoc(Request $request){

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
            //buscar en reniec
                //obtener nombre y apellidos de la reniec
                $html = file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni); //Convierte la información de la URL en cadena
                $miArray = explode("|", $html);
                $tipo='reniec';
                
            
        }else {$tipo='bd';}
          return [
            'datax' => $miArray,
            'tipo'=>$tipo
          ];
        }
    }
    public function getDependencyParent(Request $request){
        $queyDependency="select * from dependence where id_parent is null";
        $listDependency = DB::select($queyDependency);
          return [
              'datax'=>$listDependency,
          ];
    }
    public function getDependencyList(Request $request){
        $year=$request->year;
        $data=$request->data;

        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }

        $queyDependency="select * from dependency where active ='t' and operation_year =$year and concat(code,' ',name) like '%$data%' order by code limit 8 offset $curre_pagex ";
        $listDependency = DB::select($queyDependency);

        $sqltotal="select count(id_dependency) as cant from dependency where active ='t' and operation_year =$year and concat(code,' ',name) like '%$data%' ";
        $total=DB::select($sqltotal);
        $t = json_decode(json_encode($total), true);
        $totalx=intdiv((int)$t[0]['cant'], 8);
        $cocientex=((int)$t[0]['cant']%8);
              if($cocientex>0){$totalx=$totalx+1;}  
          return [
            'pagination' => [
                'total'        => (int)$t[0]['cant'],
                'current_page' => $request->page,
                'per_page'     => 8,
                'last_page'    => $totalx,
                'from'         => 1,
                'to'           => 8,
            ],
              'datax'=>$listDependency,
          ];
    }
    public function delete(Request $request){
        $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = Person::findOrFail($request->id);
        $clasex->state = 'ELIMINADO';
       $clasex->update_user ='Eliminado '. $DateOfRequest;
        $clasex->save();
    
    }
    public function getEditDependency(Request $request){
        $queyDependency="select * from dependency where active ='t' and id_dependency='$request->id' ";
        $listDependency = DB::select($queyDependency);
        //obteniendo la actividad
        $queryActivity="select ba.id_activity,ba.code,ba.name,ba.functional_sequence_code from 
        dependency_activity ax
        inner join budget_activity ba on ba.id_activity=ax.id_activity
         where ax.id_dependency='$request->id' and ax.state='t' ";
        $listActivity = DB::select($queryActivity);
        //para la lista de actividades
        $queryActivityCombo="select * from budget_activity ab 
        where id_activity not in (select id_activity from  dependency_activity 
         where id_dependency=$request->id and state='t') and active='t' ";
        $listActivityCombo = DB::select($queryActivityCombo);
        //query funding
        //para las fuentes financieras
        $queryFunding="select distinct id_funding_source from dependency_budget_ceiling
        where id_dependency=$request->id and state='t' ";
        $listFunding = DB::select($queryFunding);
        //para los montos del techo presupeustal
        $queryTech="select * from dependency_budget_ceiling
        where id_dependency=$request->id and state='t' ";
        $listTech= DB::select($queryTech);
          return [
              'datax'=>$listDependency,
              'listActivity'=>$listActivity,
              'listActivityCombo'=>$listActivityCombo,
              'listFunding'=>$listFunding,
              'listTech'=>$listTech
          ];
    }

    public function saveDependency(Request $request){
        
        if($request->id==-1){
            $clasex = new Dependency();
        }else{
            $clasex = Dependency::findOrFail($request->id);
            //DependencyActivity::where('id_dependency', $request->id)->delete();
            DependencyActivity::where('id_dependency', $request->id)->update(['state' => false]);
        }
        $clasex->code = $request->code;
        $clasex->name = $request->name;
        $clasex->operation_year = $request->year;
        $clasex->type ="Genérico";
        ($request->idParent!=''?$clasex->id_parent=$request->idParent:'');
        ($request->dependencia_operativa?$clasex->type="Operacional":'');
        $clasex->save(); 
        //registrando la actividad
        foreach ($request->listActivitySave as $key => $value) {
            $clasey =DependencyActivity::where('id_dependency','=',  $clasex->id_dependency)->where('id_activity', '=', $value['id_activity'])->select('id')->take(1)->get();
            if(count($clasey)==0){
                $clasexx = new DependencyActivity();
                $clasexx->id_dependency = $clasex->id_dependency;
                $clasexx->id_activity = $value['id_activity'];
                $clasexx->state = 'true';
                $clasexx->save();    
            }else{
                //Para actualizar el estado a activo de la actividad de capacitacion
                if(count($clasey)>0){
                    $id=$clasey[0]['id'];
                    $clasexx = DependencyActivity::findOrFail($id);
                    $clasexx->state ='true';
                    $clasexx->save();  
                }
            }
         }
         
         
            
    }

        
    

}


