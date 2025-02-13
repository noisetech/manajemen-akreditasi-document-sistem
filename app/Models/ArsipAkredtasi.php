<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArsipAkredtasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'arsip_akreditas';

    protected $fillable = [
        'fakultas_id',
        'sumber_data',
        'jenis',
        'no_urutan',
        'no_butir',
        'bobot',
        'deskripsi',
        'nilai',
        'penilaian',
        'elemen_penilaian_lam',
        'file_pendukung',
        'create_by',
        'update_by',
        'peninjauan_auditor'
    ];


    public function fakultas(){
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }
}
