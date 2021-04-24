<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'siswa';
    protected $fillable = ['data_of', 'NISN', 'nama', 'jk', 'whatsapp', 'alamat', 'tanggal_lahir', 'foto_siswa', 'id_kelas'];

    public function user()
    {
        return $this->belongsTo(User::class, 'data_of');
    }

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
