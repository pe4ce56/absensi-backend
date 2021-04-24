<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['hari', 'waktu', 'id_kelas', 'id_guru_mapel'];

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function teacher_mapel()
    {
        return $this->belongsTo(Guru_Mapel::class, 'id_guru_mapel');
    }
}
