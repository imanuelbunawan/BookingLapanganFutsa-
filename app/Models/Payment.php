<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'id_payment';
    public $timestamps = false; 

    protected $fillable = [
        'id_booking', 
        'bukti_transfer', 
        'bank_asal', 
        'nama_rekening', 
        'tanggal_bayar', 
        'status_pembayaran'
    ];

    // Relasi kembali ke Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }
}