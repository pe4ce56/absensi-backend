<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

use App\Mapel;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }


    public function store(Request $request)
    {   
        $mapel = new Mapel;
        $mapel->nama = 'B indo';
        $mapel->save();
        return generateAPI(['message' => true]);
    }

}
