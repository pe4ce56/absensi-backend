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
            'user' => new UserCollection($this->whenLoaded('user')),
            'NIP' => $this->NIP,
            'name' => $this->nama,
            'sex' => $this->jk == 'l' ? 'Male' : 'Female',
            'whatsapp' => $this->whatsapp,
            'address' => $this->alamat,
            'birth' => $this->tanggal_lahir,
            'mapels' => MapelCollection::collection($this->whenLoaded('mapels'))
        ];
    }
}
