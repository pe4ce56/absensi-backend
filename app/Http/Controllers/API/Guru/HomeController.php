<?php

namespace App\Http\Controllers\API\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Guru as GuruModel;
use App\Models\Guru_Mapel as GuruMapelModel;
use App\Models\Jadwal as JadwalModel;
use App\Models\Absensi as AbsensiModel;

use App\Http\Resources\JadwalCollection as JadwalRes;
use App\Http\Resources\AbsensiCollection as AbsensiRes;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:guru']);
    }

    public function getAbsent(Request $request, $date)
    {
        $absentData = AbsensiRes::collection(AbsensiModel::with(['schedule', 'schedule.teacher_mapel.teacher', 'student'])
            ->whereDate('created_at', Carbon::createFromFormat('m-d-Y', $date)->toDateString())->orderBy('waktu')->get());

        /**
         * I use another instance of laravel collection is for remove(filter)
         * an empty array from array list.
         */
        $tempData = collect($absentData)->filter();

        return generateAPI(['data' => $tempData, 'custom_lenght' => count($tempData), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }

    public function getAbsentStudentList(Request $request, $id_schedule, $date)
    {
        $absentData = AbsensiRes::collection(AbsensiModel::with(['schedule', 'schedule.teacher_mapel.teacher', 'student'])
            ->where('id_jadwal', $id_schedule)
            ->whereDate('created_at', Carbon::createFromFormat('m-d-Y', $date)->toDateString())->orderBy('waktu')->get());
        $tempData = collect($absentData)->filter();

        return generateAPI(['data' => $tempData, 'custom_lenght' => count($tempData), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'find', 'id' => $id_schedule])]);
    }

    public function getSchedule()
    {
        $data = [];
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        for ($day = 0; $day < 7; $day++) {

            $jadwal = JadwalModel::with(['teacher_mapel.mapel',  'class'])->where('hari', $day + 1)->orderBy('waktu')->get();
            $res = JadwalRes::collection($jadwal);
            $temp = collect($res)->filter();
            $data[$days[$day]] = $temp;
        }

        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read',])]);
    }
    public function getScheduleByDay(Request $request, $day)
    {
        $jadwal = JadwalModel::with(['teacher_mapel.mapel',  'class'])->where('hari', $day)->orderBy('waktu')->get();
        $res = JadwalRes::collection($jadwal);
        $data = collect($res)->filter();

        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }
    public function getScheduleByDate(Request $request, $date)
    {
        /**
         * Don't delete this for a week
         */
        // $guruId = GuruModel::where('data_of', Auth::user()->id)->first()->id;
        // $pivotId = GuruMapelModel::select('id')->where('id_guru', $guruId)->get();
        // $jadwalModel = JadwalModel::with('teacher_mapel.mapel')->whereIn('id_guru_mapel', $pivotId)->get();

        $jadwalData = JadwalRes::collection(JadwalModel::with(['teacher_mapel.mapel',  'class'])->where('hari',  Carbon::createFromFormat('m-d-Y', $date)->dayOfWeekIso + 1)->get());

        /**
         * Same with above
         */
        $tempData = collect($jadwalData)->filter();

        return generateAPI(['data' => $tempData, 'custom_lenght' => count($tempData), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }
}
