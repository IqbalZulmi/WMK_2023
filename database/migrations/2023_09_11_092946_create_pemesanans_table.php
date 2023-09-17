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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_lapangan');
            $table->foreign('id_lapangan')->references('id')->on('lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_jadwal_lapangan');
            $table->foreign('id_jadwal_lapangan')->references('id')->on('jadwal_lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pemesanan');
            $table->bigInteger('total_harga');
            $table->text('komentar')->nullable();
            $table->enum('status',['pending','berhasil','gagal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
