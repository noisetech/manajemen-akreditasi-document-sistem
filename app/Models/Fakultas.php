<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fakultas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fakultas';

    protected $fillable = [
        'nama',
        'status_aktif',
        'create_by',
        'upadate_by',
        'slug'
    ];


    public function user_fakultas()
    {
        return $this->hasMany(UserFakultas::class, 'fakultass_id', 'id');
    }


    public function arsip_akreditasi()
    {
        return $this->hasMany(ArsipAkredtasi::class, 'fakultas', 'id');
    }
}
