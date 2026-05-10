<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Dashboard Utama</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Ringkasan performa bisnis Anda</p>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 border border-blue-100/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Aset Tersedia</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">Rp {{ number_format($netWorth, 0, ',', '.') }}</h3>
            <p class="text-[10px] text-gray-400 mt-2 font-medium italic">Total modal di stok mobil saat ini</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md">
            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-4 border border-green-100/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Unit Terjual</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1 text-green-600">{{ $soldUnits }} Unit</h3>
            <p class="text-[10px] text-gray-400 mt-2 font-medium italic">Total volume penjualan terkumpul</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md relative overflow-hidden">
            <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4 border border-purple-100/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-purple-400">Laba Bersih (ROI)</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">Rp {{ number_format($totalROI, 0, ',', '.') }}</h3>
            <p class="text-[10px] text-gray-400 mt-2 font-medium italic">Keuntungan setelah PPN 1,1%</p>
            <div class="absolute bottom-4 right-4 opacity-10">
                <svg class="w-16 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
    </div>

    @if($oldStocks->count() > 0)
    <div class="mb-8 bg-red-50/50 border border-red-100 rounded-2xl p-5 flex gap-4 items-center">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-red-600 border border-red-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-sm font-black text-red-900 uppercase tracking-tighter">Peringatan: Stok Mengendap (> 30 Hari)</h4>
            <p class="text-xs text-red-600 font-medium">Terdapat unit yang belum terjual dalam waktu lama. Segera lakukan review harga.</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-white">
            <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Inventori Kendaraan</h3>
            <span class="text-[10px] font-black px-2 py-0.5 bg-gray-100 rounded text-gray-400 uppercase tracking-widest">Live Report</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Unit Kendaraan</th>
                        <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Tgl Masuk</th>
                        <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Durasi</th>
                        <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-right">Modal Tertanam</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($oldStocks as $car)
                        <tr class="hover:bg-gray-50/30 transition group">
                            <td class="px-6 py-4 font-bold text-gray-800 text-sm group-hover:text-blue-600 transition">{{ $car->merk }} {{ $car->tipe }}</td>
                            <td class="px-6 py-4 text-xs text-gray-400 font-medium">{{ $car->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-red-50 text-red-600 text-[10px] font-black rounded border border-red-100">
                                    {{ now()->diffInDays($car->created_at) }} HARI
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-gray-900 text-sm italic">
                                Rp {{ number_format($car->harga_beli, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100 relative shadow-inner">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="absolute -top-1 -right-1 flex h-4 w-4">
                                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-20"></span>
                                          <span class="relative inline-flex rounded-full h-4 w-4 bg-green-50"></span>
                                        </div>
                                    </div>
                                    <h5 class="text-sm font-black text-gray-800 uppercase tracking-widest">Luar biasa! Perputaran stok sangat cepat.</h5>
                                    <p class="text-[10px] text-gray-400 font-bold mt-2 uppercase tracking-[0.2em]">Tidak ada stok lama yang mengendap saat ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>