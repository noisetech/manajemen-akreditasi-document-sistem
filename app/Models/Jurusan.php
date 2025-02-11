<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jurusan';

    protected $fillable = [
        'fakultas_id',
        'nama_jurusan',
        'status_aktif',
        'create_by',
        'update_by',
        'slug',
    ];


    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }

    public function userAkademiks()
    {
        return $this->hasMany(UserAkademik::class, 'jurusan_id', 'id');
    }
}
