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
        Schema::create('patner_kerja_sama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kerja_sama_id')->constrained('kerjasama')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('logo');
            $table->string('nama')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patner_kerja_sama');
    }
};
