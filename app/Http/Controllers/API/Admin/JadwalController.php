<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jadwal as JadwalModel;

use App\Http\Resources\JadwalCollection as JadwalRes;

class JadwalController extends Controller
{
    private static $context = 'Jadwal';

    private function term($request, int $id = null)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required|numeric|between:0,6',
            'time' => 'required|date_format:Y-m-d H:i:s',
            'class_id' => 'required|numeric',
            'teacher_mapel_id' => 'required|numeric'
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
        $jadwal = JadwalRes::collection(JadwalModel::with(['class', 'teacher_mapel'])->get());

        return generateAPI(['data' => $jadwal, 'custom_lenght' => count($jadwal), 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'read'])]);
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

        $day = intval($request->day);
        switch($day){
            case 0 : $day = 'minggu';
            break;
            case 1 : $day = 'senin';
            break;
            case 2 : $day = 'selasa';
            break;
            case 3 : $day = 'rabu';
            break;
            case 4 : $day = 'kamis';
            break;
            case 5 : $day = 'jumat';
            break;
            case 6 : $day = 'sabtu';
            break;
            default : null;
            break;
        }
        
        $jadwalModel = new JadwalModel;
        $jadwalModel->hari = $day;
        $jadwalModel->waktu = $request->time;
        $jadwalModel->id_kelas = intval($request->class_id);
        $jadwalModel->id_guru_mapel = intval($request->teacher_mapel_id);
        $jadwalModel->save();

        $jadwalData = JadwalRes::make(JadwalModel::find($jadwalModel->id));
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'create']), 'data' => $jadwalData]);
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

        $jadwalModel = JadwalModel::with(['class', 'teacher_mapel'])->find($id);
        if(!isset($jadwalModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $jadwalData = JadwalRes::make($jadwalModel);
        return generateAPI(['data' => $jadwalData, 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'find', 'id' => $id])]);
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

        $jadwalModel = JadwalModel::find($id);
        if(!isset($jadwalModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $day = intval($request->day);
        switch($day){
            case 0 : $day = 'minggu';
            break;
            case 1 : $day = 'senin';
            break;
            case 2 : $day = 'selasa';
            break;
            case 3 : $day = 'rabu';
            break;
            case 4 : $day = 'kamis';
            break;
            case 5 : $day = 'jumat';
            break;
            case 6 : $day = 'sabtu';
            break;
            default : null;
            break;
        }

        $jadwalModel->hari = $day;
        $jadwalModel->waktu = $request->time;
        $jadwalModel->id_kelas = intval($request->class_id);
        $jadwalModel->id_guru_mapel = intval($request->teacher_mapel_id);
        $jadwalModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id]), 'data' => $jadwalModel]);
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

        $jadwalModel = JadwalModel::find($id);
        if(!isset($jadwalModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $jadwalModel->delete();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id])]);
    }
}
