<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;

use App\Models\Guru as GuruModel;

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
        $guruId = GuruModel::where('data_of', Auth::user()->id)->first()->id;

        if($this->schedule->teacher_mapel->teacher->id === $guruId){
            return [
                'student' => new SiswaCollection($this->whenLoaded('student')),
                'schedule' => new JadwalCollection($this->whenLoaded('schedule')),
                'time' => $this->waktu,
                'location' => $this->lokasi,
                'notes' => $this->keterangan,
                'status' => $this->status
            ];
        }
    }
}
