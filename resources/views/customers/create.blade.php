<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Tambah Pelanggan Baru</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Masukkan data profil klien atau instansi ke dalam database sistem</p>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                
                <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Informasi Profil Klien</h3>
                </div>

                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Nama Pelanggan / Instansi</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                   class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition"
                                   placeholder="Contoh: Budi Santoso / PT. Maju Bersama">
                            @error('nama') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">No. Telepon / WA</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 font-bold text-xs">📞</span>
                                <input type="text" name="telepon" value="{{ old('telepon') }}" required
                                       class="w-full pl-10 pr-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition font-mono"
                                       placeholder="081234567890">
                            </div>
                            @error('telepon') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="4" required
                                  class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition resize-none"
                                  placeholder="Masukkan alamat domisili atau kantor..."></textarea>
                        @error('alamat') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="px-8 py-6 bg-gray-50/30 border-t border-gray-50 flex items-center justify-between">
                    <a href="{{ route('customers.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Batal & Kembali
                    </a>

                    <button type="submit" class="bg-gray-900 hover:bg-black text-white font-black py-4 px-8 rounded-2xl shadow-xl shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-[0.2em] flex items-center gap-3">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Pelanggan
                    </button>
                </div>
                
            </div>
        </form>
    </div>
</x-app-layout>