<p align="center"><img src="C:\laragon\www\web-penggajian\gajiweb.png" width="400" alt="Gajiweb Logo"></a></p>

# Dokumentasi Proyek: Sistem Penggajian Berbasis Web (GajiWeb)

## 1. Deskripsi Proyek
GajiWeb adalah aplikasi sistem informasi berbasis web yang dirancang untuk mengelola data master karyawan dan transaksi penggajian. Sistem ini mengimplementasikan konsep operasi *Create, Read, Update, Delete* (CRUD) menggunakan standar arsitektur MVC (Model-View-Controller).

## 2. Lingkungan Pengembangan (Peralatan & Perlengkapan)
* **Perangkat Keras:** Laptop (RAM 12GB, Processor Core i3 10110u 2.1 GHz (Turbo 4.1 Ghz))
* **Sistem Operasi:** Windows 11 Home Single Language 64-Bit
* **Bahasa Pemrograman:** PHP 8.5.6
* **Framework:** Laravel 13
* **Database:** MySQL (MariaDB)
* **Web Server:** Local server via `php artisan serve` / Laragon
* **Frontend:** HTML5, CSS3 (Bootstrap 5), FontAwesome (Ikon)

## 3. Struktur Relasi Database
Sistem ini menggunakan prinsip Normalisasi Database dengan tabel yang berelasi:
* **Tabel `karyawans` (Master):** Menyimpan entitas data pegawai (`id`, `nama_karyawan`, `jabatan`, `no_telp`).
* **Tabel `penggajians` (Transaksi):** Menyimpan rekam gaji (`id`, `karyawan_id`, `gaji_pokok`, `tunjangan`, `total_gaji`).
* **Relasi:** *One-to-Many* (Satu karyawan dapat memiliki banyak data riwayat gaji). Dihubungkan menggunakan *Foreign Key* `karyawan_id` dengan aksi `onDelete('cascade')`.

## 4. Implementasi Algoritma Pemrograman
* **Aritmatika Penggajian:** Pada `PenggajianController@store` dan `update`, sistem melakukan kalkulasi dinamis: `$total_gaji = $request->gaji_pokok + $request->tunjangan;`.
* **Fungsi Agregasi SQL:** Pada halaman Dashboard, sistem mengolah data langsung dari basis data menggunakan Eloquent ORM: `count()` untuk total karyawan, `sum()` untuk total pengeluaran, dan `avg()` untuk rata-rata pengeluaran.
* **Filter Data Transaksi:** Pada `PenggajianController@create`, sistem memfilter karyawan yang sudah diinput gajinya agar tidak tampil berulang di *dropdown* menggunakan operator `whereNotIn`.

## 5. Analisis Skalabilitas Perangkat Lunak
* **Database Optimization:** Kueri relasi pada tabel menggunakan teknik *Eager Loading* (`with('karyawan')`) untuk menghindari masalah beban N+1 query. Hal ini membuat aplikasi tetap cepat meski data karyawan mencapai puluhan ribu.
* **Modular Code:** Struktur kode dipisahkan secara modular antara Data Master (Karyawan) dan Data Transaksi (Penggajian), sehingga penambahan fitur baru di masa depan (seperti modul Absensi atau Pajak) dapat ditambahkan tanpa merusak sistem yang sudah berjalan.

## 6. Coding Guidelines
Penulisan kode program mematuhi standar **PSR-12 (PHP Standard Recommendation)**:
* Penamaan *Controller* dan *Model* menggunakan format *PascalCase*.
* Penamaan variabel, properti, dan metode menggunakan format *camelCase*.
* Penggunaan nama tabel *plural* (jamak) sesuai konvensi bawaan Laravel.