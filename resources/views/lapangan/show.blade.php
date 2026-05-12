@extends('layouts.app')

@section('title', 'Detail ' . $lapangan->nama_lapangan)

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 pb-12">
    <a href="/dashboard" class="inline-flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 hover:text-blue-600 transition">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
    </a>

    <div class="bg-gray-900 rounded-3xl overflow-hidden shadow-2xl mb-8 border-4 border-white h-[450px] flex flex-col md:flex-row">
        <div class="w-full md:w-3/4 h-full relative">
            <img id="mainFoto" src="{{ $lapangan->galeri->isNotEmpty() ? $lapangan->galeri->first()->path_foto : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000' }}" 
                 class="w-full h-full object-cover transition duration-500 hover:scale-105">
            
            <div class="absolute top-6 left-6 bg-blue-900/90 backdrop-blur text-white px-6 py-4 rounded-2xl font-black shadow-2xl">
                <p class="text-[9px] uppercase opacity-60 mb-1 tracking-widest leading-none">Harga Per Jam</p>
                <p class="text-2xl leading-none font-black">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="w-full md:w-1/4 p-4 flex md:flex-col gap-3 overflow-auto bg-black/50">
            @foreach($lapangan->galeri as $key => $foto)
                <img src="{{ $foto->path_foto }}" 
                     class="w-24 h-20 md:w-full md:h-28 object-cover rounded-xl cursor-pointer opacity-60 hover:opacity-100 transition border-2 {{ $key == 0 ? 'border-blue-500 opacity-100' : 'border-transparent' }}"
                     onclick="document.getElementById('mainFoto').src=this.src;">
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="flex-grow">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-blue-50 text-blue-700 text-[9px] px-4 py-2 rounded-full font-black uppercase tracking-wider">{{ $lapangan->tipe_rumput }}</span>
                    <span class="flex items-center gap-2 text-[10px] font-black text-green-600 uppercase tracking-widest">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Slot Tersedia
                    </span>
                </div>
                
                <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter mb-8 border-b-4 border-blue-50 pb-4 inline-block">{{ $lapangan->nama_lapangan }}</h1>

                <div class="bg-gray-50 border border-gray-100 p-5 rounded-2xl flex items-start gap-4 mb-8">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-blue-900 uppercase tracking-widest mb-1">Lokasi Arena</p>
                        <p class="text-xs font-bold text-gray-700">{{ $lapangan->lokasi_id }}, Kota Bandung</p>
                        <p class="text-[10px] text-gray-500 italic mt-1 leading-relaxed">Dekat area {{ $lapangan->lokasi_id }} (Info lengkap hubungi admin)</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Status Jadwal Hari Ini</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="p-3 bg-white border border-gray-200 rounded-xl text-center shadow-sm">
                            <p class="text-[8px] font-black text-gray-400 uppercase">Pagi</p>
                            <p class="text-[10px] font-bold text-gray-700">08:00 - 12:00</p>
                        </div>
                        <div class="p-3 bg-white border border-gray-200 rounded-xl text-center shadow-sm">
                            <p class="text-[8px] font-black text-gray-400 uppercase">Siang</p>
                            <p class="text-[10px] font-bold text-gray-700">13:00 - 17:00</p>
                        </div>
                        <div class="p-3 bg-red-50 border border-red-100 rounded-xl text-center shadow-sm opacity-60">
                            <p class="text-[8px] font-black text-red-600 uppercase">PENUH</p>
                            <p class="text-[10px] font-bold text-gray-400 line-through">18:00 - 20:00</p>
                        </div>
                        <div class="p-3 bg-white border border-blue-200 rounded-xl text-center shadow-sm">
                            <p class="text-[8px] font-black text-blue-600 uppercase">Malam</p>
                            <p class="text-[10px] font-bold text-gray-700">21:00 - 23:00</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Fasilitas</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $lapangan->fasilitas) as $f)
                                <span class="bg-gray-50 border border-gray-100 px-4 py-3 rounded-2xl text-[10px] font-bold text-gray-600 uppercase flex items-center gap-2">
                                    <i class="fas fa-check-circle text-blue-500"></i> {{ trim($f) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs italic leading-relaxed border-l-4 border-gray-100 pl-6">{{ $lapangan->deskripsi }}</p>
                </div>
            </div>

            <div class="w-full lg:w-96">
                <div class="bg-blue-700 rounded-[2.5rem] p-8 shadow-2xl text-white sticky top-10">
                    <h3 class="text-center text-xs font-black uppercase tracking-[0.3em] mb-8 opacity-80">Reservasi Jadwal</h3>
                    
                    <form action="{{ route('booking.checkout', $lapangan->lapangan_id) }}" method="GET" class="space-y-6">
    <div>
        <label class="block text-[9px] font-black text-blue-200 uppercase mb-2 ml-1">Pilih Tanggal Main</label>
        <div class="relative">
            <input type="date" name="tgl_main" required 
                class="w-full bg-white border-none p-4 rounded-2xl text-xs font-bold text-gray-800 focus:ring-4 focus:ring-blue-400 outline-none">
        </div>
    </div>
    
    <div>
        <label class="block text-[9px] font-black text-blue-200 uppercase mb-2 ml-1">Pilih Jam</label>
        <div class="relative">
            <select name="jam_mulai" required 
                class="w-full bg-white border-none p-4 rounded-2xl text-xs font-bold text-gray-800 focus:ring-4 focus:ring-blue-400 outline-none">
                <option value="08:00">08:00 WIB</option>
                <option value="09:00">09:00 WIB</option>
                <option value="16:00">16:00 WIB</option>
                <option value="19:00">19:00 WIB</option>
                <option value="20:00">20:00 WIB</option>
            </select>
        </div>
    </div>

    <div class="pt-6">
        <button type="submit" class="w-full bg-white hover:bg-blue-50 text-blue-700 font-black py-5 rounded-2xl text-xs uppercase tracking-[0.2em] transition shadow-lg active:scale-95 flex items-center justify-center gap-3">
            <i class="fas fa-arrow-right"></i> Lanjut Ke Pembayaran
        </button>
        <p class="text-[8px] text-center text-blue-200 mt-4 font-bold uppercase tracking-widest opacity-60">Cek detail pesanan di halaman berikutnya</p>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection