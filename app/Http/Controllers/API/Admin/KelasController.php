<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Kelas as KelasModel;

use App\Http\Resources\KelasCollection as KelasRes;

class KelasController extends Controller
{
    private static $context = 'Kelas';

    function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }

    private function term($request, $id = null)
    {
        return Validator::make($request->all(), [
            'name' => 'required|min:3|max:100|unique:kelas,nama,'.$id.',id'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = KelasRes::collection(KelasModel::get());
        return generateAPI(['data' => $kelas, 'custom_lenght' => count($kelas), 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'read'])]);
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

        $kelasModel = new KelasModel;
        $kelasModel->nama = $request->name;
        $kelasModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'create']), 'data' => $kelasModel]);
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

        $kelasModel = KelasModel::find($id);
        if(!isset($kelasModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $kelasData = KelasRes::make($kelasModel);
        return generateAPI(['data' => $kelasData, 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'find', 'id' => $id])]);
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

        $kelasModel = KelasModel::find($id);
        if(!isset($kelasModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $kelasModel->nama = $request->name;
        $kelasModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id]), 'data' => $kelasModel]);
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

        $kelasModel = KelasModel::find($id);
        if(!isset($kelasModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $kelasModel->delete();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id])]);
    }
}
