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
            'NIP' => $this->NIP,
            'name' => $this->nama,
            'sex' => $this->jk == 'l' ? 'Male' : 'Female',
            'whatsapp' => $this->whatsapp,
            'address' => $this->alamat,
            'birth' => $this->tanggal_lahir,
        ];
    }
}
