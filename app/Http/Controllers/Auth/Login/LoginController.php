<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;



class LoginController extends Controller
{
    //

    protected $maxAttempts = 2;
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request){

        if($request->isMethod('post')){

            $validation = $request->validate([
                'email' => ['required','string','email','max:100','exists:users',],
                'password' => ['required','string','max:30','min:8',],
            ]);

            $data=$request->only('email','password');

            if(Auth::attempt($data)) {

                 return redirect('/top');
            }
         }
        return view('auth.login');
    }

    public function logout(Request $request)
    {
       Auth::logout();

       return redirect('/login');
    }

}
