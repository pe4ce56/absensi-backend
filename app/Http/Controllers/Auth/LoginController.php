<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin'
        ];

        if(Auth::attempt($credentials)){
            return redirect(route('dashboard.index'));
        }

        return redirect()->back()->with('error', 'Harap periksa username/password.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login.index'));
    }
}
