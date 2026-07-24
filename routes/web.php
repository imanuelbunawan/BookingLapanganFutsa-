<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\{BookingController, PaymentController, DashboardController};
use App\Http\Controllers\Admin\{AnnouncementController, UserVerificationController, BookingVerificationController, LapanganController};
use App\Models\{Lapangan, User, Booking, Announcement};


// 1. Landing Page (Public)
Route::get('/', function () {
    $lapangan = \App\Models\Lapangan::all();
    return view('welcome', compact('lapangan'));
});

// 2. Rute Autentikasi (Hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

// 3. Rute yang Memerlukan Login
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // A. RUTE ADMIN (Dengan proteksi role:admin)
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'totalUser' => User::count(),
                'totalBooking' => Booking::count(),
                'bookingPending' => Booking::where('status_booking', 'pending')->count(),
                'bookingSelesai' => Booking::whereIn('status_booking', ['disetujui', 'selesai'])->count(),
                'lapanganAktif' => Lapangan::count(),
                'pengumumanAktif' => Announcement::where('is_active', true)->count(),
                'pengumumanHidden' => Announcement::where('is_active', false)->count(),
            ]);
        })->name('dashboard');

        // Rute untuk menampilkan halaman daftar user pending
        Route::get('/verifikasi-user', [App\Http\Controllers\Admin\UserVerificationController::class, 'index'])
            ->name('verifications.users.index'); // <-- Pastikan namanya ini

        // Rute untuk memproses tombol Setuju / Tolak
        Route::put('/verifikasi-user/{id_user}', [App\Http\Controllers\Admin\UserVerificationController::class, 'update'])->name('verifications.users.update');

        Route::get('/verifications/bookings', [App\Http\Controllers\Admin\BookingVerificationController::class, 'index'])
            ->name('verifications.bookings.index');

        // Rute untuk update status booking
        Route::put('/verifications/bookings/{id_booking}', [App\Http\Controllers\Admin\BookingVerificationController::class, 'update'])
            ->name('verifications.bookings.update');


        Route::patch('/announcements/{id}/toggle', [App\Http\Controllers\Admin\AnnouncementController::class, 'toggleStatus'])->name('announcements.toggle');
        // Route::resource('/pengumuman', AnnouncementController::class);
        Route::resource('announcements', AnnouncementController::class)->names('announcements');

        Route::resource('lapangan', LapanganController::class);
    });

    // B. RUTE USER (Dengan proteksi role:user)
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

        Route::get('/pembayaran/{id_booking}', [PaymentController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran/{id_booking}', [PaymentController::class, 'store'])->name('pembayaran.store');

        Route::get('/riwayat', [BookingController::class, 'history'])->name('bookings.history');

        Route::get('/pengumuman', [App\Http\Controllers\User\AnnouncementController::class, 'index'])->name('announcements.index');
    });
});
