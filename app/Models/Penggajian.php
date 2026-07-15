<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    
    // Sesuaikan fillable dengan kolom terbaru
    protected $fillable = ['karyawan_id', 'gaji_pokok', 'tunjangan', 'total_gaji'];

    // Relasi: Satu data penggajian hanya milik satu karyawan (belongsTo)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
