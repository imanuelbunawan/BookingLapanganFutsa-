<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Membuat struktur dasar tabel Users (Tanpa FK dulu karena tabel Master belum ada)
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); 
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_hp', 15)->nullable();
            $table->unsignedBigInteger('id_role')->nullable();   // Dipersiapkan untuk FK nanti
            $table->unsignedBigInteger('id_status')->nullable(); // Dipersiapkan untuk FK nanti
            $table->rememberToken();
            $table->timestamps(); // Menyediakan created_at dan updated_at secara otomatis
        });

        // 2. Tabel Bawaan Laravel untuk Token Reset Password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabel Bawaan Laravel untuk Session (Disinkronkan dengan id_user)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};