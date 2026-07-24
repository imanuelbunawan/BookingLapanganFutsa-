@extends('layouts.app')

@section('title', 'Kelola Lapangan - Admin')
@section('header_title', 'Manajemen Lapangan')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="mb-6 flex justify-between items-end">
    <div>
        <h3 class="text-2xl font-bold text-gray-800">Daftar Lapangan</h3>
        <p class="text-gray-500 text-sm mt-1">Kelola data lapangan futsal beserta harganya.</p>
    </div>
    <a href="{{ route('admin.lapangan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-md">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Lapangan
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r text-sm font-medium">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="p-4 font-semibold w-16 text-center">No</th>
                    <th class="p-4 font-semibold w-24">Foto</th>
                    <th class="p-4 font-semibold">Nama Lapangan</th>
                    <th class="p-4 font-semibold">Jenis Lantai</th>
                    <th class="p-4 font-semibold">Harga / Jam</th>
                    <th class="p-4 font-semibold text-center w-36">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($lapangan as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 text-center">{{ $index + 1 }}</td>
                    <td class="p-4">
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Foto Lapangan" class="w-16 h-12 object-cover rounded-md border shadow-sm">
                        @else
                        <div class="w-16 h-12 bg-gray-100 text-gray-400 flex items-center justify-center rounded-md border text-xs">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        @endif
                    </td>
                    <td class="p-4 font-bold text-gray-900">{{ $item->nama_lapangan }}</td>
                    <td class="p-4">{{ $item->jenis_lapangan }}</td>
                    <td class="p-4 font-medium text-green-600">Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}</td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.lapangan.edit', ['lapangan' => $item->id_lapangan]) }}" class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-colors tooltip" title="Edit">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>

                            <form action="{{ route('admin.lapangan.destroy', ['lapangan' => $item->id_lapangan]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini beserta gambarnya?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors tooltip" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500 font-medium">Belum ada data lapangan futsal tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection