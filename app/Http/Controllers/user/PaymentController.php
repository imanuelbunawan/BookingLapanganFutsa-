<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    // Menampilkan halaman upload pembayaran
    public function create($id_booking)
    {
        // Mengecek apakah booking dengan ID tersebut benar-benar ada
        $booking = Booking::findOrFail($id_booking);

        return view('user.payments.create', compact('id_booking', 'booking'));
    }

    // Memproses upload file dan menyimpan data
    public function store(Request $request, $id_booking)
    {
        // 1. Validasi input dan file (Maks 2048 KB / 2MB)
        $request->validate([
            'bank_asal' => 'required|string|max:50',
            'nama_rekening' => 'required|string|max:100',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Mengelola File Gambar
        $file = $request->file('bukti_transfer');
        // Membuat nama file yang unik berdasarkan waktu upload agar tidak ada nama yang bentrok
        $namaFile = time() . '_' . $file->getClientOriginalName();
        // Menyimpan file fisik ke folder 'storage/app/public/bukti_transfer'
        $path = $file->storeAs('bukti_transfer', $namaFile, 'public');

        // 3. Simpan atau Update data ke tabel payments (Mencegah Duplicate Entry)
        Payment::updateOrCreate(
            ['id_booking' => $id_booking], // Kondisi pencarian
            [
                'bukti_transfer' => $path,
                'bank_asal' => $request->bank_asal,
                'nama_rekening' => $request->nama_rekening,
                'status_pembayaran' => 'pending' // Menunggu dicek admin
            ]
        );

        // 4. Ubah status booking agar tombol bayar di dashboard user menghilang
        $booking = \App\Models\Booking::findOrFail($id_booking);
        $booking->update([
            'status_booking' => 'menunggu_konfirmasi'
        ]);

        // 5. Arahkan kembali ke dashboard dengan pesan sukses
        return redirect()->route('user.dashboard')
            ->with('success', 'Konfirmasi pembayaran berhasil dikirim. Silakan tunggu verifikasi dari Admin.');
    }
}
