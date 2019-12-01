<?php
namespace poi\Http\Controllers\Register\Mef;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Activity;

use Illuminate\Support\Facades\Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class ActivityController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function getActivity(Request $request){

        $sqlx="";
        if(isset($request->id_activity)){
            $id=$request->id_activity;
            $sqlx="select * from budget_activity where id_activity=$id ";
        }else{
            $buscar=$request->buscar;
            $sqlx="select * from budget_activity where active='t' and concat (code,' ',name) like '%$buscar%' order by id_activity";
        }
          
          $miLista = DB::select($sqlx);
          return [
              'datax' => $miLista
          ];
    }
    public function deleteActivity(Request $request){
       // $DateOfRequest= date("Y-m-d H:i:s");
        $clasex = Activity::findOrFail($request->id_activity);
        $clasex->active = 'f';
       // $clasex->modificado ='Eliminado por '.Auth::user()->nick.' '. $DateOfRequest;
        $clasex->update();
    
    }

public function saveActivity(Request $request){
    if($request->id_activity==-1){
        $clasex = new Activity();
    }else{
        $clasex = Activity::findOrFail($request->id_activity);
    }
    $clasex->code = $request->code;
    $clasex->name = $request->name;
    $clasex->function = $request->funcion;
    $clasex->functional_group = $request->group;
    $clasex->functional_division = $request->div;
    $clasex->goal = $request->fin;
    $clasex->functional_sequence_code = $request->sec;
    $clasex->id_budget_product = $request->idProduct;
    $clasex->id_uom = $request->idUnit;
    $clasex->id_budget_program = $request->idProgram;
    $DateOfRequest= date("Y-m-d H:i:s");
    $clasex->create_date = $DateOfRequest;
    $clasex->active = 't';
    $clasex->save();               
       /* $DateOfRequest= date("Y-m-d H:i:s");
        $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/
        
   }

    public function downloadActivity(Request $request){
        $sqlx="";       
        $buscar=$request->buscar;
        $sqlx="select * from budget_activity where active='t' and concat(code,' ', name) like ('%$buscar%') order by name";
        $miListax=DB::select($sqlx);
        $miLista = json_decode(json_encode($miListax), true);

        Excel::create('Actitividades', function($excel) use($miLista) {
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

    public function getGoalBudgetActivity(Request $request){
        $sqlx="";
        $sqlx="SELECT DISTINCT(goal) from budget_activity where active='t' order by goal";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }
 



}




