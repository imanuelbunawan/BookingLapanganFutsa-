@extends('layouts.app')

@section('title', 'Pengumuman - User')
@section('header_title', 'Pusat Informasi')

@section('sidebar')
@include('layouts.sidebar_user')
@endsection

@section('content')
<div class="mb-6">
    <h3 class="text-2xl font-bold text-gray-800">Pengumuman & Promo</h3>
    <p class="text-gray-500 text-sm mt-1">Informasi terbaru seputar jadwal, aturan, dan promo lapangan.</p>
</div>

<div class="space-y-6">
    @forelse($pengumuman as $info)
    <div class="bg-white rounded-xl shadow-sm border border-l-4 border-l-blue-500 border-gray-100 p-6 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-2">
            <h4 class="font-bold text-gray-900 text-lg">{{ $info->judul }}</h4>
            <span class="text-xs text-gray-400 font-medium px-3 py-1 bg-gray-50 rounded-full border border-gray-100">
                <i class="fa-regular fa-calendar mr-1"></i> {{ $info->created_at->format('d M Y') }}
            </span>
        </div>

        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line mt-3">
            {{ $info->isi_pengumuman }}
        </p>
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
        <div class="text-gray-300 mb-4">
            <i class="fa-regular fa-bell-slash text-6xl"></i>
        </div>
        <h4 class="text-lg font-bold text-gray-700 mb-1">Belum Ada Informasi</h4>
        <p class="text-gray-500 text-sm">Saat ini belum ada pengumuman terbaru dari pihak pengelola.</p>
    </div>
    @endforelse
</div>
@endsection