<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    //for login function
    public function loginuser(Request $request)
    {
        /* kalau authetication hanya akan request email dan password sahaja, dan jika betul maka return to the homepage iaitu '/',
        sebaliknya, return to login */
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect('/login');
    }

    public function register()
    {
        return view('register');
    }

    //function for registration function
    public function registeruser(Request $request)
    {
        /*
        cara vardump in laravel
        dd($request->all());
        */

        //register function using eloquent based on model User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
