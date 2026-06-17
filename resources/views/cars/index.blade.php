<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Manajemen Stok</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Kelola inventori kendaraan showroom Anda</p>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('cars.create') }}" class="bg-gray-900 hover:bg-black text-white font-black py-3.5 px-6 rounded-xl shadow-lg shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-widest flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Unit Mobil
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 flex flex-col gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col h-[calc(100vh-220px)]">
                
                <div class="p-5 border-b border-gray-50 bg-gray-50/50 flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Daftar Stok ({{ $cars->count() }})</h3>
                    </div>
                    
                    <form action="{{ route('cars.index') }}" method="GET" class="w-full">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   class="w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-slate-900 focus:border-slate-900 text-sm transition-colors bg-white shadow-inner" 
                                   placeholder="Cari merk, tipe, plat..."
                                   autocomplete="off">
                        </div>
                    </form>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar">
                    @forelse($cars as $car)
                        <a href="{{ route('cars.index', ['show' => $car->id, 'search' => request('search')]) }}" 
                           class="block p-4 rounded-2xl border transition-all duration-200 group {{ ($selectedCar && $selectedCar->id == $car->id) ? 'bg-gray-900 border-gray-900 shadow-xl shadow-gray-200' : 'bg-white border-gray-100 hover:border-gray-300 hover:shadow-md' }}">
                            
                            <div class="flex justify-between items-start">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ ($selectedCar && $selectedCar->id == $car->id) ? 'text-gray-400' : 'text-blue-600' }}">
                                        Thn. {{ $car->tahun }} &bull; {{ $car->kondisi }}
                                    </span>
                                    
                                    <h4 class="font-black text-sm uppercase mt-1 {{ ($selectedCar && $selectedCar->id == $car->id) ? 'text-white' : 'text-gray-800' }}">
                                        {{ $car->merk }} {{ $car->tipe }}
                                    </h4>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase {{ $car->status == 'Tersedia' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $car->status }}
                                </span>
                            </div>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <span class="font-mono text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-widest {{ ($selectedCar && $selectedCar->id == $car->id) ? 'bg-gray-800 text-gray-300' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $car->nopol }}
                                </span>
                                <span class="text-[11px] font-black {{ ($selectedCar && $selectedCar->id == $car->id) ? 'text-white' : 'text-gray-900' }}">
                                    Rp {{ number_format($car->harga_beli, 0, ',', '.') }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="py-20 text-center opacity-40 flex flex-col items-center">
                            <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Tidak ada data ditemukan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-8">
            @if($selectedCar)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-28">
                    
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">Profile</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">ID: #00{{ $selectedCar->id }}</span>
                            </div>
                            <h3 class="text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                                {{ $selectedCar->merk }} <span class="text-blue-600">{{ $selectedCar->tipe }}</span>
                            </h3>
                            <p class="text-gray-400 mt-2 font-medium uppercase text-xs tracking-[0.2em]">Kondisi: <span class="text-gray-800 font-black">{{ $selectedCar->kondisi }}</span></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest shadow-sm {{ $selectedCar->status == 'Tersedia' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-red-50 text-red-600 border border-red-100' }}">
                                {{ $selectedCar->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Legalitas Kendaraan</h4>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <span class="text-xs text-gray-500 font-bold uppercase">No. Polisi</span>
                                    <span class="text-xs font-black bg-yellow-200 px-2 rounded">{{ $selectedCar->nopol }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <span class="text-xs text-gray-500 font-bold uppercase">No. Rangka</span>
                                    <span class="text-xs font-black text-gray-800 uppercase">{{ $selectedCar->no_rangka }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <span class="text-xs text-gray-500 font-bold uppercase">No. Mesin</span>
                                    <span class="text-xs font-black text-gray-800 uppercase">{{ $selectedCar->no_mesin }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-white rounded-lg shadow-sm text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h4 class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em]">Informasi Finansial</h4>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between border-b border-blue-100/30 pb-2">
                                    <span class="text-xs text-blue-500/70 font-bold uppercase">Harga Beli</span>
                                    <span class="text-xs font-black text-gray-800">Rp {{ number_format($selectedCar->harga_beli, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between border-b border-blue-100/30 pb-2">
                                    <span class="text-xs text-blue-500/70 font-bold uppercase">Biaya Ops</span>
                                    <span class="text-xs font-black text-gray-800">Rp {{ number_format($selectedCar->biaya_operasional, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <span class="text-xs text-blue-600 font-black uppercase italic underline">Total Modal Berjalan</span>
                                    <span class="text-sm font-black text-blue-700 italic">Rp {{ number_format($selectedCar->harga_beli + $selectedCar->biaya_operasional, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                        @if($selectedCar->status == 'Tersedia')
                            <div class="flex gap-2">
                                <a href="{{ route('cars.edit', $selectedCar->id) }}" class="bg-gray-100 hover:bg-gray-900 hover:text-white text-gray-600 font-black py-3 px-8 rounded-xl transition duration-200 uppercase text-xs tracking-widest">
                                    Edit Unit
                                </a>
                            </div>
                            
                            <form action="{{ route('cars.destroy', $selectedCar->id) }}" method="POST" onsubmit="return confirm('Hapus unit {{ $selectedCar->merk }} dari sistem?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="group flex items-center gap-2 text-red-300 hover:text-red-600 transition duration-200">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">Hapus Unit Permanen</span>
                                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-red-600 group-hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </div>
                                </button>
                            </form>
                        @else
                            <div class="w-full bg-gray-50/80 rounded-xl p-4 flex items-center justify-center gap-3 border border-gray-200">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em]">Aset Telah Terjual — Data Terkunci</span>
                            </div>
                        @endif
                    </div>

                </div>
            @else
                <div class="h-full min-h-[400px] bg-white border-2 border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center text-center p-12">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="text-sm font-black text-gray-500 uppercase tracking-widest">Detail Tidak Tersedia</h4>
                    <p class="text-xs text-gray-400 mt-2 font-medium">Pilih salah satu unit mobil dari daftar di sebelah kiri untuk melihat rincian lengkapnya di sini.</p>
                </div>
            @endif 
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #D1D5DB; }
    </style>
</x-app-layout>