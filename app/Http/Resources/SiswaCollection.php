<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaCollection extends JsonResource
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
            'nisn' => $this->NISN,
            'name' => $this->nama,
            'gender' => $this->jk == 'l' ? 'Male' : 'Female',
            'whatsapp' => $this->whatsapp,
            'address' => $this->alamat,
            'birth_date' => $this->tanggal_lahir,
            'student_pict' => $this->foto_siswa,
            'class' => new KelasCollection($this->whenLoaded('class')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'total' => $this->total ? $this->total : null
        ];
    }
}
