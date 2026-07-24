<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    // Menyesuaikan nama Primary Key
    protected $primaryKey = 'id_user';

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
        'no_hp',
        'id_role',
        'id_status',
    ];

    // Kolom yang disembunyikan saat data diubah ke array/JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke tabel Roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // Relasi ke tabel Statuses
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
    }

    // Relasi ke tabel Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_user', 'id_user');
    }
}