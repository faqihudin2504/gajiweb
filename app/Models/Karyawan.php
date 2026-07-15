<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama_karyawan', 'jabatan', 'no_telp'];

    // Relasi: Satu karyawan bisa punya banyak data penggajian (hasMany)
    public function penggajian()
    {
        return $this->hasMany(Penggajian::class);
    }
}