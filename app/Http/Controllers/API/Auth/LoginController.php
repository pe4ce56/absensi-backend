<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $role = $user->role;
            if($role === 'admin'){
                
            }else if($role === 'guru'){
                
            }
            $success['token'] = $user->createToken('AbsensiApp')->accessToken;
            return generateAPI(['message' => 'Login Sukses', 'data' => $success]);
        }
    }

    public function logout(Request $request)
    {
        $logout = Auth::user()->token()->revoke();
        return response()->json(['Logout Sukses' => $logout], 200);
    }
}
