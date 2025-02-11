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
        Schema::create('arsip_akreditas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id');
            $table->string('sumber_data');
            $table->string('jenis');
            $table->string('no_urutan');
            $table->integer('bobot');
            $table->text('deskripsi');
            $table->integer('nilai')->nullable();
            $table->text('file_pendukung')->nullable();
            $table->string('create_by');
            $table->string('update_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fakultas_id')->references('id')
                ->on('fakultas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_akreditas');
    }
};
