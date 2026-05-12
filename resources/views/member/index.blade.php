@extends('layouts.app')

@section('title', 'Membership')

@section('content')
<div class="w-full py-8">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-black uppercase italic tracking-tighter text-gray-800">Exclusive Membership</h2>
        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.4em] mt-2">Dapatkan Harga Khusus & Prioritas Booking</p>
    </div>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl shadow-gray-100/50">
            <h3 class="text-xl font-black text-gray-800 uppercase italic mb-6">Keuntungan Member:</h3>
            <ul class="space-y-4">
                <li class="flex items-center gap-3 text-sm font-bold text-gray-600">
                    <i class="fas fa-check-circle text-green-500"></i> Diskon 10% Setiap Booking
                </li>
                <li class="flex items-center gap-3 text-sm font-bold text-gray-600">
                    <i class="fas fa-check-circle text-green-500"></i> Booking 2 Minggu Sebelumnya
                </li>
                <li class="flex items-center gap-3 text-sm font-bold text-gray-600">
                    <i class="fas fa-check-circle text-green-500"></i> Gratis Air Mineral Setiap Main
                </li>
            </ul>
        </div>

        <div class="bg-blue-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-blue-300 uppercase tracking-widest mb-2">Biaya Pendaftaran</p>
                <h4 class="text-4xl font-black mb-6 tracking-tighter">Rp 50.000 <span class="text-xs font-normal opacity-60">/Bulan</span></h4>
                
                <form action="{{ route('membership.join') }}" method="POST">
    @csrf
    <button type="submit" class="w-full bg-white text-blue-900 font-black py-4 rounded-2xl uppercase tracking-widest hover:bg-blue-50 transition shadow-lg active:scale-95">
        Daftar Member Sekarang
    </button>
</form>
            </div>
            <i class="fas fa-crown absolute -right-8 -bottom-8 text-white opacity-10 text-[12rem] transform rotate-12"></i>
        </div>
    </div>
</div>
@endsection