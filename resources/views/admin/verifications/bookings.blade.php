@extends('layouts.app')

@section('title', 'Verifikasi Booking - Admin')
@section('header_title', 'Verifikasi Pembayaran')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-800">Daftar Pemesanan Lapangan</h3>
    <p class="text-gray-500 text-sm mt-1">Cek bukti transfer dan atur status pemesanan.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="p-4 font-semibold">Penyewa</th>
                    <th class="p-4 font-semibold">Jadwal Main</th>
                    <th class="p-4 font-semibold">Lapangan</th>
                    <th class="p-4 font-semibold text-center">Bukti Bayar</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">

                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4">
                        <div class="font-bold text-gray-900">{{ $booking->nama_lengkap }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $booking->total_harga }}</div>
                    </td>
                    <td class="p-4">
                        <div class="font-medium">{{ $booking->tanggal_main }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai}}</div>
                    </td>
                    <td class="p-4 font-bold text-blue-600">{{ $booking->lapangan->nama_lapangan }}</td>
                    <td class="p-4 text-center">
                        @if($booking->bukti_transfer)
                        <a href="{{ asset('storage/' . $booking->bukti_transfer) }}"
                            target="_blank"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg hover:bg-blue-100 transition-colors">

                            <i class="fa-solid fa-eye mr-1"></i>
                            Lihat Bukti
                        </a>
                        @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200">
                            <i class="fa-solid fa-image mr-1"></i>
                            Belum Upload
                        </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <!-- Asumsi variabel status Anda bernama $order->status_booking, silakan sesuaikan jika namanya berbeda -->
                        @if($booking->status_booking == 'disetujui')
                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                            TERVERIFIKASI
                        </span>
                        @elseif($booking->status_booking == 'ditolak')
                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">
                            DITOLAK
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex items-center text-xs font-bold rounded-full bg-amber-100 text-amber-700 border border-amber-200">
                            CEK TRANSFER
                        </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        @if($booking->status_booking == 'pending' || $booking->status_booking == 'menunggu_konfirmasi')

                        <div class="flex justify-center gap-2">

                            <form action="{{ route('admin.verifications.bookings.update', $booking->id_booking) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="disetujui">

                                <button
                                    type="submit"
                                    onclick="return confirm('Setujui booking ini?')"
                                    class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                    <i class="fa-solid fa-check"></i>
                                </button>

                            </form>

                            <form action="{{ route('admin.verifications.bookings.update', $booking->id_booking) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="ditolak">

                                <button
                                    type="submit"
                                    onclick="return confirm('Tolak booking ini?')"
                                    class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                            </form>

                        </div>

                        @else

                        <span class="text-gray-500 text-sm font-semibold">
                            -
                        </span>

                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection