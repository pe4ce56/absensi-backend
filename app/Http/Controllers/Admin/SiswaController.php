<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageInfo']['page'] = 'siswa';
        $siswas = Siswa::with(['user', 'absent', 'class'])->paginate(10);

        return view('admin/siswa/index', compact('data', 'siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageInfo']['page'] = 'siswa';
        $kelases = Kelas::get();

        return view('admin/siswa/create', compact('data', 'kelases'));
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
            'password' => 'required|min:3|max:255',
            'password_conf' => 'required|same:password',
            'profile_pict' => 'image',

            'nisn' => 'required|digits:10|unique:siswa,NISN',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|unique:siswa,whatsapp',
            'address' => 'required',
            'birth_date' => 'required|date',
            'student_pict' => 'image',
            'class_id' => 'required|numeric'
        ]);
        
        $file = $request->file('student_pict');
        if($file){
            $fileName = $request->nisn."_.".$file->getClientOriginalExtension();
            $file->move('upload/siswa', $fileName);
        }

        $userModel = new User;
        $userModel->username = $request->nisn;
        $userModel->password = bcrypt($request->password);
        $userModel->foto_profil = $request->profile_pict ?? 'default.jpg';
        $userModel->role = 'siswa';
        $userModel->save();

        $siswaModel = new Siswa;
        $siswaModel->data_of = $userModel->id;
        $siswaModel->NISN = $request->nisn;
        $siswaModel->nama = $request->name;
        $siswaModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $siswaModel->whatsapp = $request->whatsapp;
        $siswaModel->alamat = $request->address;
        $siswaModel->tanggal_lahir = $request->birth_date;
        $siswaModel->foto_siswa = $fileName ?? 'siswa.jpg';
        $siswaModel->id_kelas = $request->class_id;
        $siswaModel->save();

        return redirect()->back()->with('success', 'Berhasil menambah data.');
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
        $data['pageInfo']['page'] = 'siswa';
        $siswa = Siswa::with(['user', 'absent', 'class'])->find($id);
        $kelases = Kelas::get();

        return view('admin/siswa/edit', compact('data', 'siswa', 'kelases'));
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
        // $userId = isset($id) ? (SiswaModel::find($id)->data_of ?? null) : null;
        $this->validate($request, [
            // 'password' => 'min:3|max:255',
            // 'password_conf' => 'same:password',
            'profile_pict' => 'image',

            'nisn' => 'required|digits:10|unique:siswa,NISN,'.$id.',id',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|unique:siswa,whatsapp,'.$id.',id',
            'address' => 'required',
            'birth_date' => 'required|date',
            'student_pict' => 'image',
            'class_id' => 'required|numeric'
        ]);

        $siswaModel = Siswa::find($id);

        $file = $request->file('student_pict');
        if(isset($file)){
            $filePath = public_path('upload\siswa\\'.$siswaModel->foto_siswa);
            if(File::exists($filePath)) unlink($filePath);

            $fileName = $request->nisn."_.".$file->getClientOriginalExtension();
            $file->move('upload/siswa', $fileName);
        }

        $siswaModel->user->username = $request->nisn;
        if($request->password) $siswaModel->user->password = bcrypt($request->password);
        $siswaModel->user->foto_profil = $request->profile_pict ?? $siswaModel->user->foto_profil;

        $siswaModel->NISN = $request->nisn;
        $siswaModel->nama = $request->name;
        $siswaModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $siswaModel->whatsapp = $request->whatsapp;
        $siswaModel->alamat = $request->address;
        $siswaModel->tanggal_lahir = $request->birth_date;
        if(isset($fileName)){
            $siswaModel->foto_siswa = $fileName;
        }
        $siswaModel->id_kelas = $request->class_id;
        $siswaModel->save();

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
        $siswaModel = Siswa::find($id);
        $filePath = public_path('upload\siswa\\'.$siswaModel->foto_siswa);
        if(File::exists($filePath)) unlink($filePath);
        $siswaModel->user()->delete();
        $siswaModel->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
