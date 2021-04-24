<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuruCollection extends JsonResource
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
            'data_of' => $this->data_of,
            'user' => $this->when($this->user, new UserCollection($this->user)),
            'NIP' => $this->NIP,
            'name' => $this->nama,
            'gender' => $this->jk == 'l' ? 'Male' : 'Female',
            'whatsapp' => $this->whatsapp,
            'address' => $this->alamat,
            'birth' => $this->tanggal_lahir,
            'mapels' => MapelCollection::collection($this->whenLoaded('mapels')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
