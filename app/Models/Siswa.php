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
    protected $fillable = ['NISN', 'password', 'jk', 'whatsapp', 'alamat', 'id_kelas'];
}
