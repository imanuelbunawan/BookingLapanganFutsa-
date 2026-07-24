@extends('layouts.app')

@section('title', 'Riwayat Booking - GOR Sport Center')
@section('header_title', 'Riwayat Booking')

@section('sidebar')
@include('layouts.sidebar_user')
@endsection

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-800">Riwayat Pesanan Anda</h3>
    <p class="text-gray-500 text-sm mt-1">Pantau status verifikasi dan jadwal main Anda di sini.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="p-4 font-semibold">Tgl Main</th>
                    <th class="p-4 font-semibold">Lapangan</th>
                    <th class="p-4 font-semibold">Waktu</th>
                    <th class="p-4 font-semibold">Total Harga</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">

                @forelse($riwayat as $booking)

                <tr class="hover:bg-gray-50 transition-colors">

                    <td class="p-4 font-medium">
                        {{ \Carbon\Carbon::parse($booking->tanggal_main)->format('d M Y') }}
                    </td>

                    <td class="p-4 font-bold text-gray-900">
                        {{ $booking->lapangan->nama_lapangan }}
                    </td>

                    <td class="p-4">
                        {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                    </td>

                    <td class="p-4 font-medium text-green-600">
                        Rp {{ number_format($booking->total_harga,0,',','.') }}
                    </td>

                    <td class="p-4 text-center">

                        @if($booking->status_booking == 'pending')

                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                            <i class="fa-solid fa-clock mr-1"></i>
                            MENUNGGU VERIFIKASI
                        </span>

                        @elseif($booking->status_booking == 'disetujui')

                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                            <i class="fa-solid fa-check mr-1"></i>
                            DISETUJUI
                        </span>

                        @elseif($booking->status_booking == 'ditolak')

                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">
                            <i class="fa-solid fa-xmark mr-1"></i>
                            DITOLAK
                        </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-500">

                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-gray-300"></i>

                        <p class="font-semibold">
                            Belum ada riwayat booking.
                        </p>

                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection