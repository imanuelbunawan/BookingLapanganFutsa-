<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Hanya mengambil pengumuman yang diatur "Aktif" (is_active = 1) oleh Admin
        $pengumuman = Announcement::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.announcements.index', compact('pengumuman'));
    }
}
