<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

use App\Mapel;

class MapelController extends Controller
{
    private static $context = 'Mapel';

    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }

    private function term($request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'mapel_name' => ['required','max:100','unique:mapel,nama,'.$id.',id']
        ]);
        
        return $validator;
    }

    public function store(Request $request)
    {   
        $validator = $this->term($request);

        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $mapel = new Mapel;
        $mapel->nama = $request->mapel_name;
        $mapel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context]), 'data' => $mapel]);
    }

    public function read(Request $request)
    {
        return generateAPI(['message' => generateAPIMessage(['context' => self::$context]), 'data' => Mapel::get()]);
    }

    public function find(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id));
        $mapel = Mapel::where('id', $id)->first();

        if($mapel) return generateAPI(['message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id]), 'data' => $mapel]);
        return generateAPI(['message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false), 'code' => 404, 'status' => false]);
    }

    public function update(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id));
        $mapel = Mapel::where('id', $id)->first();
        if(!$mapel) return generateAPI(['message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false), 'code' => 404, 'status' => false]);

        $validator = $this->term($request, $id);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $mapel->nama = $request->mapel_name;
        $mapel->save();
        
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id]), 'data' => $mapel]);
    }

    public function delete(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id));
        $mapel = Mapel::where('id', $id)->first();
        if(!$mapel) return generateAPI(['message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id], false), 'code' => 404, 'status' => false]);

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id]), 'data' => $mapel->delete()]);
    }

}
