<p align="center"><img src="gajiweb.png" width="300" alt="GajiWeb Logo"></p>

# Dokumentasi Proyek: Sistem Penggajian Berbasis Web (GajiWeb)

## 1. Deskripsi Proyek
GajiWeb adalah aplikasi sistem informasi berbasis web yang dirancang untuk mengelola data master karyawan, transaksi penggajian, serta dilengkapi dengan sistem keamanan otentikasi administrator. Sistem ini mengimplementasikan konsep operasi *Create, Read, Update, Delete* (CRUD) menggunakan standar arsitektur MVC (Model-View-Controller).

## 2. Lingkungan Pengembangan (Peralatan & Perlengkapan)
* **Perangkat Keras:** Laptop (RAM 12GB, Processor Intel Core i3 10110u 2.1 GHz (Turbo 4.1 Ghz))
* **Sistem Operasi:** Windows 11 Home Single Language 64-Bit
* **Bahasa Pemrograman:** PHP 8.5.6
* **Framework:** Laravel 13
* **Database:** MySQL (MariaDB)
* **Web Server:** Local server via `php artisan serve` / Laragon
* **Frontend:** HTML5, CSS3 (Bootstrap 5), FontAwesome (Ikon)

## 3. Struktur Relasi Database
Sistem ini menggunakan prinsip Normalisasi Database dengan 3 tabel utama:
* **Tabel `users` (Otentikasi):** Menyimpan entitas administrator sistem (`id`, `name`, `email`, `username`, `password`).
* **Tabel `karyawans` (Master):** Menyimpan entitas data pegawai (`id`, `nama_karyawan`, `jabatan`, `no_telp`).
* **Tabel `penggajians` (Transaksi):** Menyimpan rekam gaji (`id`, `karyawan_id`, `gaji_pokok`, `tunjangan`, `total_gaji`).
* **Relasi:** *One-to-Many* (Satu karyawan dapat memiliki banyak data riwayat gaji). Dihubungkan menggunakan *Foreign Key* `karyawan_id` pada tabel `penggajians` yang merujuk ke tabel `karyawans` dengan aksi `onDelete('cascade')`.

## 4. Implementasi Algoritma Pemrograman
* **Keamanan Kriptografi:** Menerapkan algoritma enkripsi `Hash::make()` dari fasad Laravel untuk mengamankan *password* administrator di database.
* **Simulasi *One-Time Password* (OTP):** Menggunakan algoritma pengacakan angka `rand()` dipadukan dengan penyimpanan memori sementara (*Session Handling*) untuk menciptakan alur fitur Lupa Password tanpa memerlukan konfigurasi server SMTP eksternal.
* **Aritmatika Penggajian:** Pada `PenggajianController@store` dan `update`, sistem melakukan kalkulasi dinamis: `$total_gaji = $request->gaji_pokok + $request->tunjangan;`.
* **Fungsi Agregasi SQL:** Mengolah data langsung dari basis data menggunakan Eloquent ORM: `count()` untuk total karyawan, `sum()` untuk pengeluaran, dan `avg()` untuk rata-rata pengeluaran.
* **Filter Data Transaksi:** Pada halaman input gaji, sistem memfilter karyawan menggunakan operator `whereNotIn` agar karyawan yang sudah memiliki riwayat tidak tampil berulang di *dropdown*.

## 5. Analisis Skalabilitas Perangkat Lunak
* **Database Optimization:** Kueri relasi pada tabel menggunakan teknik *Eager Loading* (`with('karyawan')`) untuk menghindari masalah beban N+1 query. Hal ini membuat waktu muat halaman tetap cepat meski data karyawan mencapai puluhan ribu.
* **Pembatasan Muatan (Limitation):** Menggunakan *query builder* `limit(5)` pada *dashboard* untuk menjaga stabilitas *memory usage* saat merender data transaksi terbaru.
* **Modular Code & Middleware:** Struktur kode dipisahkan secara modular dan diamankan melalui lapisan `middleware('auth')`. Penambahan fitur baru di masa depan dapat dilakukan tanpa merusak fondasi sistem yang sudah berjalan.

## 6. Coding Guidelines
Penulisan kode program mematuhi standar **PSR-12 (PHP Standard Recommendation)**:
* Penamaan *Controller* dan *Model* menggunakan format *PascalCase*.
* Penamaan variabel, properti, dan metode menggunakan format *camelCase*.
* Penggunaan nama tabel *plural* (jamak) sesuai konvensi bawaan framework.