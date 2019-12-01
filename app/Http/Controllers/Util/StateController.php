<?php
namespace poi\Http\Controllers\Util;

use Illuminate\Http\Request;
use poi\Http\Controllers\Controller;
use poi\Http\Requests as BaseController;
use Illuminate\Support\Facades\Redirect;

class StateController extends Controller
{
    public $statePledgeDelete=0; //eliminado
    public $statePledgePawned=1; //empeñado
    public $statePledgedefeated=2;//vencido
    public $statePledgeInSale=3;//en venta
    public $statePledgeSale=4;//vendido
    public $statePledgepaid=5;//prestamo pagado


    public function __construct()
	{
        //$this->middleware('auth');
       
    }
    public function getStatePledgeDelete(){
            return $this->statePledgeDelete;
    }
}




