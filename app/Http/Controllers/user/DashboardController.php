<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now()->format('Y-m-d H:i:s');

        // Pada fungsi yang menampilkan halaman dashboard user
        $orderAktif = Booking::where('id_user', Auth::user()->id_user)
            ->whereIn('status_booking', ['pending', 'menunggu_konfirmasi', 'disetujui'])
            ->get();

        $pengumuman = Announcement::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'orderAktif',
            'pengumuman'
        ));
    }
}
