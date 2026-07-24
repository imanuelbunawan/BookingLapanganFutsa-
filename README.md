# 🎓 Web Booking Lapangan Futsal

**Aplikasi Booking Lapangan Futsal** adalah platform web yang dikembangkan untuk mendukung kegiatan operasional penyewaan lapangan dengan fokus pada manajemen pemesanan jadwal, verifikasi pembayaran, dan pengelolaan data penyewa secara digital.

---

## 🛠️ Tech Stack

Proyek ini dibangun menggunakan teknologi *full-stack* modern:

| Kategori | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Backend** | **Laravel 12** | Framework PHP yang elegan untuk pengembangan aplikasi web yang cepat dan aman. |
| **Frontend** | **Tailwind CSS** | Framework CSS utility-first yang memungkinkan desain antarmuka yang cepat dan kustom. |
| **Database** | **MySQL** | Sistem manajemen basis data relasional yang andal. |

---

## 🚀 Persyaratan Sistem (Requirements)

Pastikan sistem Anda telah memenuhi persyaratan berikut sebelum memulai instalasi:

* **PHP** (Versi terbaru, disarankan 8.2)
* **XAMPP** / **Laragon** / Lingkungan *web server* lain yang mendukung PHP dan MySQL.
* **Composer** (Manajer paket untuk PHP)
* Akses ke **MySQL** Database

---

## 💻 Instalasi Proyek

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek di lingkungan lokal Anda.

### 1. Kloning Repositori

Buka terminal atau Git Bash Anda dan klon proyek dari GitHub:

```
git clone https://github.com/imanuelbunawan/Projek_LSP_Batch-7_Immanuel_Bunawan.git
```
### 2. Cd Ke Project
```
cd Projek_LSP_Batch-7_Immanuel_Bunawan
```
### 3. Download Composer
```
composer install
```
### 4. Ubah .env.example sesuai database yang digunakan lalu copy paste menjadi .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bkf         # Ganti dengan nama database Anda
DB_USERNAME=root        # Ganti dengan username database Anda
DB_PASSWORD=            # Ganti dengan password database Anda
```
### 5. Key Generate
```
php artisan key:generate
```
### 6. Link Storage
```
php artisan storage:link
```
### 7. Migrate Database
```
php artisan migrate
```
### 8. Migrate Database Seeder
```
php artisan db:seed
php artisan migrate:fresh --seed
```
### 9. Jalankan Aplikasi
```
php artisan serv
```
### 10. Install NPM Dependencies
```
npm install
```
### 11. Jalankan Vite / Tailwind
```
npm run dev
```