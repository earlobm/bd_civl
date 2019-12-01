<?php
namespace poi\Http\Controllers\PlanOperativo;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\PoiActivity;

use Illuminate\Support\Facades\Auth;
use DB;

ini_set('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class PoiActivityController extends Controller{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function getUnitPoi(Request $request){

        $sqlx = "";
        if (isset($request->id_poi_unity)) {
            $id = $request->id_poi_unity;
            $sqlx = "select * from poi_unity where id_poi_unity=$id ";
        } else {
            $sqlx = "select * from poi_unity";
        }

        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function savePoiActivity(Request $request){
        $sqlx ="";
        $sqlx = "select right('00000'|| (count(id_poi_activity) + 1),5) as code from poi_activity";
        $myArray=DB::select($sqlx);
        $myArrayJC = json_decode(json_encode($myArray), true);
        $code = $myArrayJC[0]['code']; 

        if ($request->id ==-1) {
            $clasex = new PoiActivity();
            $clasex->code = $code;
        } else {
            $clasex = PoiActivity::findOrFail($request->id);
        }
        //$DateOfRequest = date("Y-m-d H:i:s");
        $clasex->name = $request->activity;
        $clasex->id_budget_activity = $request->id_act_budget;
        $clasex->id_strategic_activity = $request->id_strategic;
        $clasex->id_poi_unity = $request->id_unit;
        $clasex->priority = $request->priority;
        $clasex->id_dependency = $request->id_dependency;
        $clasex->total = $request->total;
      //  $clasex->create_date = $DateOfRequest;
        $clasex->save();
        /* $DateOfRequest= date("Y-m-d H:i:s");
        $clasex->modificado ='Modificado por '.Auth::user()->nick.' '. $DateOfRequest;*/

        $controller = new PoiScheduleController();
        $controller->add_update(1,$clasex->id_poi_activity, $request->january);
        $controller->add_update(2,$clasex->id_poi_activity, $request->february);
        $controller->add_update(3,$clasex->id_poi_activity, $request->march);
        $controller->add_update(4,$clasex->id_poi_activity, $request->april);
        $controller->add_update(5,$clasex->id_poi_activity, $request->may);
        $controller->add_update(6,$clasex->id_poi_activity, $request->june);
        $controller->add_update(7,$clasex->id_poi_activity, $request->july);
        $controller->add_update(8,$clasex->id_poi_activity, $request->august);
        $controller->add_update(9,$clasex->id_poi_activity, $request->setember);
        $controller->add_update(10,$clasex->id_poi_activity, $request->october);
        $controller->add_update(11,$clasex->id_poi_activity, $request->november);
        $controller->add_update(12,$clasex->id_poi_activity, $request->december);

    }

    public function getYear(Request $request){
        $sqlx = "select distinct(operation_year) as operation_year from dependency where active='t' order by operation_year desc";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function getDependency(Request $request){
        $sqlx = "select id_dependency, name from dependency where active='t'
        and operation_year='$request->operation_year' order by name asc";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function getOnlyDependency(Request $request){
        $curre_pagex=$request->page;
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }

        $sqlx = "SELECT code, name,id_dependency
        FROM dependency WHERE id_dependency='$request->id_dependency' limit 8 offset $curre_pagex";
        $miLista = DB::select($sqlx);

        $total=DB::select('SELECT count(code) as cant from dependency');
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
            'datax' => $miLista
        ];
    }

    public function getInformeStatu(Request $request){
        $year_init=$request->year_init;
        $id_dependency=$request->id_dependency;
        $id_strategic_goal=$request->id_strategic_goal;
        $id_strategic_activity=$request->id_strategic_activity;
        $goal=$request->goal;
        $id_poi_unity=$request->id_poi_unity;
        $curre_pagex=$request->page;

        $sqlx="";
        if($year_init!=''){$sqlx .=" and year_init='$year_init'";}
        if($id_dependency!=''){$sqlx .=" and id_dependency='$id_dependency'";}
        if($id_strategic_goal!=''){$sqlx .=" and id_strategic_goal='$id_strategic_goal'";}
        if($id_strategic_activity!=''){$sqlx .=" and id_strategic_activity='$id_strategic_activity'";}
        if($goal!=''){$sqlx .=" and goal='$goal'";}
        if($id_poi_unity!=''){$sqlx .=" and id_poi_unity='$id_poi_unity'";}
        
        if($curre_pagex=='1'){
            $curre_pagex=0;
        }else{
            $curre_pagex=$curre_pagex-1;
            $curre_pagex=$curre_pagex*8;
        }

        $sql="SELECT * FROM vista_poi_activity WHERE 1=1 $sqlx limit 8 offset $curre_pagex";
        //id_strategic_goal, id_strategic_activity, goal, id_poi_unity){
        $miLista = DB::select($sql);

        $total=DB::select('select count(id_poi_activity) as cant from vista_poi_activity where  1=1  '.$sqlx.' ');
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
            'datax' => $miLista
        ];
    }

    public function getEditInformeStatu(Request $request){
        $sql="SELECT pa.id_poi_activity, pa.name as name_activity, pa.id_budget_activity, pa.id_strategic_activity, 
        pa.id_poi_unity, pa.id_dependency, pa.priority, pa.total, sa.id_strategic_goal, 
        sp.year_init,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=1 AND  ps.id_period=2) AS january,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=2 AND  ps.id_period=2) AS february,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=3 AND  ps.id_period=2) AS march,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=4 AND  ps.id_period=2) AS april,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=5 AND  ps.id_period=2) AS may,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=6 AND  ps.id_period=2) AS june,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=7 AND  ps.id_period=2) AS july,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=8 AND  ps.id_period=2) AS august,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=9 AND  ps.id_period=2) AS setember,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=10 AND  ps.id_period=2) AS october,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=11 AND  ps.id_period=2) AS november,
        ( SELECT ps.quanty FROM poi_schedule ps WHERE ps.id_poi_activity=pa.id_poi_activity AND ps.id_schedule=12 AND  ps.id_period=2) AS december
				FROM poi_activity pa
				INNER JOIN strategic_activity sa ON sa.id_strategic_activity=pa.id_strategic_activity
				INNER JOIN strategic_goal sg ON sg.id_strategic_goal=sa.id_strategic_goal
				INNER JOIN strategic_plan sp ON sp.id=sg.id_strategic_plan
                where pa.id_poi_activity='$request->id_poi_activity'";
        $miLista = DB::select($sql);
        return [
            'datax' => $miLista
        ];
    }

    public function deletePoiActivity(Request $request){
        // $DateOfRequest= date("Y-m-d H:i:s");
         $clasex = PoiActivity::findOrFail($request->id_poi_activity);
         $clasex->state = 'f';
        // $clasex->modificado ='Eliminado por '.Auth::user()->nick.' '. $DateOfRequest;
         $clasex->update();
     
     }

    public function getMonthPOIActivity(Request $request){
        $sqlx = "SELECT s.id, s.name, ps.quanty 
        FROM poi_activity pa 
        INNER JOIN poi_schedule ps ON ps.id_poi_activity=pa.id_poi_activity 
        INNER JOIN schedule s ON s.id=ps.id_schedule
        WHERE pa.id_poi_activity='$request->id_poi_activity'
        ORDER BY s.id";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function getPeiPOIActivity(Request $request){
        $sqlx = "SELECT pa.id_poi_activity, sa.code, sa.name, sg.name as name_goal, sg.code as code_goal
        FROM poi_activity pa
        INNER JOIN strategic_activity sa ON sa.id_strategic_activity=pa.id_strategic_activity
        INNER JOIN strategic_goal sg ON sg.id_strategic_goal=sa.id_strategic_goal
        WHERE pa.id_poi_activity='$request->id_poi_activity' ";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }

    public function getOtherPOIActivity(Request $request){
        $sqlx = "SELECT pa.id_poi_activity, bg.code, bg.name, pu.code as code_unity, pu.name as name_unity
        FROM poi_activity pa
        INNER JOIN poi_unity pu ON pu.id_poi_unity=pa.id_poi_unity
        INNER JOIN budget_activity bg ON bg.id_activity=pa.id_budget_activity
        WHERE pa.id_poi_activity='$request->id_poi_activity'";
        $miLista = DB::select($sqlx);
        return [
            'datax' => $miLista
        ];
    }
    
}
