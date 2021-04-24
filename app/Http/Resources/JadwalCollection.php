<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'day' => ucfirst($this->hari),
            'time' => $this->waktu,
            'class' => new KelasCollection($this->whenLoaded('class')),
            'teacher' => new GuruCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function(){
                return $this->teacher_mapel->teacher;
            })),
            'mapel' => new MapelCollection($this->whenPivotLoadedAs('teacher_mapel', 'guru_mapel', function(){
                return $this->teacher_mapel->mapel;
            })),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
 