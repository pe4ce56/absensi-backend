<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $data['pageInfo']['page'] = 'absensi';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        
        $absents = Absensi::get();
        $class = $request->class;
        
        $tmp = [];
        if($class !== '' && $class !== null){
            foreach($absents as $absent){
                if($absent->schedule->class->id == $class || $absent->student->class->id == $class ) $tmp [] = $absent;
            }
            $absents = $tmp;
        }

        $kelases = Kelas::get();
        $startTime = Carbon::now();
        // $startTime->hour = 09;
        // $startTime->minute = 00;
        // dd($absents_come, $absents_out);

        return view('admin.absensi.index', compact('data', 'absents', 'kelases'));
    }

    public function changeStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|in:n/a,s,i,a'
        ]);
        
        $absent = Absensi::find($id);
        $absent->status = $request->status == 'n/a' ? null : $request->status;
        $absent->save();
        
        return redirect()->back()->with('success', 'Berhasil mengubah data.');
    }

    public function printReport(Request $request)
    {
        // dd($request->all(), Absensi::where(function($query){ dd($query); })->get());
        $absents = Absensi::get();
        $class = $request->class;
        $tmp = [];

        if($class !== '' && $class !== null){
            foreach($absents as $absent){
                if($absent->schedule->class->id == $class || $absent->student->class->id == $class ) $tmp [] = $absent;
            }
            $absents = $tmp;
        }

        // dd($tmp);

        return view('admin.report.print', compact('absents'));
    }
}
