# Website Profil Desa Metesih

<p align="center">
  <img src="public/images/logo/Logo_kabupaten_madiun.gif" alt="Logo Kabupaten Madiun" width="150"/>
</p>

<p align="center">
  Sebuah platform digital untuk menyediakan informasi terkini dan profil lengkap mengenai Desa Metesih, Kecamatan Jiwan, Kabupaten Madiun.
</p>

---

## 📖 Tentang Proyek

Website Profil Desa Metesih adalah sebuah sistem informasi berbasis web yang dibangun untuk menjadi pusat data dan komunikasi bagi warga Desa Metesih serta masyarakat luas. Proyek ini bertujuan untuk meningkatkan transparansi, mempermudah akses informasi, dan mempromosikan potensi yang ada di Desa Metesih.

Website ini dikembangkan menggunakan Laravel dan Tailwind CSS, dengan fokus pada kemudahan penggunaan baik untuk pengunjung maupun administrator desa.

## ✨ Fitur Utama

Website ini memiliki dua sisi utama: halaman publik untuk pengunjung dan panel admin untuk pengelolaan konten.

### Halaman Publik (Guest)
- **Beranda**: Tampilan utama yang merangkum informasi penting dan berita terbaru.
- **Profil Desa**: Informasi mendetail mengenai sejarah, visi & misi, serta data demografis desa.
- **Berita**: Halaman untuk melihat semua artikel berita terkini dari desa.
- **Informasi Kegiatan**: Menampilkan jadwal kegiatan yang akan datang, dan secara otomatis mengarsipkan kegiatan yang telah selesai.
- **Struktur Organisasi**: Menampilkan bagan struktur pemerintahan desa.
- **Galeri**: Kumpulan dokumentasi foto dari berbagai kegiatan desa.
- **URL Ramah SEO**: Menggunakan format `judul-berita/id` untuk URL yang lebih mudah dibaca oleh mesin pencari dan manusia.

### Panel Admin
- **Dashboard**: Halaman utama admin untuk memberikan gambaran umum.
- **Manajemen Berita**: Fungsi CRUD (Create, Read, Update, Delete) penuh untuk mengelola artikel berita.
- **Manajemen Kegiatan**: CRUD untuk informasi kegiatan, lengkap dengan sistem status (`mendatang`/`selesai`) yang diperbarui secara otomatis setiap hari.
- **Manajemen Galeri**: Mengelola foto-foto yang akan ditampilkan di halaman galeri.
- **Editor Profil Desa**: Antarmuka untuk memperbarui konten halaman profil desa.
- **Editor Struktur Organisasi**: Mengelola data perangkat desa.
- **Akun Admin Ganda**: Sistem dilengkapi dengan dua akun admin default untuk keperluan utama dan cadangan.

## 🚀 Teknologi yang Digunakan

- **Backend**: PHP 8.2, Laravel 11
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL (atau sesuai konfigurasi Anda)
- **Build Tool**: Vite
- **Server**: Apache/Nginx

## 🛠️ Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/nama-anda/nama-repositori.git](https://github.com/nama-anda/nama-repositori.git)
    cd nama-repositori
    ```

2.  **Install Dependensi**
    Pastikan Anda memiliki Composer dan Node.js terinstal.
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Lingkungan**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasinya.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur koneksi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal, termasuk akun admin.
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Buat Symbolic Link untuk Storage**
    Agar file yang di-upload (seperti gambar berita) dapat diakses publik.
    ```bash
    php artisan storage:link
    ```

7.  **Kompilasi Aset Frontend**
    ```bash
    npm run dev
    ```

8.  **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

## 🔒 Catatan Keamanan

**PENTING**: Jangan pernah menyimpan data sensitif seperti *password*, API *keys*, atau kredensial lainnya langsung di dalam kode yang akan di-*commit* ke repositori. Selalu gunakan file `.env` untuk menyimpan data-data tersebut dan pastikan file `.env` sudah terdaftar di dalam `.gitignore`.

## 🔑 Akun Admin Default

Setelah menjalankan *seeder*, Anda dapat masuk ke panel admin melalui `/login` menggunakan kredensial berikut:

**Akun Admin Utama:**
- **Email**: `admin@gmail.com`
- **Password**: `passwordadmin12345`

---

Terima kasih telah menggunakan dan berkontribusi pada proyek ini!
