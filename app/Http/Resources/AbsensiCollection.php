<?php

namespace App\Http\Resources;

use App\Models\Absensi;
use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;

use App\Models\Guru as GuruModel;
use App\Models\Jadwal;

class AbsensiCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $role = Auth::user()->role;
        if ($role === 'guru') {

            $guruId = GuruModel::where('data_of', Auth::user()->id)->first()->id;

            if ($this->schedule->teacher_mapel->teacher->id === $guruId) {
                return [
                    'student' => new SiswaCollection($this->whenLoaded('student')),
                    'schedule' => new JadwalCollection($this->whenLoaded('schedule')),
                    'time' => $this->waktu,
                    'location' => $this->lokasi,
                    'notes' => $this->keterangan,
                    'status' => $this->status
                ];
            }
        } else {
            return [
                'id' => $this->id,
                'day' => ucfirst($this->hari),
                'time' => $this->waktu,
                'teacher' => new GuruCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                    return $this->teacher_mapel->teacher;
                })),
                'mapel' => new MapelCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                    return $this->teacher_mapel->mapel;
                })),
                'absented' => $this->absent,
            ];
        }
    }
}
