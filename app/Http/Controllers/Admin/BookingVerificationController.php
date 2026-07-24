<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Payment;

class BookingVerificationController extends Controller
{
    // Menampilkan daftar booking dan pembayaran
    public function index()
    {
        // Menggabungkan tabel bookings, payments, dan users
        $bookings = Booking::leftJoin('payments', 'bookings.id_booking', '=', 'payments.id_booking')
            ->join('users', 'bookings.id_user', '=', 'users.id_user')
            ->select(
                'bookings.*',
                'users.nama_lengkap',
                'payments.bukti_transfer',
                'payments.bank_asal',
                'payments.nama_rekening',
                'payments.status_pembayaran'
            )
            ->orderBy('bookings.created_at', 'desc')
            ->latest()
            ->get();

        return view('admin.verifications.bookings', compact('bookings'));
    }

    // Memproses persetujuan atau penolakan
    public function update(Request $request, $id_booking)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        // 1. Update status di tabel bookings
        $booking = Booking::findOrFail($id_booking);
        $booking->update([
            'status_booking' => $request->status
        ]);

        // 2. Update status di tabel payments (jika penyewa sudah upload bukti)
        $payment = Payment::where('id_booking', $id_booking)->first();
        if ($payment) {
            $payment->update([
                'status_pembayaran' => $request->status == 'disetujui'
                    ? 'diterima'
                    : 'ditolak'
            ]);
        }

        $pesan = $request->status == 'disetujui' ? 'disetujui' : 'ditolak';

        return redirect()->route('admin.verifications.bookings.index')->with('success', "Booking lapangan berhasil $pesan.");
    }
}
