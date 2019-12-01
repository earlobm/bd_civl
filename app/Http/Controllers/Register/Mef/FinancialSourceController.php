<?php
namespace poi\Http\Controllers\Register\Mef;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\FinancialSourceMesuare;

use Illuminate\Support\Facades\Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class FinancialSourceController extends Controller
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
    public function getFunding(Request $request){

        $sqlx="";
        if(isset($request->id_funding)){
            $id=$request->id_funding;
            $sqlx="select * from funding_source where id_funding=$id ";
        }else{
            $buscar=$request->buscar;
            $sqlx="select * from funding_source where active='t' and concat (code,' ',name,' ',alias) like '%$buscar%' order by id_funding";
        }
          
          $miLista = DB::select($sqlx);
          return [
              'datax' => $miLista
          ];
    }
    public function deleteFinalcialSource(Request $request){
        // $DateOfRequest= date("Y-m-d H:i:s");
         $clasex = FinancialSourceMesuare::findOrFail($request->id_funding);
         $clasex->active = 'f';
        // $clasex->modificado ='Eliminado por '.Auth::user()->nick.' '. $DateOfRequest;
         $clasex->update();
     
     }

public function saveFinancialSource(Request $request){
    if($request->id==-1){
        $clasex = new FinancialSourceMesuare();
    }else{
        $clasex = FinancialSourceMesuare::findOrFail($request->id);
    }
    $clasex->code = $request->code;
    $clasex->name = $request->name;
    $clasex->alias = $request->abrev;
    $clasex->active = 't';
    $clasex->save(); 
       
       
       /* $DateOfRequest= date("Y-m-d H:i:s");
        $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
        
   }

    public function downloadFundingSource(Request $request){
        $sqlx="";       
        $buscar=$request->buscar;
        $sqlx="select * from funding_source where active='t' and concat(code,' ', name) like ('%$buscar%') order by name";
        $miListax=DB::select($sqlx);
        $miLista = json_decode(json_encode($miListax), true);

        Excel::create('Fuentes Financieras', function($excel) use($miLista) {
        $excel->sheet('DATA', function($sheet) use($miLista){
        $sheet->setScale('75');
            $array = json_decode(json_encode($miLista), true);               
            $sheet->row(1, [
                'N°', 'CODIGO', 'NOMBRE','DESCRIPCIÓN'
            ]);
            $sheet->setBorder('A1:D1', 'thin');
            $sheet->cells('A1:D1', function($cells) { $cells->setFontWeight('bold');});
            //  $sheet->cells('F1', function($cells) { $cells->setFontWeight('bold');});
            $total=0;
            foreach($array as $index => $midatax) {
                $sheet->row($index+2, [
                    ($index+1), $midatax['code'], $midatax['name'], $midatax['alias']
                    //Excel cv
                ]);	
                $col='A'.($index+2).':D'.($index+2);
                $sheet->setBorder($col, 'thin');
                $total++;
            }
            $col='A'.($total+1).':D'.($total+1);
            $sheet->setBorder($col, 'thin');
            
        });
        })->download('xls');
    }



}




