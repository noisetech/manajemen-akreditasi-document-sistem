<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KerjaSama extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kerjasama';

    protected $fillable = [
        'keterangan',
        'thumbnail',
        'tanggal_post',
        'create_by',
        'update_by'
    ];

    public function patner_kerja_sama()
    {
        return $this->hasMany(PatnerKerjaSama::class, 'kerjasama_id', 'id');
    }
}
