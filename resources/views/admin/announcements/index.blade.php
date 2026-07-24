@extends('layouts.app')

@section('title', 'Kelola Pengumuman - Admin')
@section('header_title', 'Papan Pengumuman')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="mb-6 flex justify-between items-end">
    <div>
        <h3 class="text-2xl font-bold text-gray-800">Daftar Pengumuman</h3>
        <p class="text-gray-500 text-sm mt-1">Informasi yang akan tampil di dashboard penyewa.</p>
    </div>
    <a href="{{ route('admin.announcements.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-md">
        <i class="fa-solid fa-plus mr-2"></i> Buat Pengumuman
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($pengumuman as $info)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 flex-1">
            <div class="flex justify-between items-start mb-4">
                @if($info->is_active)
                <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase tracking-wider">Aktif</span>
                @else
                <span class="px-2 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold rounded uppercase tracking-wider">Nonaktif</span>
                @endif
                <span class="text-xs text-gray-400">{{ $info->created_at->format('d M Y') }}</span>
            </div>
            <h4 class="font-bold text-gray-800 text-lg mb-2">{{ $info->judul }}</h4>

            <p class="text-sm text-gray-600 line-clamp-3">{{ $info->isi_pengumuman }}</p>
        </div>
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-end space-x-2">

            <a href="{{ route('admin.announcements.edit', $info->id_announcement) }}" class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-colors text-sm font-medium">
                <i class="fa-solid fa-pen"></i> Edit
            </a>
            <form action="{{ route('admin.announcements.destroy', $info->id_announcement) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengumuman ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-medium">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach

</div>
@endsection