<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('admin.lapangans.index', compact('lapangan'));
    }

    public function create()
    {
        return view('admin.lapangans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan'  => 'required|string',
            'jenis_lapangan' => 'required|string',
            'harga_per_jam'  => 'required|numeric',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        // Ambil semua data selain gambar
        $data = $request->except('gambar');

        // Proses upload jika ada file gambar
        if ($request->hasFile('gambar')) {
            // File akan disimpan di storage/app/public/lapangan
            $data['gambar'] = $request->file('gambar')->store('lapangan', 'public');
        }

        \App\Models\Lapangan::create($data);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil ditambahkan!');
    }   

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangans.edit', compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lapangan'  => 'required|string',
            'jenis_lapangan' => 'required|string',
            'harga_per_jam'  => 'required|numeric',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lapangan = \App\Models\Lapangan::findOrFail($id);
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage jika sebelumnya sudah ada gambar
            if ($lapangan->gambar && Storage::disk('public')->exists($lapangan->gambar)) {
                Storage::disk('public')->delete($lapangan->gambar);
            }
            
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil diperbarui!');
    }

    public function destroy($id)
{
    $lapangan = Lapangan::findOrFail($id);

    // TAMBAHKAN INI: Hapus gambar dari storage sebelum menghapus baris database
    if ($lapangan->gambar && Storage::disk('public')->exists($lapangan->gambar)) {
        Storage::disk('public')->delete($lapangan->gambar);
    }

    $lapangan->delete();

    return redirect()->route('admin.lapangan.index')->with('success', 'Data lapangan berhasil dihapus!');
}
    
}