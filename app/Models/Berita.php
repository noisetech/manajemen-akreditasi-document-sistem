<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'kategori_berita_id',
        'judul',
        'slug',
        'content',
        'tumbnail',
    ];

    public function kategori_berita(){
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id', 'id');
    }
}
