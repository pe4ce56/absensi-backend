<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data['pageInfo']['page'] = 'setting';

        //Get json file
        $jsonString = file_get_contents(base_path('configuration.json'));
        $data['configuration'] = json_decode($jsonString, true);

        return view('admin.setting.index', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'app_name' => 'required|max:15',
            'app_logo' => 'image'
        ]);
        
        //Get json file
        $jsonString = file_get_contents(base_path('configuration.json'));
        $configuration = json_decode($jsonString, true);

        $file = $request->file('app_logo');
        if(isset($file)){
            $filePath = public_path('app\\'.($configuration['app-logo'] ?? 'logo.png'));
            if(File::exists($filePath)) unlink($filePath);

            $fileName = 'logo.'.$file->getClientOriginalExtension();
            $file->move('app/', $fileName);

            $configuration['app-logo'] = $fileName;
        }

        $configuration['app-name'] = $request->app_name;

        $newJsonString = json_encode($configuration, JSON_PRETTY_PRINT);
        file_put_contents(base_path('configuration.json'), stripslashes($newJsonString));
        
        return redirect()->back()->with('success', 'Berhasil merubah data.');
    }
}
