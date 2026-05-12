<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Pastikan nama tabel sesuai di database

    protected $fillable = [
        'user_id', 
        'nama_gor', 
        'tgl_main', 
        'jam_mulai', 
        'durasi', 
        'total_harga', 
        'status'
    ];
}