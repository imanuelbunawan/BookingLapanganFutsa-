<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk deteksi user login

class AnnouncementController extends Controller
{
    public function index()
    {
        $pengumuman = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcements.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
        ]);

        Announcement::create([
            // Mengambil ID Admin yang sedang login secara otomatis
            'id_user_admin' => Auth::user()->id_user,
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
            'is_active'      => $request->has('is_active') ? 1 : 0,
        ]);

        // Ubah redirect ke announcements
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengumuman = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
        ]);

        $pengumuman = Announcement::findOrFail($id);
        $pengumuman->update([
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
            'is_active'        => $request->has('is_active') ? 1 : 0,
        ]);

        // Ubah redirect ke announcements
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    // Menambah fungsi untuk Show/Hide pengumuman
    public function toggleStatus($id)
    {
        $pengumuman = Announcement::findOrFail($id);

        // Membalikkan status (Jika true jadi false, jika false jadi true)
        $pengumuman->is_active = !$pengumuman->is_active;
        $pengumuman->save();

        $statusText = $pengumuman->is_active ? 'ditampilkan' : 'disembunyikan';

        return redirect()->back()->with('success', 'Pengumuman berhasil ' . $statusText . '!');
    }

    public function destroy($id)
    {
        $pengumuman = Announcement::findOrFail($id);
        $pengumuman->delete();

        // Ubah redirect ke announcements
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}
