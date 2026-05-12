<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Ambil data lapangan untuk tahu harganya
        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        // 2. Simpan data ke tabel bookings
        Booking::create([
            'user_id' => Auth::id(),
            'nama_gor' => $lapangan->nama_lapangan,
            'tgl_main' => $request->tgl_main,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => 1, // Kita defaultkan 1 jam dulu biar simpel
            'total_harga' => $lapangan->harga_per_jam,
            'status' => 'Pending'
        ]);

        // 3. Lempar balik ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Booking berhasil! Silahkan cek riwayat.');
    }

    public function checkout(Request $request, $id)
{
    // Ambil data lapangan berdasarkan ID yang diklik
    $lapangan = Lapangan::findOrFail($id);

    // Ambil data tanggal dan jam dari form sebelumnya (GET)
    $tanggal = $request->query('tgl_main');
    $jam = $request->query('jam_mulai');

    // Lempar semua data ke file booking/pemesanan.blade.php
    return view('booking.pemesanan', compact('lapangan', 'tanggal', 'jam'));
}
public function index()
{
    // Mengambil ID user yang sedang login menggunakan facade Auth
    $userId = Auth::id(); 

    $bookings = Booking::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('booking.index', compact('bookings'));
}
public function joinMember(Request $request)
{
    // Ambil ID user yang sedang login
    $userId = Auth::id();

    if ($userId) {
        // Cari user di database dan update kolom is_member jadi 0 (Pending)
        User::where('id', $userId)->update([
            'is_member' => 0
        ]);

        return back()->with('success', 'Permintaan terkirim! Silakan transfer ke Rek. 12345 a/n FutsalHub.');
    }

    return back()->with('error', 'Gagal memproses permintaan.');
}
// app/Http/Controllers/BookingController.php

// Pastikan ada ini di bagian paling atas file (di bawah namespace)
// use Illuminate\Support\Facades\Storage; 

public function uploadBukti(Request $request, $id)
{
    // 1. Validasi file: Harus gambar (jpg, png, jpeg) & maksimal 2MB
    $request->validate([
        'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    // 2. Cari data bookingnya
    $booking = Booking::findOrFail($id);

    // 3. Proses upload file
    if ($request->hasFile('bukti_bayar')) {
        // Simpan file ke folder: storage/app/public/bukti_pembayaran
        $path = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');
        
        // Simpan nama path-nya ke database
        $booking->update([
            'bukti_bayar' => $path
        ]);
    }

    return back()->with('success', 'Bukti pembayaran berhasil diunggah! Tunggu verifikasi admin.');
}
public function kwitansi($id)
{
    $booking = Booking::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->where('status', 'Success') // Hanya bisa cetak kalau sudah sukses
                      ->firstOrFail();

    return view('booking.kwitansi', compact('booking'));
}

}