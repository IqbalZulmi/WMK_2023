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
        Schema::create('rekenings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bank');
            $table->foreign('kode_bank')->references('kode_bank')->on('daftar_banks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedbigInteger('id_penyedia_lapangan');
            $table->foreign('id_penyedia_lapangan')->references('id')->on('penyedia_lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('no_rekening');
            $table->string('nama_rekening');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekenings');
    }
};
