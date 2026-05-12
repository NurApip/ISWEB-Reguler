@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-black uppercase mb-8 italic">Konfirmasi Pemesanan</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-blue-600 uppercase mb-4">Informasi Lapangan</p>
                <h3 class="text-xl font-bold mb-4">{{ $lapangan->nama_lapangan }}</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl">
                        <p class="text-[9px] text-gray-400 uppercase font-black">Tanggal Main</p>
                        <p class="font-bold">{{ $tanggal }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl">
                        <p class="text-[9px] text-gray-400 uppercase font-black">Jam Mulai</p>
                        <p class="font-bold">{{ $jam }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 rounded-3xl p-6 h-48 flex items-center justify-center border-2 border-dashed border-gray-300">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-red-500 text-3xl mb-2"></i>
                    <p class="text-xs font-bold text-gray-500 uppercase">Maps Arena Futsal</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border-2 border-blue-600 shadow-xl h-fit">
    <p class="text-[10px] font-black text-gray-400 uppercase mb-6">Ringkasan Pembayaran</p>
    
    <div class="space-y-3">
        <div class="flex justify-between">
            <span class="text-gray-500 text-xs">Harga per Jam</span>
            <span class="font-bold text-xs">Rp {{ number_format($lapangan->harga_per_jam) }}</span>
        </div>
        
        @if(Auth::user()->is_member)
        <div class="flex justify-between text-green-600">
            <span class="text-xs">Diskon Member</span>
            <span class="font-bold text-xs">- Rp 25.000</span>
        </div>
        @endif
    </div>

    <div class="border-t border-dashed my-4"></div>
    
    <div class="flex justify-between mb-8">
        <span class="font-black text-sm uppercase italic">Total Bayar</span>
        <span class="font-black text-blue-600 text-xl tracking-tighter">
            Rp {{ number_format($lapangan->harga_per_jam - (Auth::user()->is_member ? 25000 : 0)) }}
        </span>
    </div>

    <div class="mb-6">
        <label class="text-[9px] font-black text-gray-400 uppercase block mb-2">Metode Pembayaran</label>
        <select class="w-full p-3 rounded-xl border border-gray-100 text-xs font-bold outline-none focus:ring-2 focus:ring-blue-500">
            <option>Transfer Bank (Manual)</option>
            <option>QRIS / E-Wallet</option>
        </select>
    </div>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="lapangan_id" value="{{ $lapangan->lapangan_id }}">
        <input type="hidden" name="tgl_main" value="{{ $tanggal }}">
        <input type="hidden" name="jam_mulai" value="{{ $jam }}">
        
        <button type="submit" class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl text-[11px] uppercase tracking-[0.2em] shadow-lg hover:bg-blue-700 active:scale-95 transition">
            Konfirmasi & Bayar Sekarang
        </button>
    </form>
</div>
    </div>
</div>
@endsection