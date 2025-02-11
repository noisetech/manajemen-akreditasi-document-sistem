<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisiMisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visi_misi';

    protected $fillable = [
        'visi', 'misi'
    ];

}
