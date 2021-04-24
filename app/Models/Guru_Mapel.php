<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru_Mapel extends Model
{
    protected $table = 'guru_mapel';
    protected $fillable = ['id_guru', 'id_mapel'];

    public function teacher()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
