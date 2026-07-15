<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // TAMPILAN INDEX KARYAWAN
    public function index()
    {
        $dataKaryawan = Karyawan::all();
        return view('karyawan.index', compact('dataKaryawan'));
    }

    // TAMPILAN FORM TAMBAH KARYAWAN
    public function create()
    {
        return view('karyawan.create');
    }

    // PROSES SIMPAN DATA KARYAWAN
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Ditambahkan');
    }

    // TAMPILAN FORM EDIT KARYAWAN
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    // PROSES UPDATE DATA KARYAWAN
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Diperbarui');
    }

    // PROSES HAPUS KARYAWAN
    public function destroy(Karyawan $karyawan)
    {
        // Karena di migration menggunakan onDelete('cascade'), 
        // menghapus karyawan otomatis menghapus riwayat gajinya agar tidak konflik.
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan Berhasil Dihapus');
    }
}