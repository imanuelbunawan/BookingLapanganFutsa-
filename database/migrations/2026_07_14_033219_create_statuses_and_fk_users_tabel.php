<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Buat tabel master status akun
        Schema::create('statuses', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('nama_status', 50)->unique();
        });

        // Hubungkan foreign key ke tabel users yang sudah ada
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_role')->references('id_role')->on('roles')
                  ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_status')->references('id_status')->on('statuses')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
            $table->dropForeign(['id_status']);
        });
        Schema::dropIfExists('statuses');
    }
};