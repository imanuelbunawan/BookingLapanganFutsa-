<?php

namespace App\Http\Controllers;


abstract class Controller
{
    public function dashboard()
    {
        $orderAktif = Booking::with('lapangan')
            ->where('id_user', auth()->user()->id_user)
            ->whereIn('status_booking', ['pending', 'disetujui'])
            ->latest()
            ->get();

        return view('user.dashboard', compact('orderAktif'));
    }
}
