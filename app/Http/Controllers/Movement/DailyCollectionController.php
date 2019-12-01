<?php
namespace poi\Http\Controllers\Movement;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Pledge;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use DB;
use PDF; // at the top of the file
use poi\Http\Controllers\Util\StateController;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');


class DailyCollectionController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }

    public function getListDailyCollection(Request $request){
       
        //$id_pledge=$request->id_pledge;
        //$myfecha="2019-11-24";
        $namex=$request->search;
        $marketx=$request->market;
        $myfecha=$request->date_now;
        $sqlx=" call daily_collection('$myfecha','$namex','$marketx') ";
        $datax=DB::select($sqlx);

          return [
              'datax'=>$datax,
          ];
    
    
    }
    public function save(Request $request){
        $mystate = new StateController(); 
        //$DateOfRequest= date("Y-m-d H:i:s");
       
        //registrando en MovementPledge
            $controllerx = new MovementPledge();
            $controllerx->number_operation='PR0001';

            $controllerx->capital = $request->amountPayment;
            $controllerx->interest = $request->interest;
            $controllerx->date_movement =$request->dateModePayment;

            
            $date = date("Y-m-j H:i:s");
            $newDate = strtotime ( '-5 hour' , strtotime ($date) ) ; 
            $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

            $controllerx->date_system = $newDate;
            $controllerx->operation = $request->operation;
            $controllerx->state = 1;
            $controllerx->type = "PC";
            $controllerx->id_customer = $request->id_customer;
            $controllerx->id_pledge = $request->id_pledge;
            $controllerx->save(); 
        //registrando en movimiento el capital
            $controller = new DetailMovement();
            $controller->date_init=$request->dateModePayment;
            
            if($request->operation=="Interes")
            {   
                $controller->operation = "PAGO DE INTERES";
                $controller->type = "PI";
            }
            if($request->operation=="Liquidacion")
            {
                $controller->operation = "LIQUIDACIÓN";
                $controller->type = "LI";
                //ACTUALIZAMOS LA PRENDA Y EL DETALLE A CANCELADO
                $clasex = Pledge::findOrFail($request->id_pledge);
                $clasex->state=$mystate->statePledgepaid;
                $clasex->save();
                //actualizando el detalle de la prenda
                DB::table('detail_pledge')
                ->where('id_pledge', $request->id_pledge)
                ->update(['state' => $mystate->statePledgepaid]);
            }
            $controller->charge = 0;
            $controller->payment = $request->amountPayment;
            $controller->residue = $request->residue;
            $controller->state = 1;
            $controller->id_pledge =  $request->id_pledge;
            $controller->id_movement_pledge = $controllerx->id;
            $controller->save(); 
            //registrando en movimiento el interes
            
        return 1;
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




