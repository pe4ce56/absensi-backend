<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

use App\Models\User;

class LoginController extends Controller
{
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
            return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => false]);
        }
    }

    public function loginAsStudentAndTeacher(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $username = $request->username;
        if(!preg_match('/[\D]/', $username)){
            $credentials = [
                'NISN' => $username,
                'password' => $request->password
            ];
            if(Auth::guard('siswa')->attempt($credentials)){
                $user = Auth::guard('siswa')->user();
                $data['token'] = $user->createToken('AsSiswa')->accessToken;
                $data['user'] = new \stdClass();
                $data['user']->id = $user->id;
                $data['user']->role = 'siswa';
                return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => false]);
            }
            return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403]);
        }else{
            $credentials = [
                'username' => $username,
                'password' => $request->password,
                'role' => 'guru'
            ];
            if(Auth::guard('guru')->attempt($credentials)){
                $user = Auth::guard('guru')->user();

                $data['token'] = $user->createToken('AsGuru')->accessToken;
                $data['user'] = new \stdClass();
                $data['user']->id = $user->id;
                $data['user']->role = 'guru';
                return generateAPI(['message' => 'Login Sukses', 'data' => $data, 'status' => false]);
            }
            return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403]);
        }
        return generateAPI(['message' => 'Harap periksa username dan password', 'code' => 403]);
    }

    public function logout(Request $request)
    {
        $logout = Auth::user()->token()->revoke();
        return response()->json(['Logout Sukses' => $logout], 200);
    }
}
