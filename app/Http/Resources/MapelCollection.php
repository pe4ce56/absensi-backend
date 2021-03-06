<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Guru_Mapel as GuruMapelModel;

class MapelCollection extends JsonResource
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
            'name' => $this->nama,
            'teachers' => GuruCollection::collection($this->whenLoaded('teachers')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
