<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penelitian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penelitian';

    protected $fillable = [
        'judul',
        'tanggal_penelitian',
        'autor',
        'keterangan'
    ];
}
