<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru_Mapel;
use App\Models\Kelas;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageInfo']['page'] = 'jadwal';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $jadwals = Jadwal::with(['class', 'teacher_mapel', 'teacher_mapel.teacher', 'teacher_mapel.mapel'])->paginate(10);
        // dd($jadwal);

        return view('admin/jadwal/index', compact('data', 'jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageInfo']['page'] = 'jadwal';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $guruMapels = Guru_Mapel::with(['teacher', 'mapel'])->get();
        $kelases = Kelas::get();

        return view('admin/jadwal/create', compact('data', 'guruMapels', 'kelases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'day' => 'required|numeric|between:1,5',
            'time' => 'required|date_format:H:i',
            'class' => 'required|numeric',
            'teacher_mapel' => 'required|numeric'
        ]);

        $jadwalModel = new Jadwal;
        $jadwalModel->hari = $request->day;
        $jadwalModel->waktu = $request->time;
        $jadwalModel->id_kelas = $request->class;
        $jadwalModel->id_guru_mapel = $request->teacher_mapel;
        $jadwalModel->save();

        return redirect()->back()->with('success', 'Berhasil mengisi data.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageInfo']['page'] = 'jadwal';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $jadwal = Jadwal::find($id);
        $guruMapels = Guru_Mapel::with(['teacher', 'mapel'])->get();
        $kelases = Kelas::get();
        $dayList = [ 1 => 'senin', 2 => 'selasa', 3 => 'rabu', 4 => 'kamis', 5 => 'jumat'];

        return view('admin/jadwal/edit', compact('data', 'jadwal', 'dayList', 'guruMapels', 'kelases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'day' => 'required|numeric|between:1,5',
            'time' => 'required|date_format:H:i',
            // 'class' => 'required|numeric',
            // 'teacher_mapel' => 'required|numeric'
        ]);

        $jadwalModel = Jadwal::find($id);
        $jadwalModel->hari = $request->day;
        $jadwalModel->waktu = $request->time;
        // $jadwalModel->id_kelas = $request->class;
        // $jadwalModel->id_guru_mapel = $request->teacher_mapel;
        $jadwalModel->save();

        return redirect()->back()->with('success', 'Berhasil merubah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalModel = Jadwal::find($id);
        $jadwalModel->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
