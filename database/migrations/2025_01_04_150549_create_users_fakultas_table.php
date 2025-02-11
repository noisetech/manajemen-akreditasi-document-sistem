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
        Schema::create('users_fakultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('fakultas_id');
            $table->string('create_by');
            $table->string('update_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('users_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('users_fakultas');
    }
};
