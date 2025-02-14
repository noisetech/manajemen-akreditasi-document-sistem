<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBerita extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_berita';

    protected $fillable = [
        'kategori', 'slug'
    ];

    public function berita(){
        return $this->hasMany(Berita::class, 'kategori_berita_id', 'id');
    }
}
