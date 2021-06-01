<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageInfo']['page'] = 'kelas';
        $kelasses = Kelas::with('students')->paginate(10);

        return view('admin/kelas/index', compact('data', 'kelasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageInfo']['page'] = 'kelas';

        return view('admin/kelas/create', compact('data'));
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
            'name' => 'required|min:3|max:100|unique:kelas,nama'
        ]);

        $kelas = Kelas::create([
            'nama' => $request->name
        ]);

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
        $data['pageInfo']['page'] = 'kelas';
        $kelas = Kelas::with('students')->find($id);

        return view('admin/kelas/edit', compact('data', 'kelas'));
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
            'name' => 'required|min:3|max:100|unique:kelas,nama,'.$id.',id'
        ]);

        $kelas = Kelas::find($id)->update([
            'nama' => $request->name
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
