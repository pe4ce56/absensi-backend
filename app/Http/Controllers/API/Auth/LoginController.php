<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use \Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    public function accessDenied()
    {
        return generateAPI(['code' => 403, 'message' => 'Akses ditolak.']);
    }

    private function term($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        return $validator;
    }

    private function loginProcess(array $credentials)
    {
        /*
        * For array in Auth::attempt
        * For role admin and worker is login is use username and password
        * For student role username is NISN
        * For teacher role username is NIP
        * For teacher tidak tetap username is Teacher Code
        */

        if (Auth::attempt($credentials)) {
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

            return $data;
        }
        return false;
    }

    public function defaultLogin(Request $request)
    {
        /**
         * REQUIRED
         * Validate the user input before processing ! 
         */
        $validator = $this->term($request);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => ['siswa', 'guru']
        ];

        $login = $this->loginProcess($credentials);

        return $login ? generateAPI(['message' => 'Login Sukses', 'data' => $login, 'status' => true]) : generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
    }

    public function operatorLogin(Request $request)
    {
        /**
         * REQUIRED
         * Validate the user input before processing ! 
         */
        $validator = $this->term($request);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'operator'
        ];

        $login = $this->loginProcess($credentials);

        return $login ? generateAPI(['message' => 'Login Sukses', 'data' => $login, 'status' => true]) : generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
    }

    public function adminLogin(Request $request)
    {
        /**
         * REQUIRED
         * Validate the user input before processing ! 
         */
        $validator = $this->term($request);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin'
        ];

        $login = $this->loginProcess($credentials);

        return $login ? generateAPI(['message' => 'Login Sukses', 'data' => $login, 'status' => true]) : generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return generateAPI(['message' => 'Logout sukses']);
    }
}
