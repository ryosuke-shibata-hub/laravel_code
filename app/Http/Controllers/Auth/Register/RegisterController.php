<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users\User;


class RegisterController extends Controller
{
    //

     protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => hash::make($data['password']),
        ]);
    }

    public function register(Request $request){



        if($request->isMethod('post')){

            $validation = $request->validate([
                'username' => ['bail','required','string','max:30','unique:users',],
                'email' => ['bail','required','string','email','max:100','unique:users'],
                'password' => ['bail','required','string','max:30','min:8','same:password_confirmed'],
                'password_confirmed' => ['bail','required','string','max:30','min:8','same:password',],
            ]);

            $data = $request->input();
            $this->create($data);
        ;
        return redirect('/added');
    }

        return view('auth.register');
    }

    public function added(){

        return view('auth.added');
    }
}
