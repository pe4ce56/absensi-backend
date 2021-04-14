<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['data_of', 'NIP', 'nama', 'jk', 'whatsapp', 'alamat', 'tanggal_lahir'];

    public function user()
    {
        return $this->belongsTo(User::class, 'data_of')->where('role', 'guru');
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'id_guru', 'id_mapel');
    }
}
