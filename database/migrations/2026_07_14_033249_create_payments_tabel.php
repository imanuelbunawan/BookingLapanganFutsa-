<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');
            $table->unsignedBigInteger('id_booking')->unique(); // Unique untuk relasi 1 to 1
            $table->string('bukti_transfer', 255);
            $table->string('bank_asal', 50)->nullable();
            $table->string('nama_rekening', 100)->nullable();
            $table->timestamp('tanggal_bayar')->useCurrent();
            $table->enum('status_pembayaran', ['pending', 'diterima', 'ditolak'])->default('pending');

            // Jika data booking dihapus, data info pembayaran otomatis ikut terhapus (CASCADE)
            $table->foreign('id_booking')->references('id_booking')->on('bookings')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};