<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user');

            // KOLOM BARU: Menyimpan ID Lapangan yang dipilih
            $table->unsignedBigInteger('id_lapangan');

            $table->date('tanggal_main');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('total_harga');
            $table->enum('status_booking', ['pending', 'menunggu_konfirmasi', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_lapangan')->references('id_lapangan')->on('lapangans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
