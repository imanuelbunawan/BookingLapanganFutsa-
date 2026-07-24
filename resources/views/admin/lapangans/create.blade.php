@extends('layouts.app')

@section('title', 'Tambah Lapangan - Admin')
@section('header_title', 'Tambah Lapangan Baru')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-4">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Data Lapangan Baru</h3>
            <p class="text-gray-500 text-sm mt-1">Lengkapi form di bawah ini untuk menambahkan lapangan baru.</p>
        </div>
        <a href="{{ route('admin.lapangan.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r text-sm">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lapangan</label>
                    <input type="text" name="nama_lapangan" value="{{ old('nama_lapangan') }}" placeholder="Contoh: Lapangan Utama A" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Lantai</label>
                        <div class="relative">
                            <select name="jenis_lapangan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-gray-50 text-gray-700" required>
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="Rumput Sintetis" {{ old('jenis_lapangan') == 'Rumput Sintetis' ? 'selected' : '' }}>Rumput Sintetis</option>
                                <option value="Lantai Vinyl" {{ old('jenis_lapangan') == 'Lantai Vinyl' ? 'selected' : '' }}>Lantai Vinyl</option>
                                <option value="Lantai Interlock" {{ old('jenis_lapangan') == 'Lantai Interlock' ? 'selected' : '' }}>Lantai Interlock</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" placeholder="Contoh: 150000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Foto Lapangan (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1.5 bg-gray-50">
                    <p class="text-xs text-gray-400 mt-2">Format: JPG, JPEG, PNG, WEBP. Maksimal ukuran berkas 2MB.</p>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-lg transition duration-200 shadow-md">
                        <i class="fa-solid fa-save mr-2"></i> Simpan Lapangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection