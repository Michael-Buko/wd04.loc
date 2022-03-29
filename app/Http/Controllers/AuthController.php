<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('my-auth.login');
    }


    public function auth(Request $request){
        Auth::attempt($request->only(['email', 'password']));
    }

    public function logout(Request $request){
        Auth::logout();
    }
}
