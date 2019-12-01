<?php
namespace poi\Http\Controllers\Register\Mef;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Programs;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class ProgramsController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
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
    public function getProgram(Request $request){

        $sqlx="";
        if(isset($request->id_program)){
            $id=$request->id_program;
            $sqlx="select * from persona where id=$id ";
        }else{
            $buscar=$request->buscar;
            $sqlx="select * from persona where estado='ACTIVO' and  nombres  like '%$buscar%' order by id";
        }
          
          $miLista = DB::select($sqlx);
          return [
              'datax' => $miLista
          ];
    }
    public function deleteProgram(Request $request){
       // $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = Programs::findOrFail($request->id_program);
        $clasex->active = 'f';
       // $clasex->modificado ='Eliminado por '.Auth::user()->nick.' '. $DateOfRequest;
        $clasex->update();
    
    }

public function saveProgram(Request $request){
    if($request->id==-1){
        $clasex = new Programs();
    }else{
        $clasex = Programs::findOrFail($request->id);
    }
    $clasex->code = $request->code;
    $clasex->name = $request->name;
    $clasex->paterno = $request->paterno;
    $clasex->materno = $request->materno;
    $clasex->telefono = $request->telefono;
    $clasex->direccion = $request->direccion;
    $DateOfRequest= date("Y-m-d H:i:s");
    $clasex->create_date = $DateOfRequest;
    $clasex->active = 't';
    $clasex->save(); 
       
       
       /* $DateOfRequest= date("Y-m-d H:i:s");
        $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
        
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




