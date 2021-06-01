<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Guru_Mapel;
use App\Models\Mapel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageInfo']['page'] = 'guru';
        $gurus = Guru::with(['user', 'mapels'])->orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin/guru/index', compact('data', 'gurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Guru_Mapel::get());
        $data['pageInfo']['page'] = 'guru';
        $mapels = Mapel::get();

        return view('admin/guru/create', compact('data', 'mapels'));
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

            'nip' => 'required|digits:18|unique:guru,NIP',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|max:15|unique:guru,whatsapp',
            'address' => 'required',
            'birth_date' => 'required|date',
            'mapels' => 'required'
        ]);

        $userModel = new User;
        $userModel->username = $request->nip;
        $userModel->password = bcrypt($request->password);
        $userModel->foto_profil = 'default.jpg';
        $userModel->role = 'guru';
        $userModel->save();

        $guruModel = new Guru;
        $guruModel->data_of = $userModel->id;
        $guruModel->NIP = $request->nip;
        $guruModel->nama = $request->name;
        $guruModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $guruModel->whatsapp = $request->whatsapp;
        $guruModel->alamat = $request->address;
        $guruModel->tanggal_lahir = $request->birth_date;
        $guruModel->save();
        
        foreach($request->mapels as $mapel){
            $guruMapel = new Guru_Mapel;
            $guruMapel->id_guru = $guruModel->id;
            $guruMapel->id_mapel = intval($mapel);
            $guruMapel->save();
        }

        return redirect()->back()->with('success', 'Berhasil merubah data.');
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
        $data['pageInfo']['page'] = 'guru';
        $mapels = Mapel::get();
        $guru = Guru::with(['user', 'mapels'])->find($id);

        return view('admin/guru/edit', compact('data', 'guru', 'mapels'));
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
            // 'password' => 'required|min:3|max:255',
            // 'password_conf' => 'required|same:password',
            'profile_pict' => 'image',

            'nip' => 'required|max:18|unique:guru,NIP,'.$id.',id',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|max:15|unique:guru,whatsapp,'.$id.',id',
            'address' => 'required',
            'birth_date' => 'required|date',
            'mapels' => 'required'
        ]);

        $guruModel = Guru::find($id);
        $guruModel->user->username = $request->nip;
        if(isset($request->password)) $guruModel->user->password = bcrypt($request->password);

        $guruModel->NIP = $request->nip;
        $guruModel->nama = $request->name;
        $guruModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $guruModel->whatsapp = $request->whatsapp;
        $guruModel->alamat = $request->address;
        $guruModel->tanggal_lahir = $request->birth_date;
        $guruModel->user->save();
        $guruModel->save();

        $deleteOldGuruMapel = Guru_Mapel::where('id_guru', $guruModel->id)->delete();
        foreach($request->mapels as $mapel){
            $guruMapel = new Guru_Mapel;
            $guruMapel->id_guru = $guruModel->id;
            $guruMapel->id_mapel = intval($mapel);
            $guruMapel->save();
        }

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
        $guruModel = Guru::find($id);
        $guruModel->user()->delete();
        $guruModel->mapels()->delete();
        $guruModel->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
