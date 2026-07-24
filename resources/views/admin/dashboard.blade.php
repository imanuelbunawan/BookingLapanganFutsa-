@extends('layouts.app')

@section('title', 'Dashboard Admin - GOR Sport Center')
@section('header_title', 'Dashboard Admin')

@section('sidebar')
    @include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-800">Ringkasan Sistem</h3>
    <p class="text-gray-500 text-sm mt-1">Pantau aktivitas penyewaan lapangan dan pengguna hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 rounded-full bg-blue-50 text-blue-600 mr-4">
            <i class="fa-solid fa-users text-2xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalUser }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 rounded-full bg-indigo-50 text-indigo-600 mr-4">
            <i class="fa-solid fa-calendar-check text-2xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Booking</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalBooking }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 rounded-full bg-amber-50 text-amber-600 mr-4">
            <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold text-gray-800">{{ $bookingPending }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 rounded-full bg-green-50 text-green-600 mr-4">
            <i class="fa-solid fa-circle-check text-2xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Booking Selesai</p>
            <p class="text-2xl font-bold text-gray-800">{{ $bookingSelesai }}</p>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Lapangan</h4>
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <i class="fa-solid fa-futbol text-green-500 text-xl mr-3"></i>
                <span class="font-medium text-gray-700">Lapangan Aktif</span>
            </div>
            <span class="text-xl font-bold text-gray-900">{{ $lapanganAktif }}</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Info Pengumuman</h4>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-blue-50 text-blue-800 rounded-lg">
                <span class="font-medium"><i class="fa-solid fa-bullhorn mr-2"></i> Pengumuman Aktif</span>
                <span class="font-bold">{{ $pengumumanAktif }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-100 text-gray-600 rounded-lg">
                <span class="font-medium"><i class="fa-solid fa-eye-slash mr-2"></i> Disembunyikan</span>
                <span class="font-bold">{{ $pengumumanHidden }}</span>
            </div>
        </div>
    </div>
</div>
@endsection