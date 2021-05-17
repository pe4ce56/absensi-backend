<?php

namespace App\Http\Controllers\API\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Auth;

use App\Models\Siswa as SiswaModel;
use App\Models\Absensi as AbsensiModel;

use App\Http\Resources\JadwalCollection as JadwalRes;
use App\Http\Resources\AbsensiCollection as AbsentRes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;

class HomeController extends Controller
{
    public  $id_schedule;

    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:siswa']);
    }



    public function getStudentSchedule(Request $request)
    {
        $dataOf = Auth::user()->id;

        $siswaModel = SiswaModel::with(['class', 'class.schedule', 'class.schedule.teacher_mapel.teacher', 'class.schedule.teacher_mapel.mapel'])->where('data_of', $dataOf)->first();
        $scheduleData = JadwalRes::collection($siswaModel->class->schedule);

        return generateAPI(['data' => $scheduleData, 'message' => generateAPIMessage(['context' => 'jadwal siswa', 'type' => 'find', 'id' => $dataOf])]);
    }



    public function getAbsent()
    {
        $dataOf = Auth::user()->id;

        $siswaModel = SiswaModel::with('class')
            ->with(['class.schedule.absent' => function ($q) {
                $q->whereDate('created_at',  Carbon::today()->toDateString());
            }])
            ->with(['class.schedule' => function ($q) {
                $q->where('hari',  date('N'));
            }])

            ->where('data_of', $dataOf)
            ->first();
        // dd($siswaModel);
        $absentData = AbsentRes::collection($siswaModel->class->schedule);
        return generateAPI(['data' => $absentData, 'message' => generateAPIMessage(['context' => 'absensi siswa', 'type' => 'find', 'id' => $dataOf])]);
    }
    public function getAbsentBySchedule(Request $request, $id_schedule)
    {
        $this->id_schedule = $id_schedule;
        $dataOf = Auth::user()->id;
        $siswaModel = SiswaModel::with('class')

            ->with(['class.schedule.absent' => function ($q) {
                $q->whereDate('created_at',  Carbon::today()->toDateString());
            }])
            ->with(['class.schedule' => function ($q) {
                $q->where('id', $this->id_schedule);
            }])
            ->where('data_of', $dataOf)
            ->first();
        // dd($siswaModel);
        $absentData = AbsentRes::collection($siswaModel->class->schedule);
        return generateAPI(['data' => $absentData, 'message' => generateAPIMessage(['context' => 'absensi siswa', 'type' => 'find', 'id' => $dataOf])]);
    }
    public function absent(Request $request)
    {
        $dataOf = Auth::user()->id;

        $siswaId = SiswaModel::where('data_of', $dataOf)->first()->id;

        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|numeric',
            'absent_time' => 'required|date_format:H:i:s',
            'location' => 'required',
        ]);
        if ($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $absensiModel = new AbsensiModel;
        $absensiModel->id_siswa = $siswaId;
        $absensiModel->id_jadwal = $request->schedule_id;
        $absensiModel->waktu = $request->absent_time;
        $absensiModel->lokasi = $request->location;
        $absensiModel->keterangan = $request->description ?? null;
        $absensiModel->status = $request->status ?? null;
        $absensiModel->save();

        return generateAPI(['data' => $absensiModel, 'message' => generateAPIMessage(['context' => 'absensi', 'type' => 'create'])]);
    }
}
