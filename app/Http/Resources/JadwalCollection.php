<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use \Auth;

use App\Models\Guru as GuruModel;

class JadwalCollection extends JsonResource
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
            if ($this->teacher_mapel->teacher->id === $guruId) {
                return [
                    'id' => $this->id,
                    'day' => ucfirst($this->hari),
                    'time' => $this->waktu,
                    'class' => new KelasCollection($this->whenLoaded('class')),
                    $this->mergeWhen($role === 'admin', [
                        'teacher' => new GuruCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                            return $this->teacher_mapel->teacher;
                        })),
                    ]),
                    'mapel' => new MapelCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                        return $this->teacher_mapel->mapel;
                    })),
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ];
            }
        } else {
            return [
                'id' => $this->id,
                'day' => ucfirst($this->hari),
                'time' => $this->waktu,
                'class' => new KelasCollection($this->whenLoaded('class')),
                'teacher' => new GuruCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                    return $this->teacher_mapel->teacher;
                })),
                'mapel' => new MapelCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function () {
                    return $this->teacher_mapel->mapel;
                })),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        }
    }
}
