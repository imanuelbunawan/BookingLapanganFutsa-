<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lapangan';

    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'harga_per_jam',
        'gambar'
    ];

    // Relasi: Satu lapangan bisa dibooking berkali-kali
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_lapangan');
    }
}
