<?php
namespace poi\Http\Controllers\Register;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;
use poi\EntityClass\Warehouse;


use Illuminate\Support\Facades\Auth;
use DB;

ini_set ('memory_limit', '999999999999M');
ini_set('max_execution_time', 900000000000);
ini_set('post_max_size', '9999999999999M');
ini_set('upload_max_filesize', '9999999999M');

class WarehouseController extends Controller
{
    public function __construct()
	{
        //$this->middleware('auth');
    }
  
    public function get(Request $request){
        $queyDependence="";
         $queyDependence="select * from warehouse where state='1'";
        
       
        $listDependence = DB::select($queyDependence);
          return [
              'datax'=>$listDependence,
          ];
    }
    
}




