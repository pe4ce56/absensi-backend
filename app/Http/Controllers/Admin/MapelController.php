<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageInfo']['page'] = 'mapel';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $mapels = Mapel::paginate(10);
        
        return view('admin/mapel/index', compact('data', 'mapels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageInfo']['page'] = 'mapel';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);

        return view('admin/mapel/create', compact('data'));
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
            'mapel_name' => ['required','max:100','unique:mapel,nama']
        ]);

        $mapelModel = new Mapel;
        $mapelModel->nama = $request->mapel_name;
        $mapelModel->save();

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
        $data['pageInfo']['page'] = 'mapel';
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);
        $mapel = Mapel::find($id);

        return view('admin/mapel/edit', compact('data', 'mapel'));
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
            'mapel_name' => ['required','max:100','unique:mapel,nama,'.$id.',id']
        ]);

        $mapelModel = Mapel::find($id);
        $mapelModel->nama = $request->mapel_name;
        $mapelModel->save();

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
        $mapelModel = Mapel::find($id)->delete();
        
        return redirect()->back()->with('success', 'Berhasil menghapus data.');
    }
}
