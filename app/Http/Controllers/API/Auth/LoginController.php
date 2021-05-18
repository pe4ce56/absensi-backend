<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    private function term($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        
        return $validator;
    }

    /*
    public function loginAsAdmin(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin'
        ];

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $data['token'] = $user->createToken('AsAdmin')->accessToken;
            $data['user'] = new \stdClass();
            $data['user']->id = $user->id;
            $data['user']->role = 'admin';
            return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => true]);
        }
    }
    */

    public function loginProcess(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $username = $request->username;

        /*
        * For array in Auth::attempt
        * For role admin and worker is login is use username and password
        * For student role username is NISN
        * For teacher role username is NIP
        * For teacher tidak tetap username is Teacher Code
        */
        $credentials = [
            'username' => $username,
            'password' => $request->password
        ];


        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $role = $user->role;

            /**
             * Create token initializator with AsRole
             */
            $data['token'] = $user->createToken('As' . ucfirst($role))->accessToken;
            $data['user'] = new \stdClass();
            $data['user']->id = $user->id;
            $data['user']->role = $role;
            $data['user']->username = $user->username;
            $data['user']->profile_pict = $user->foto_profil;

            return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => true]);
        }
        return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return generateAPI(['message' => 'Logout sukses']);
    }
}
