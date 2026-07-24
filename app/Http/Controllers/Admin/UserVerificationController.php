<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserVerificationController extends Controller
{
    // Menampilkan daftar user yang masih pending
    public function index()
    {

        // Data 1: Hanya user yang statusnya masih PENDING (1)
        $pendingUsers = User::where('id_role', 2)
            ->where('id_status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Data 2: Semua user (Pending, Aktif, Ditolak)
        $allUsers = User::where('id_role', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim kedua data tersebut ke view menggunakan compact
        return view('admin.verifications.users', compact('pendingUsers', 'allUsers'));

        // // Ambil user yang role-nya penyewa (2) dan statusnya pending (1)
        // $users = User::where('id_role', 2)
        //     ->where('id_status', 1)
        //     ->orderBy('created_at', 'asc')
        //     ->get();

        // return view('admin.verifications.users', compact('users'));
    }

    // Memproses persetujuan atau penolakan
    public function update(Request $request, $id_user)
    {
        // Validasi input status dari tombol yang ditekan (hanya boleh angka 2 atau 3)
        $request->validate([
            'status' => 'required|in:2,3'
        ]);

        $user = User::findOrFail($id_user);
        $user->update([
            'id_status' => $request->status
        ]);

        $pesan = $request->status == 2 ? 'disetujui' : 'ditolak';

        return redirect()->route('admin.verifications.users.index')->with('success', "Akun penyewa bernama {$user->nama_lengkap} berhasil $pesan.");
    }
}
