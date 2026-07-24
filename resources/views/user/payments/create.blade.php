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
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg flex items-start">
                    <i class="fa-solid fa-building-columns text-2xl text-gray-400 mr-4 mt-1"></i>
                    <div>
                        <h5 class="font-bold text-gray-800">Transfer ke Rekening Berikut:</h5>
                        <p class="text-lg font-mono font-bold text-blue-600 mt-1">BCA - 1234 5678 90</p>
                        <p class="text-sm text-gray-500">a.n. GOR Sport Center (Immanuel Bunawan)</p>
                    </div>
                </div>

                <form action="{{ route('user.pembayaran.store', ['id_booking' => $booking->id_booking]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf

                    {{-- Bank Asal --}}
                    <div>
                        <label for="bank_asal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Bank Asal Anda
                        </label>

                        <input
                            type="text"
                            id="bank_asal"
                            name="bank_asal"
                            value="{{ old('bank_asal') }}"
                            placeholder="Contoh: BCA, Mandiri, BRI"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition">

                        @error('bank_asal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Rekening --}}
                    <div>
                        <label for="nama_rekening" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Pemilik Rekening
                        </label>

                        <input
                            type="text"
                            id="nama_rekening"
                            name="nama_rekening"
                            value="{{ old('nama_rekening') }}"
                            placeholder="Nama yang tertera di rekening Anda"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition">

                        @error('nama_rekening')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Bukti Transfer --}}
                    <div class="mb-4">
                        <label for="bukti_transfer" class="block text-gray-700 text-sm font-bold mb-2">Unggah Bukti Transfer (JPG/PNG)</label>

                        <input type="file"
                            id="bukti_transfer"
                            name="bukti_transfer"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            border border-gray-300 rounded-lg p-2 bg-gray-50"
                            accept="image/jpeg, image/png, image/jpg"
                            required>

                        <p class="text-xs text-gray-500 mt-1">Maksimal ukuran file 2MB.</p>
                    </div>

                    {{-- Tombol --}}
                    <div>
                        <button
                            type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-md transition">

                            <i class="fa-solid fa-paper-plane mr-2"></i>
                            Kirim Konfirmasi Pembayaran

                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection