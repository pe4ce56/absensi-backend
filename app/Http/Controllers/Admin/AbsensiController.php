<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $data['pageInfo']['page'] = 'absensi';
        $absents = Absensi::paginate(10);
        $startTime = Carbon::now();
        // $startTime->hour = 09;
        // $startTime->minute = 00;
        // dd($absents_come, $absents_out);

        return view('admin.absensi.index', compact('data', 'absents'));
    }
}
