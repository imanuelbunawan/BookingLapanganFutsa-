<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Mengisi Data Master Roles
        DB::table('roles')->insert([
            ['id_role' => 1, 'nama_role' => 'admin'],
            ['id_role' => 2, 'nama_role' => 'penyewa'],
        ]);

        // 2. Mengisi Data Master Statuses (Untuk Akun User)
        DB::table('statuses')->insert([
            ['id_status' => 1, 'nama_status' => 'pending'],
            ['id_status' => 2, 'nama_status' => 'disetujui'],
            ['id_status' => 3, 'nama_status' => 'ditolak'],
        ]);

        // 3. Membuat Akun Default Admin (Langsung Disetujui)
        DB::table('users')->insert([
            'nama_lengkap' => 'Super Admin Lapangan',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'id_role' => 1,    // admin
            'id_status' => 2,  // disetujui
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. PEMBARUAN: Membuat Akun Penyewa dengan Berbagai Status Verifikasi

        // A. Penyewa dengan Status: PENDING (Menunggu Verifikasi Admin)
        DB::table('users')->insert([
            'nama_lengkap' => 'Budi Pending Santoso',
            'email' => 'budi.pending@gmail.com',
            'password' => Hash::make('penyewa123'),
            'no_hp' => '089876543210',
            'id_role' => 2,    // penyewa
            'id_status' => 1,  // pending
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // B. Penyewa dengan Status: DISETUJUI / DITERIMA (Bisa langsung login & booking)
        DB::table('users')->insert([
            'nama_lengkap' => 'Andi Sukses Pratama',
            'email' => 'andi.sukses@gmail.com',
            'password' => Hash::make('penyewa123'),
            'no_hp' => '089876543211',
            'id_role' => 2,    // penyewa
            'id_status' => 2,  // disetujui
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // C. Penyewa dengan Status: DITOLAK (Gagal verifikasi berkas/akun)
        DB::table('users')->insert([
            'nama_lengkap' => 'Zaki Ditolak Saputra',
            'email' => 'zaki.ditolak@gmail.com',
            'password' => Hash::make('penyewa123'),
            'no_hp' => '089876543212',
            'id_role' => 2,    // penyewa
            'id_status' => 3,  // ditolak
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ... (Kode seeder Role, Status, dan User yang sudah ada sebelumnya)

        // 4. Data Dummy Lapangan (BARU)
        DB::table('lapangans')->insert([
            'nama_lapangan' => 'Lapangan A',
            'jenis_lapangan' => 'Rumput Sintetis',
            'harga_per_jam' => 120000
        ]);

         DB::table('lapangans')->insert([
            'nama_lapangan' => 'Lapangan B',
            'jenis_lapangan' => 'Lantai Vinyl',
            'harga_per_jam' => 100000
        ]);

        DB::table('lapangans')->insert([
            'nama_lapangan' => 'Lapangan C',
            'jenis_lapangan' => 'Lantai Interlock',
            'harga_per_jam' => 150000
        ]);
        
    }
}