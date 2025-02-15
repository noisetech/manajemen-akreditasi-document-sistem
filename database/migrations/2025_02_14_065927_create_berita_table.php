<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id');
            $table->string('slug')->unique();
            $table->string('judul');
            $table->longText('content');
            $table->text('tumbnail')->nullable();
            $table->string('penulis');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kategori_berita_id')->references('id')
                ->on('kategori_berita')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
