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
        Schema::create('penarikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penyedia_lapangan');
            $table->foreign('id_penyedia_lapangan')->references('id')->on('penyedia_lapangans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('jumlah_penarikan');
            $table->string('bukti_pembayaran')->nullable();
            $table->text('komentar')->nullable();
            $table->enum('status',['sedang diproses','selesai','ditolak'])->default('sedang diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikans');
    }
};
