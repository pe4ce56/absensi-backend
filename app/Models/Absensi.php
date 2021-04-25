<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = ['id_siswa', 'id_jadwal', 'waktu', 'lokasi', 'keterangan', 'status'];

    public function schedule()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    public function student()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
