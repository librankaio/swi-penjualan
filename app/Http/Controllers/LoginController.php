<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request){
        // dd(request()->all());
        if(Auth::attempt($request->only('name', 'password'))){
            $request->session()->regenerate();
            $username = Auth::User()->name;
            $request->session()->put('username', $username);

            return redirect()->intended('/penjualan');
        }
        return redirect()->back();
    }

    public function logout(request $request){
        Auth::logout();
        return redirect('/');
    }
}
