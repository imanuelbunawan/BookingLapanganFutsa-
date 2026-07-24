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
        Schema::table('lapangans', function (Blueprint $table) {
            // Menambahkan kolom gambar setelah kolom harga_per_jam
            $table->string('gambar')->nullable()->after('harga_per_jam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            // Menghapus kolom gambar jika di-rollback
            $table->dropColumn('gambar');
        });
    }
};