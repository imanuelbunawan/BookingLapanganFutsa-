<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('id_announcement');
            $table->unsignedBigInteger('id_user_admin')->nullable();
            $table->string('judul', 255);
            $table->text('isi_pengumuman');
            $table->timestamps();

            // Jika admin dihapus, pengumuman tetap tampil di user namun nama pembuat menjadi NULL
            $table->foreign('id_user_admin')->references('id_user')->on('users')
                  ->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};