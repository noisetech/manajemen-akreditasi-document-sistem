<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArsipAkreditasi extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'arsip_akreditas';

    protected $fillable = [
        'fakultas_id',
        'sumber_data',
        'jenis',
        'no_urutan',
        'bobot',
        'deskripsi',
        'nilai',
        'file_pendukung'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }
}
