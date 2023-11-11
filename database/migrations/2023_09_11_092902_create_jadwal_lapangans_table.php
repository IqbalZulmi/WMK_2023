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
        Schema::create('jadwal_lapangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lapangan');
            $table->foreign('id_lapangan')->references('id')->on('lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->bigInteger('harga');
            $table->enum('status',['sedang dipesan','tersedia','telah dipesan','tidak tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_lapangans');
    }
};
