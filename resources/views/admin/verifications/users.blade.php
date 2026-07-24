@extends('layouts.app')

@section('title', 'Verifikasi Akun - Admin')
@section('header_title', 'Manajemen Pengguna')

@section('sidebar')
@include('layouts.sidebar_admin')
@endsection

@section('content')
<div class="mb-6 flex justify-between items-end">
    <div>
        <h3 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h3>
        <p class="text-gray-500 text-sm mt-1">Verifikasi akun penyewa yang baru mendaftar.</p>
    </div>
</div>

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg text-sm font-medium shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="space-y-12">

    <div>
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800"><i class="fa-solid fa-clock-rotate-left text-amber-500 mr-2"></i> Pendaftar Baru (Menunggu Verifikasi)</h3>
            <p class="text-gray-500 text-sm mt-1">Daftar pengguna yang baru saja mendaftar dan membutuhkan persetujuan Admin.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
            <div class="max-h-[335px] overflow-y-auto overflow-x-auto relative">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="sticky top-0 z-10 bg-amber-50 text-gray-600 text-sm border-b border-amber-100 shadow-[0_1px_0_0_rgba(253,246,227,1)]">
                            <th class="p-4 font-semibold">Nama Lengkap</th>
                            <th class="p-4 font-semibold">Kontak</th>
                            <th class="p-4 font-semibold text-center">Status</th>
                            <th class="p-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">

                        @forelse($pendingUsers as $user)
                        <tr class="hover:bg-amber-50/50 transition-colors">
                            <td class="p-4 font-bold text-gray-900">{{ $user->nama_lengkap }}</td>
                            <td class="p-4">
                                <div>{{ $user->email }}</div>
                                <div class="text-xs text-gray-500 mt-1"><i class="fa-brands fa-whatsapp text-green-500"></i> {{ $user->no_hp }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-amber-100 text-amber-700 border border-amber-200">PENDING</span>
                            </td>
                            <td class="p-4 text-center space-x-2 flex justify-center mt-2">
                                <form action="{{ route('admin.verifications.users.update', ['id_user' => $user->id_user]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors tooltip" title="Setujui Akun">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.verifications.users.update', ['id_user' => $user->id_user]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menolak pendaftaran ini?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors tooltip" title="Tolak Pendaftaran">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Yeay! Tidak ada pendaftaran baru yang tertunda.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div>
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800"><i class="fa-solid fa-users text-blue-500 mr-2"></i> Semua Pengguna</h3>
            <p class="text-gray-500 text-sm mt-1">Riwayat dan daftar seluruh pengguna yang terdaftar di sistem.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="max-h-[335px] overflow-y-auto overflow-x-auto relative">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="sticky top-0 z-10 bg-gray-50 text-gray-600 text-sm border-b border-gray-200 shadow-[0_1px_0_0_rgba(249,250,251,1)]">
                            <th class="p-4 font-semibold">Nama Lengkap</th>
                            <th class="p-4 font-semibold">Kontak</th>
                            <th class="p-4 font-semibold text-center">Status</th>
                            <th class="p-4 font-semibold text-center">Aksi (Ubah Status)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">

                        @forelse($allUsers as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-gray-900">{{ $user->nama_lengkap }}</td>
                            <td class="p-4">
                                <div>{{ $user->email }}</div>
                                <div class="text-xs text-gray-500 mt-1"><i class="fa-brands fa-whatsapp text-green-500"></i> {{ $user->no_hp }}</div>
                            </td>
                            <td class="p-4 text-center">
                                @if($user->id_status == 1)
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-amber-100 text-amber-700 border border-amber-200">PENDING</span>
                                @elseif($user->id_status == 2)
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">AKTIF</span>
                                @else
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">DITOLAK / BLOKIR</span>
                                @endif
                            </td>
                            <td class="p-4 text-center space-x-2 flex justify-center mt-2">

                                @if($user->id_status == 1 || $user->id_status == 3)
                                <form action="{{ route('admin.verifications.users.update', ['id_user' => $user->id_user]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors tooltip" title="Aktifkan Akun">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                @if($user->id_status == 1 || $user->id_status == 2)
                                <form action="{{ route('admin.verifications.users.update', ['id_user' => $user->id_user]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin memblokir / menolak akun ini?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors tooltip" title="Blokir / Tolak">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                                @endif

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada data pengguna sama sekali.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection