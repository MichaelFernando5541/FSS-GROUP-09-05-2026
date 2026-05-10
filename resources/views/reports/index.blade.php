<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Laporan Penjualan</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Filter dan pantau transaksi berdasarkan periode</p>
    </x-slot>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 mb-8 mt-6">
        <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col md:flex-row gap-6 items-end">
            
            <div class="flex-1">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Dari Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-200 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition">
                </div>
            </div>
            
            <div class="flex-1">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2 ml-1">Sampai Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-200 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition">
                </div>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="bg-gray-900 hover:bg-black text-white font-black py-3.5 px-8 rounded-xl shadow-lg shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-widest flex items-center justify-center gap-2 h-[46px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Tampilkan Data
                </button>
                <a href="{{ route('reports.index') }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-500 font-black py-3.5 px-6 rounded-xl transition uppercase text-[10px] tracking-widest flex items-center justify-center h-[46px]" title="Reset Filter">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </a>
            </div>
        </form>
    </div>

    @php
        $totalPenjualan = 0; $totalModal = 0;
        $dataSales = $sales ?? [];
        
        foreach($dataSales as $sale) {
            $totalPenjualan += $sale->total_amount;
            if($sale->car) { $totalModal += ($sale->car->harga_beli + $sale->car->biaya_operasional); }
        }
        
        $keuntunganKotor = $totalPenjualan - $totalModal;
        $ppn = $totalPenjualan * 0.011;
        $labaBersih = $keuntunganKotor - $ppn;
        $marginROI = $totalModal > 0 ? ($labaBersih / $totalModal) * 100 : 0;
    @endphp

    @if(count($dataSales) > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Penjualan Bruto</p>
                <h4 class="text-lg font-black text-gray-800 mt-1">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest text-blue-500">Estimasi Laba Bersih</p>
                <h4 class="text-lg font-black text-blue-600 mt-1">Rp {{ number_format($labaBersih, 0, ',', '.') }}</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest text-green-500">Margin ROI Rata-rata</p>
                <h4 class="text-lg font-black text-green-600 mt-1">{{ number_format($marginROI, 1, ',', '.') }}%</h4>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest text-red-400">Beban PPN (1.1%)</p>
                <h4 class="text-lg font-black text-red-500 mt-1">Rp {{ number_format($ppn, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 bg-white flex justify-between items-center">
                <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Rincian Transaksi & ROI Per Unit</h3>
                <span class="text-[9px] font-black px-3 py-1 bg-blue-50 text-blue-600 rounded-full uppercase tracking-widest border border-blue-100/50">Verified Data</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Unit Kendaraan</th>
                            <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-right">Harga Beli + Ops</th>
                            <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-right">Harga Jual</th>
                            <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-right">Keuntungan (ROI)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($dataSales as $sale)
                            @php
                                $modalUnit = $sale->car ? ($sale->car->harga_beli + $sale->car->biaya_operasional) : 0;
                                $untungUnit = $sale->total_amount - $modalUnit;
                                $roiUnit = $modalUnit > 0 ? ($untungUnit / $modalUnit) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-gray-50/30 transition group">
                                <td class="px-8 py-5 text-xs text-gray-500 font-medium tracking-tighter">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                                <td class="px-8 py-5 font-black text-gray-800 text-sm uppercase">
                                    {{ $sale->car ? $sale->car->merk . ' ' . $sale->car->tipe . ' (' . $sale->car->tahun . ')' : 'UNIT DIHAPUS' }}
                                </td>
                                <td class="px-8 py-5 text-right font-bold text-gray-400 text-xs">Rp {{ number_format($modalUnit, 0, ',', '.') }}</td>
                                <td class="px-8 py-5 text-right font-black text-gray-900 text-sm">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                <td class="px-8 py-5 text-right">
                                    <span class="text-sm font-black {{ $untungUnit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $untungUnit < 0 ? '-' : '' }}Rp {{ number_format(abs($untungUnit), 0, ',', '.') }}
                                    </span>
                                    <span class="block text-[9px] font-black uppercase tracking-widest mt-0.5 {{ $roiUnit >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $roiUnit >= 0 ? '+' : '' }}{{ number_format($roiUnit, 1, ',', '.') }}% ROI
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden min-h-[300px] flex flex-col items-center justify-center">
            <div class="py-16 text-center opacity-50">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-200 mx-auto">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h5 class="text-sm font-black text-gray-600 uppercase tracking-widest">Tidak Ditemukan Data</h5>
                <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase">Belum ada transaksi pada rentang tanggal yang dipilih.</p>
            </div>
        </div>
    @endif
</x-app-layout> 