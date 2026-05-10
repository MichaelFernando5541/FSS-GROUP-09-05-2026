<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Riwayat Transaksi Penjualan</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Data seluruh unit keluar dan invoice pelanggan</p>
    </x-slot>

    <div class="flex justify-end mb-6">
        <a href="{{ route('sales.create') }}" class="bg-gray-900 hover:bg-black text-white font-black py-3.5 px-6 rounded-xl shadow-lg shadow-gray-200 transition transform active:scale-95 uppercase text-[10px] tracking-widest flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Transaksi Baru
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-50 bg-white flex justify-between items-center">
            <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Daftar Invoice Penjualan</h3>
            <span class="text-[9px] font-black px-3 py-1 bg-gray-50 text-gray-500 rounded-full uppercase tracking-widest border border-gray-200">Data Real-time</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">No. Invoice</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Unit Terjual</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-right">Harga Deal</th>
                        <th class="px-8 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($sales as $sale)
                        <tr class="hover:bg-gray-50/30 transition group">
                            <td class="px-8 py-5 font-black text-gray-900 text-sm tracking-tight">{{ $sale->invoice_no }}</td>
                            <td class="px-8 py-5 text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                            <td class="px-8 py-5">
                                <span class="font-bold text-gray-800 block text-sm">{{ $sale->customer_name }}</span>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest {{ $sale->payment_status == 'Lunas' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-yellow-50 text-yellow-600 border border-yellow-100' }}">
                                    {{ $sale->payment_status }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                @if($sale->car)
                                    <span class="font-bold text-blue-600 block text-sm uppercase">{{ $sale->car->merk }} {{ $sale->car->tipe }}</span>
                                    <span class="text-[9px] font-mono font-bold text-gray-400 bg-gray-50 border border-gray-100 px-1.5 rounded mt-1 inline-block">{{ $sale->car->nopol }}</span>
                                @else
                                    <span class="text-red-500 italic text-xs font-bold">⚠️ Unit Dihapus</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right font-black text-green-600 text-sm">
                                Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('sales.edit', $sale->id) }}" class="p-2 bg-white border border-gray-200 text-gray-400 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition shadow-sm" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>

                                    <a href="{{ route('sales.print', $sale->id) }}" target="_blank" class="p-2 bg-white border border-gray-200 text-gray-400 rounded-lg hover:bg-gray-900 hover:text-white hover:border-gray-900 transition shadow-sm" title="Cetak Kwitansi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>

                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Batalkan transaksi ini? Unit mobil akan kembali ke status Tersedia.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-white border border-gray-200 text-gray-400 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition shadow-sm" title="Hapus Transaksi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </div>
                                    <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Belum ada transaksi penjualan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>