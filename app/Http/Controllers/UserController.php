<?php

namespace poi\Http\Controllers;

use Illuminate\Http\Request;

use sisQuipu\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use sisQuipu\Notifications\NotifyAdmin;

class UserController extends Controller
{
    public function __construct()
	{
		//$this->middleware('auth');
    }
    public function migrar()
    {
        $midatax=DB::select('select * from usuario');
        $midata = json_decode(json_encode($midatax), true);
        foreach($midata as $index => $midatax) {
            try{
                DB::beginTransaction();
                $user = new User();
               // $user->name = $request->usuario;
                $user->email = $midatax['email'];
                $user->nombres = $midatax['nombres'];
                $user->apellidos = $midatax['apellidos'];
                $user->celular = $midatax['celular'];
                $user->estado =$midatax['estado'];
                $user->nick =$midatax['usuario'];
                $user->password = bcrypt($midatax['clave']); 
                $user->dni = $midatax['idusuario']; 
                $user->save();
                DB::commit();
            } catch (Exception $e){
                DB::rollBack();
            }
        }
    }

    public function index(Request $request)
	{
		$buscar =  strtoupper($request->buscar);
        
        if ($buscar==''){
            $datax= User::orderBy('estado', 'desc')->orderBy('ultimo_ingreso', 'desc')->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $datax = User::where(DB::raw("concat(UPPER(nombres),' ',UPPER(apellidos),' ',dni)"), 'like', '%'. $buscar . '%')->orderBy('estado', 'desc')->orderBy('ultimo_ingreso', 'desc')->orderBy('id', 'desc')->paginate(10);
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
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $user = new User();
            $user->sexo = $request->sexo;
            $user->id_cargo = $request->cargo;
            $user->email = $request->email;
            $user->nombres = $request->nombres;
            $user->apellidos = $request->apellidos;
            $user->celular = $request->celular;
            $user->dni = $request->dni;
            $user->estado ='1';
            $user->nick =$request->usuario;
            $user->password = bcrypt( $request->password); 
           // $user->url_foto = ($request->sexo=='F'?'img/users/f.png':'img/users/m.png'); 

            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function update(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->sexo = $request->sexo;
            $user->id_cargo = $request->cargo;
            $user->email = $request->email;
            $user->nombres = $request->nombres;
            $user->apellidos = $request->apellidos;
            $user->celular = $request->celular;
            $user->dni = $request->dni;
            $user->estado ='1';
            $user->nick =$request->usuario;
            $user->password = bcrypt( $request->password); 
            //$user->url_foto = ($request->sexo=='F'?'img/users/f.png':'img/users/m.png'); 

            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function disable_user(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }
    public function enable_user(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->state = '1';
        $user->save();
    }
}
