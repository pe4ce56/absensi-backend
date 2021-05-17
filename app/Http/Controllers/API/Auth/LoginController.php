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

    public function loginAsAdmin(Request $request)
    {
        $validator = $this->term($request);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'admin'
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['token'] = $user->createToken('AsAdmin')->accessToken;
            $data['user'] = new \stdClass();
            $data['user']->id = $user->id;
            $data['user']->role = 'admin';
            return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => true]);
        }
    }

    public function loginAsStudentAndTeacher(Request $request)
    {
        $validator = $this->term($request);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $username = $request->username;

        /*
        * For array in Auth::attempt
        * For all role is login is use username and password
        * For student role username is NISN
        */
        $credentials = [
            'username' => $username,
            'password' => $request->password
        ];

        /*
        * If username contains character except a number
        * Then login as a Student
        */
        if (!preg_match('/[\D]/', $username)) {
            $credentials['role'] = 'siswa';
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $data['token'] = $user->createToken('AsSiswa')->accessToken;
                $data['user'] = new \stdClass();
                $data['user']->id = $user->id;
                $data['user']->role = 'siswa';
                return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => true]);
            }
            return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
        }
        /*
        * Else login as a Teacher
        */ else {
            $credentials['role'] = 'guru';
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $data['token'] = $user->createToken('AsGuru')->accessToken;
                $data['user'] = new \stdClass();
                $data['user']->id = $user->id;
                $data['user']->role = 'guru';
                return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => true]);
            }
        }
        return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403, 'status' => false]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return generateAPI(['message' => 'Logout sukses']);
    }
}
