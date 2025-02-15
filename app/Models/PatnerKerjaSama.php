<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatnerKerjaSama extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patner_kerja_sama';

    protected $fillable = [
        'nama',
        'logo',
        'kerja_sama_id'
    ];

    public function kerja_sama(){
        return $this->belongsTo(KerjaSama::class, 'kerja_sama_id', 'id');
    }
}
