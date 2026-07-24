@extends('layouts.app')

@section('title', 'Buat Pengumuman - Admin')
@section('header_title', 'Buat Pengumuman Baru')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-4">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Tulis Informasi Baru</h3>
            <p class="text-gray-500 text-sm mt-1">Pengumuman ini akan langsung terlihat oleh semua penyewa.</p>
        </div>
        <a href="{{ route('admin.announcements.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Pengumuman</label>
                    <input type="text" name="judul" placeholder="Contoh: Diskon Kemerdekaan!" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Isi Pesan</label>
                    <textarea name="isi_pengumuman" rows="5" placeholder="Tuliskan detail pengumuman di sini..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 resize-none" required></textarea>
                </div>

                <div>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                        <span class="text-gray-700 font-medium">Tampilkan langsung ke publik</span>
                    </label>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-lg transition duration-200 shadow-md">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Terbitkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection