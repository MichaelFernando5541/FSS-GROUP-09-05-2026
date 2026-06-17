<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Master Data: Daftar Pelanggan</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Kelola basis data pelanggan showroom Anda</p>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('customers.create') }}" class="bg-gray-900 hover:bg-black text-white font-black py-3.5 px-6 rounded-xl shadow-lg shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-widest flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            Tambah Pelanggan
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        
        <div class="px-8 py-5 border-b border-gray-50 bg-white flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Daftar Pelanggan Terdaftar</h3>
                <span class="text-[9px] font-black px-3 py-1 bg-blue-50 text-blue-600 rounded-full uppercase tracking-widest border border-blue-100/50 hidden md:inline-block">Client Database</span>
            </div>
            
            <form action="{{ route('customers.index') }}" method="GET" class="w-full md:w-1/3 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all bg-gray-50/50 focus:bg-white placeholder-gray-400" 
                       placeholder="Cari nama, no. telp, alamat..."
                       autocomplete="off">
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Nama Pelanggan</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">No. Telepon / WA</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Alamat</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($customers ?? [] as $customer)
                        <tr class="hover:bg-gray-50/30 transition group">
                            <td class="px-8 py-5">
                                <span class="font-black text-gray-900 text-sm block">{{ $customer->nama }}</span>
                            </td>
                            <td class="px-8 py-5 text-xs text-gray-600 font-bold font-mono">{{ $customer->telepon }}</td>
                            <td class="px-8 py-5 text-xs text-gray-500 font-medium max-w-xs truncate">{{ $customer->alamat }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="p-2 bg-white border border-gray-200 text-gray-400 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition shadow-sm" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Hapus data pelanggan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-white border border-gray-200 text-gray-400 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition shadow-sm" title="Hapus Pelanggan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    @if(request('search'))
                                        <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4 border border-red-100">
                                            <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Pelanggan tidak ditemukan.</p>
                                        <p class="text-[10px] text-gray-400 font-bold mt-1">Coba gunakan kata kunci lain.</p>
                                    @else
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Belum ada data pelanggan.</p>
                                        <p class="text-[10px] text-gray-400 font-bold mt-1">Klik tombol "Tambah Pelanggan" untuk memulai.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>