<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // Memproses data Register
    public function registerPost(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'nullable|string|max:15', // Tambahkan validasi no_hp
        ]);

        \App\Models\User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'name'         => $request->nama_lengkap, // Atau sesuaikan dengan username
            'email'        => $request->email,
            'password'     => \Illuminate\Support\Facades\Hash::make($request->password),
            'no_hp'        => $request->no_hp,
            'role'         => 'user',
            'id_role'      => 2, // Asumsi: 2 adalah ID untuk role user biasa
            'id_status'    => 1, // Asumsi: 1 adalah ID untuk status 'aktif' atau 'pending'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Menampilkan halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // Memproses pengecekan Login
    public function loginPost(Request $request)
    {
        // Validasi input form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba melakukan login
        if (Auth::attempt($credentials)) {
            // Ambil data user yang baru saja mencoba login
            $user = Auth::user();

            // CEK STATUS AKUN USER
            if ($user->id_status == 1) {
                Auth::logout(); // Keluarkan paksa
                return back()->withErrors([
                    'email' => 'Akun Anda masih dalam tahap verifikasi oleh Admin. Harap bersabar.',
                ])->withInput();
            } elseif ($user->id_status == 3) {
                Auth::logout(); // Keluarkan paksa
                return back()->withErrors([
                    'email' => 'Maaf, pendaftaran akun Anda ditolak atau telah diblokir oleh Admin.',
                ])->withInput();
            }

            // JIKA STATUS == 2 (Aktif), izinkan masuk
            $request->session()->regenerate();

            // Arahkan ke dashboard sesuai id_role
            if ($user->id_role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika email/password salah atau tidak ditemukan
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
