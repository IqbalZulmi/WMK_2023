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
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penyedia_lapangan');
            $table->foreign('id_penyedia_lapangan')->references('id')->on('penyedia_lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_jenis_lapangan');
            $table->foreign('id_jenis_lapangan')->references('id')->on('jenis_lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_lapangan');
            $table->string('foto_lapangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
