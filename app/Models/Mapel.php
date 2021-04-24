<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Guru_Mapel as GuruMapelModel;
use App\Models\Guru as GuruModel;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama'];

    public function teachers()
    {
        return $this->belongsToMany(GuruModel::class, 'guru_mapel', 'id_mapel', 'id_guru');
    }
}
