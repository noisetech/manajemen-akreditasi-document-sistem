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
            $table->string('sumber_data')->nullable();
            $table->string('jenis')->nullable();
            $table->string('no_urutan')->nullable();
            $table->string('no_butir')->nullable();
            $table->integer('bobot')->nullable();
            $table->text('deskripsi')->nullable();
            $table->longText('penilaian')->nullable();
            $table->string('elemen_penilaian_lam')->nullable();
            $table->text('file_pendukung')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->enum('peninjauan_auditor', ['approve', 'reject'])->nullable();
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
