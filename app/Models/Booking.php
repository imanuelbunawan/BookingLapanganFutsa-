<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_booking';
    
    // Tambahkan id_lapangan ke sini
    protected $fillable = [
        'id_user', 
        'id_lapangan', 
        'tanggal_main', 
        'jam_mulai', 
        'jam_selesai', 
        'total_harga', 
        'status_booking'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi BARU: Menarik data lapangan
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_booking');
    }
}