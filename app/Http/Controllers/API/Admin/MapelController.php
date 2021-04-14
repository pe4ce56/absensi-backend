<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Mapel as MapelModel;
use App\Http\Resources\MapelCollection as MapelRes;

class MapelController extends Controller
{
    private static $context = 'Mapel';

    function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }

    /**
     * For validation template
     */
    private function term($request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'mapel_name' => ['required','max:100','unique:mapel,nama,'.$id.',id']
        ]);
        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $mapel = MapelRes::collection(MapelModel::with('teachers')->get());
        // $mapel2 = MapelModel::paginate(3); Jaga Jaga buat pagination
        return generateAPI(['data' => $mapel, 'custom_lenght' => count($mapel), 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'read'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $mapelModel = new MapelModel;
        $mapelModel->nama = $request->mapel_name;
        $mapelModel->save();
        
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'create']), 'data' => $mapelModel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $mapelModel = MapelModel::with('teachers')->find($id);
        if(!isset($mapelModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $mapelData = MapelRes::make($mapelModel);
        return generateAPI(['data' => $mapelData, 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'find', 'id' => $id])]);
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
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;
        $validator = $this->term($request, $id);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $mapelModel = MapelModel::find($id);
        if(!isset($mapelModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $mapelModel->nama = $request->mapel_name;
        $mapelModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id]), 'data' => $mapelModel]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;
        
        $mapelModel = MapelModel::find($id);
        if(!isset($mapelModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id], false)]);

        $mapelModel->delete();
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id])]);
    }
}
