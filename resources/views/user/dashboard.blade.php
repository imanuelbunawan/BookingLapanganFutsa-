@extends('layouts.app')

@section('title', 'Dashboard User - GOR Sport Center')
@section('header_title', 'Dashboard Penyewa')

@section('sidebar')
@include('layouts.sidebar_user')
@endsection

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 mb-8 text-white shadow-lg flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->nama_lengkap }}! ⚽</h2>
        <p class="text-blue-100">Siap untuk pertandingan hari ini? Booking lapangan dengan mudah dan cepat.</p>
    </div>
    <div class="hidden md:block text-5xl opacity-80">
        <i class="fa-solid fa-stopwatch"></i>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h4 class="font-bold text-gray-800">
                    <i class="fa-solid fa-ticket text-blue-500 mr-2"></i>
                    Booking Aktif Anda
                </h4>

                <a href="{{ route('user.booking.create') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1 rounded-full transition-colors">
                    + Booking Baru
                </a>
            </div>

            <div class="p-6">
                <!-- AWAL PERULANGAN FORELSE -->
                @forelse($orderAktif as $order)

                <div class="border border-gray-200 rounded-lg p-4 flex flex-col md:flex-row md:items-center justify-between hover:border-blue-300 transition mb-4">

                    <!-- Info Lapangan -->
                    <div>
                        <h5 class="font-bold text-gray-800">
                            {{ $order->lapangan->nama_lapangan }}
                        </h5>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            {{ \Carbon\Carbon::parse($order->tanggal_main)->format('d M Y') }}
                            <span class="mx-2">|</span>
                            <i class="fa-regular fa-clock mr-1"></i>
                            {{ $order->jam_mulai }} - {{ $order->jam_selesai }}
                        </p>
                    </div>

                    <!-- Status dan Tombol Aksi -->
                    <div class="mt-4 md:mt-0 flex items-center gap-3">
                        @switch($order->status_booking)

                        @case('pending')
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">
                            MENUNGGU PEMBAYARAN
                        </span>
                        <a href="{{ route('user.pembayaran.create', ['id_booking' => $order->id_booking]) }}"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold transition">
                            Bayar
                        </a>
                        @break

                        @case('menunggu_konfirmasi')
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                            MENUNGGU KONFIRMASI
                        </span>
                        @break

                        @case('disetujui')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            DISETUJUI
                        </span>
                        @break

                        @case('ditolak')
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                            DITOLAK
                        </span>
                        @break

                        @default
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-bold">
                            {{ strtoupper($order->status_booking) }}
                        </span>
                        @endswitch
                    </div>

                </div>

                @empty
                <!-- JIKA TIDAK ADA BOOKING AKTIF -->
                <div class="text-center py-8">
                    <div class="inline-block p-4 rounded-full bg-gray-100 text-gray-400 mb-3">
                        <i class="fa-solid fa-folder-open text-3xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium">
                        Belum ada booking yang sedang aktif.
                    </p>
                </div>
                @endforelse
                <!-- AKHIR PERULANGAN FORELSE -->

            </div>
        </div>
    </div>


    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h4 class="font-bold text-gray-800"><i class="fa-solid fa-bell text-amber-500 mr-2"></i> Info Terbaru</h4>
            </div>
            <div class="p-0">
                @if($pengumuman->isEmpty())
                <p class="p-6 text-sm text-gray-500 text-center">Tidak ada pengumuman saat ini.</p>
                @else
                <div class="divide-y divide-gray-100">
                    @foreach($pengumuman as $info)
                    <div class="p-5 hover:bg-gray-50 transition-colors">
                        <h5 class="text-sm font-bold text-gray-800 mb-1">{{ $info->judul }}</h5>
                        <p class="text-xs text-gray-500 line-clamp-2">{{ $info->konten }}</p>
                        <span class="text-[10px] text-gray-400 mt-2 block">{{ $info->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection