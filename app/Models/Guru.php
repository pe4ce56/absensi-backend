<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['data_of', 'NIP', 'nama', 'jk', 'whatsapp', 'alamat', 'tanggal_lahir'];
}
