<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    //
    use HasFactory;

    protected $table = 'lapangan'; // Nama tabel di DB
    protected $primaryKey = 'lapangan_id'; // Nama PK sesuai migrasi tadi
    
    // Ini daftar kolom yang boleh diisi lewat form
    protected $fillable = [
        'lokasi_id', 'nama_lapangan', 'tipe_rumput', 'harga_per_jam', 'fasilitas', 'deskripsi'
    ];

    public function galeri()
{
    return $this->hasMany(FotoLapangan::class, 'lapangan_id', 'lapangan_id');
}
}
