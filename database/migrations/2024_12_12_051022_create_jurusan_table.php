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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id');
            $table->string('nama_jurusan');
            $table->enum('status_aktif', ['aktif', 'tidak aktif'])->default('aktif');
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('jurusan');
    }
};
