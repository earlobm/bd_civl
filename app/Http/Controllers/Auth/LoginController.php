<?php

namespace poi\Http\Controllers\Auth;

use poi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use poi\EntityClass\User;
use DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   
   // protected $redirectTo = '/main';
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('login');
       // return redirect('/');
    }

    public function login(Request $request){
        $this->validateLogin($request);        

        if (Auth::attempt(['nick' => $request->usuario,'password' => $request->password,'state'=>1])){
            $DateOfRequest = date("Y-m-d H:i:s");
            $user = User::where('nick', $request->usuario)->firstOrFail();
            $user->last_entry = $DateOfRequest;
            $user->ip_access =$request->ip();
            $user->save();
            
          //  DB::statement(" update pledge set state=2 where current_date()>date_end and state=1");
          //  DB::statement("update detail_pledge set state=2 where current_date()>date_end and state=1");

            //guardando el historial
            // $clasex = new History();
            // $clasex->id_user = $user->id;
            // $clasex->ip_access =$request->ip();
            // $clasex->date_access =$DateOfRequest;
            // $clasex->acction =strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')?'Ingresó al sistema desde su Celular':'Ingresó al sistema desde su Computadora';
            // $clasex->detail=$_SERVER['HTTP_USER_AGENT'];
            // $clasex->save();

            return redirect()->route('main');
        }
      
        // return redirect()->route('main');
        return back()
        ->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));

    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
