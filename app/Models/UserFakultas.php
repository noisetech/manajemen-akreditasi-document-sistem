<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFakultas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_fakultas';

    protected $fillable = [
        'users_id',
        'fakultas_id',
        'create_by',
        'update_by'
    ];


    public function  user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function  fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }
}
