<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Guru;
use \Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data['pageInfo']['page'] = 'dashboard';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $data['student_count'] = Siswa::get()->count();
        $data['teacher_count'] = Guru::get()->count();
        $data['class_count'] = Kelas::get()->count();

        return view('admin.dashboard.index', compact('data'));
    }

    public function changePassword(Request $request)
    {
        $data['pageInfo']['page'] = 'change-password';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);

        return view('admin.account.changepass', compact('data'));
    }

    public function changePasswordStore(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:3|max:255',
            'password_conf' => 'required|same:password',
        ]);
        
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengubah password.');
    }
}
