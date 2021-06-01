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
use App\Http\Resources\SiswaCollection;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
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
        $data = array_values(array_filter(objectToArray($absentData)));


        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }

    public function getAbsentStudentList(Request $request, $id_schedule, $date)
    {
        $absentData = AbsensiRes::collection(AbsensiModel::with(['schedule', 'schedule.teacher_mapel.teacher', 'student'])
            ->where('id_jadwal', $id_schedule)
            ->whereDate('created_at', Carbon::createFromFormat('m-d-Y', $date)->toDateString())->orderBy('waktu')->get());
        $data = array_values(array_filter(objectToArray($absentData)));


        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'find', 'id' => $id_schedule])]);
    }

    public function getSchedule()
    {
        /**
         *  for a week
         */
        $data = [];
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        for ($day = 0; $day < 7; $day++) {

            $jadwal = JadwalModel::with(['teacher_mapel.mapel',  'class'])->where('hari', $day + 1)->orderBy('waktu')->get();
            $res = JadwalRes::collection($jadwal);
            $temp = array_values(array_filter(objectToArray($res)));

            $data[$days[$day]] = $temp;
        }

        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read',])]);
    }

    public function getScheduleByDay(Request $request, $day)
    {
        $jadwal = JadwalModel::with(['teacher_mapel.mapel',  'class'])->where('hari', $day)->orderBy('waktu')->get();
        $res = JadwalRes::collection($jadwal);
        $data = array_values(array_filter(objectToArray($res)));
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

        $jadwalData = JadwalRes::collection(JadwalModel::with(['teacher_mapel.mapel', 'class.students' => function ($query) {
            $query->selectRaw('id_kelas,count(id) as total')->groupBy('id_kelas');
        }, 'class'])->where('hari',  Carbon::createFromFormat('m-d-Y', $date)->dayOfWeekIso + 1)->get());
        /**
         * Same with above
         */
        // dd($jadwalData)

        $data = array_values(array_filter(objectToArray($jadwalData)));

        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }

    public function getCountStudentAbsent(Request $request, $id_kelas, $id_schedule, $date)
    {
        $data = Siswa::with(['absent' => function ($query) use ($date, $id_schedule) {
            $query->whereDate('created_at', Carbon::createFromFormat('m-d-Y', $date))->where('id_jadwal', $id_schedule);
        }, 'absent.schedule',])->where('id_kelas', $id_kelas)->get();
        $data = array_values(array_filter(objectToArray($data)));

        return generateAPI(['data' => $data, 'custom_lenght' => count($data), 'message' => generateAPIMessage(['context' => 'absensi siswa', 'type' => 'read',])]);
    }
}
