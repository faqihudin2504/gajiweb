<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan metrik ringkasan penggajian.
     * * Algoritma: 
     * - Menggunakan fungsi agregasi (count, sum, avg) dari Eloquent ORM.
     * - Melakukan Eager Loading (with) untuk memanggil relasi karyawan guna efisiensi query.
     * * @return \Illuminate\View\View
     */
    // TAMPILAN DASHBOARD
    public function dashboard()
    {
        $totalKaryawan = Karyawan::count();
        $totalPengeluaran = Penggajian::sum('total_gaji');
        $rataRataGaji = Penggajian::avg('total_gaji');
        $totalTunjangan = Penggajian::sum('tunjangan');
        
        // Eager loading relasi karyawan untuk riwayat terbaru
        $gajiTerbaru = Penggajian::with('karyawan')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('penggajian.dashboard', compact(
            'totalKaryawan', 
            'totalPengeluaran', 
            'rataRataGaji', 
            'totalTunjangan', 
            'gajiTerbaru'
        ));
    }

    /**
     * Menampilkan daftar riwayat transaksi penggajian.
     * 
     * Skalabilitas & Akses Basis Data:
     * - Menerapkan teknik Eager Loading (with('karyawan')) untuk menghindari N+1 query.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menarik data penggajian lengkap dengan data karyawannya
        $dataGaji = Penggajian::with('karyawan')->get();
        return view('penggajian.index', compact('dataGaji'));
    }

    // TAMPILAN FORM CREATE
    public function create()
    {
        // 1. Ambil array kumpulan ID karyawan yang sudah punya data gaji
        $karyawanTerdaftar = Penggajian::pluck('karyawan_id');

        // 2. Tarik data karyawan yang ID-nya TIDAK ADA (whereNotIn) di kumpulan ID tadi
        $dataKaryawan = Karyawan::whereNotIn('id', $karyawanTerdaftar)->get();

        return view('penggajian.create', compact('dataKaryawan'));
    }

    /**
     * Menyimpan data transaksi penggajian baru ke database.
     * * Algoritma:
     * - Menerima request input dan melakukan validasi form.
     * - Melakukan operasi aritmatika (Total Gaji = Gaji Pokok + Tunjangan).
     * - Menyimpan data ke tabel penggajians berelasi dengan karyawan_id.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // PROSES SIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id', // Memastikan ID karyawan valid di database
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
        ]);

        $total_gaji = $request->gaji_pokok + $request->tunjangan;

        Penggajian::create([
            'karyawan_id' => $request->karyawan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'total_gaji' => $total_gaji
        ]);

        return redirect()->route('penggajian.index')->with('success', 'Data Gaji Berhasil Ditambahkan');
    }

    // TAMPILAN FORM UPDATE
    public function edit(Penggajian $penggajian)
    {
        $dataKaryawan = Karyawan::all();
        return view('penggajian.edit', compact('penggajian', 'dataKaryawan'));
    }

    // PROSES UPDATE DATA
    public function update(Request $request, Penggajian $penggajian)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
        ]);

        $total_gaji = $request->gaji_pokok + $request->tunjangan;

        $penggajian->update([
            'karyawan_id' => $request->karyawan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'total_gaji' => $total_gaji
        ]);

        return redirect()->route('penggajian.index')->with('success', 'Data Gaji Berhasil Diperbarui');
    }

    // PROSES DELETE DATA
    public function destroy(Penggajian $penggajian)
    {
        $penggajian->delete();
        return redirect()->route('penggajian.index')->with('success', 'Data Gaji Berhasil Dihapus');
    }
}