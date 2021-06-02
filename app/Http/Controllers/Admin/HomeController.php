<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['pageInfo']['page'] = 'dashboard';

        return view('admin.dashboard.index', compact('data'));
    }
}
