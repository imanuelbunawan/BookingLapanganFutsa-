<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Lapangan;

class BookingController extends Controller
{
    /**
     * Form Booking
     */
    public function create()
    {
        $lapangans = Lapangan::all();

        return view('user.bookings.create', compact('lapangans'));
    }

    /**
     * Simpan Booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_lapangan'  => 'required|exists:lapangans,id_lapangan',
            'tanggal_main' => 'required|date|after_or_equal:today',
            'jam_mulai'    => 'required|date_format:H:i',
            'jam_selesai'  => 'required|date_format:H:i|after:jam_mulai',
        ]);

        return DB::transaction(function () use ($request) {

            /*
        ==============================
        LOCK
        ==============================
        */

            Booking::where('id_lapangan', $request->id_lapangan)
                ->whereDate('tanggal_main', $request->tanggal_main)
                ->lockForUpdate()
                ->get();

            /*
        ==============================
        CEK BENTROK
        ==============================
        */

            $bentrok = Booking::where('id_lapangan', $request->id_lapangan)
                ->whereDate('tanggal_main', $request->tanggal_main)
                ->whereIn('status_booking', [
                    'pending',
                    'disetujui'
                ])
                ->where(function ($q) use ($request) {

                    $q->where('jam_mulai', '<', $request->jam_selesai)
                        ->where('jam_selesai', '>', $request->jam_mulai);
                })
                ->exists();

            if ($bentrok) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'jam_mulai' => 'Lapangan sudah dibooking pada jam tersebut.'
                    ]);
            }

            /*
        ==============================
        HITUNG HARGA
        ==============================
        */

            $lapangan = Lapangan::findOrFail($request->id_lapangan);

            $durasi =
                (
                    strtotime($request->jam_selesai)
                    -
                    strtotime($request->jam_mulai)
                ) / 3600;

            $totalHarga = $durasi * $lapangan->harga_per_jam;

            /*
        ==============================
        SIMPAN
        ==============================
        */

            $booking = Booking::create([

                'id_user' => Auth::user()->id_user,

                'id_lapangan' => $request->id_lapangan,

                'tanggal_main' => $request->tanggal_main,

                'jam_mulai' => $request->jam_mulai,

                'jam_selesai' => $request->jam_selesai,

                'total_harga' => $totalHarga,

                'status_booking' => 'pending',

            ]);

            return redirect()
                ->route('user.pembayaran.create', [
                    'id_booking' => $booking->id_booking
                ])
                ->with(
                    'success',
                    'Booking berhasil dibuat.'
                );
        });
    }

    /**
     * Hapus Booking
     */
    public function destroy($id)
    {
        $booking = Booking::where('id_booking', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        /*
        Hanya boleh menghapus booking pending
        */

        if ($booking->status_booking != 'pending') {
            return back()->with(
                'error',
                'Booking tidak dapat dihapus.'
            );
        }

        $booking->delete();

        return back()->with(
            'success',
            'Booking berhasil dihapus.'
        );
    }

    /**
     * Riwayat Booking
     */
    public function history()
    {
        $riwayat = Booking::with([
            'lapangan',
            'payment'
        ])
            ->where('id_user', Auth::user()->id_user)
            ->whereIn('status_booking', [
                'disetujui',
                'ditolak'
            ])
            ->latest()
            ->get();

        return view(
            'user.bookings.history',
            compact('riwayat')
        );
    }
}
