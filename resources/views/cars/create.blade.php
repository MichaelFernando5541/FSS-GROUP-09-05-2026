<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Daftarkan Unit Mobil Baru</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Lengkapi data spesifikasi dan legalitas aset kendaraan</p>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-8">
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Detail Spesifikasi Unit</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Merek Kendaraan</label>
                            <input type="text" name="merk" value="{{ old('merk') }}" required
                                   class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                   placeholder="Contoh: Toyota, Honda, Mitsubishi">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Tipe / Model</label>
                            <input type="text" name="tipe" value="{{ old('tipe') }}" required
                                   class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                   placeholder="Contoh: Avanza G, Civic Turbo, Pajero Sport">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Tahun Produksi</label>
                                <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" required
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                       placeholder="YYYY">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Kondisi</label>
                                <select name="kondisi" required class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition appearance-none">
                                    <option value="Sangat Baik">Sangat Baik</option>
                                    <option value="Baik">Baik (Normal)</option>
                                    <option value="Butuh Perbaikan">Butuh Perbaikan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
                        <div class="p-2 bg-purple-50 text-purple-600 rounded-xl border border-purple-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Legalitas & Investasi</h3>
                    </div>
                    
                    <div class="p-8 space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Nomor Polisi (Nopol)</label>
                                <input type="text" name="nopol" value="{{ old('nopol') }}" required
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-yellow-50 focus:border-gray-900 focus:ring-0 text-sm font-black text-gray-800 uppercase transition shadow-inner" 
                                       placeholder="BG 1234 XX">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">No. Rangka</label>
                                <input type="text" name="no_rangka" value="{{ old('no_rangka') }}" required
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                       placeholder="Cek fisik rangka">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">No. Mesin</label>
                            <input type="text" name="no_mesin" value="{{ old('no_mesin') }}" required
                                   class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                   placeholder="Cek fisik mesin">
                        </div>

                        <div class="pt-4 border-t border-gray-50 space-y-5">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 mb-2 ml-1">Harga Beli Awal (Modal)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 font-bold text-xs">Rp</span>
                                    <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" required
                                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-black text-gray-900 transition">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 mb-2 ml-1">Estimasi Biaya Operasional</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 font-bold text-xs">Rp</span>
                                    <input type="number" name="biaya_operasional" value="{{ old('biaya_operasional', 0) }}" required
                                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-blue-500 focus:ring-0 text-sm font-black text-gray-900 transition">
                                </div>
                                <p class="text-[9px] text-gray-400 mt-2 font-medium italic">*Biaya perbaikan, salon, atau dokumen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <a href="{{ route('cars.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Batal & Kembali
                </a>
                
                <button type="submit" class="bg-gray-900 hover:bg-black text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-gray-200 transition transform active:scale-95 uppercase text-xs tracking-[0.2em] flex items-center gap-3">
                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan ke Inventori
                </button>
            </div>
        </form>
    </div>
</x-app-layout>