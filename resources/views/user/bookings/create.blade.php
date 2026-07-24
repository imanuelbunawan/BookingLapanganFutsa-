@extends('layouts.app')

@section('title', 'Pembayaran Booking - GOR Sport Center')
@section('header_title', 'Upload Pembayaran')

@section('sidebar')
@include('layouts.sidebar_user')
@endsection

@section('content')
<div class="max-w-5xl mx-auto mt-4 grid grid-cols-1 md:grid-cols-3 gap-8">

    <div class="md:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100 bg-blue-50/50 flex items-center justify-between">
                <h4 class="font-bold text-blue-800"><i class="fa-solid fa-file-invoice-dollar mr-2"></i> Konfirmasi Pembayaran</h4>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">MENUNGGU PEMBAYARAN</span>
            </div>

            <div class="p-8">
                <form action="{{ route('user.booking.create') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Pilih Lapangan --}}
                    <div>
                        <label for="id_lapangan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih Lapangan
                        </label>

                        <select
                            id="id_lapangan"
                            name="id_lapangan"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none transition">

                            <option value="" disabled selected>
                                -- Silakan Pilih Lapangan --
                            </option>

                            @foreach($lapangans as $lap)
                            <option value="{{ $lap->id_lapangan }}"
                                {{ old('id_lapangan') == $lap->id_lapangan ? 'selected' : '' }}>

                                {{ $lap->nama_lapangan }}
                                ({{ $lap->jenis_lapangan }})
                                - Rp {{ number_format($lap->harga_per_jam,0,',','.') }}/Jam

                            </option>
                            @endforeach
                        </select>

                        @error('id_lapangan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Main --}}
                    <div>
                        <label for="tanggal_main" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Main
                        </label>

                        <input
                            type="date"
                            id="tanggal_main"
                            name="tanggal_main"
                            value="{{ old('tanggal_main') }}"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none transition">

                        @error('tanggal_main')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jam --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label for="jam_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jam Mulai
                            </label>

                            <input
                                type="time"
                                id="jam_mulai"
                                name="jam_mulai"
                                value="{{ old('jam_mulai') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none transition">

                            @error('jam_mulai')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jam_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jam Selesai
                            </label>

                            <input
                                type="time"
                                id="jam_selesai"
                                name="jam_selesai"
                                value="{{ old('jam_selesai') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none transition">

                            @error('jam_selesai')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">

                            <i class="fa-solid fa-arrow-right mr-2"></i>
                            Lanjutkan ke Pembayaran

                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection