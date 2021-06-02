<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;

class HomeController extends Controller
{
    public function index()
    {
        $data['pageInfo']['page'] = 'dashboard';
        $data['student_count'] = Siswa::get()->count();
        $data['teacher_count'] = Guru::get()->count();
        $data['class_count'] = Kelas::get()->count();

        return view('admin.dashboard.index', compact('data'));
    }
}
