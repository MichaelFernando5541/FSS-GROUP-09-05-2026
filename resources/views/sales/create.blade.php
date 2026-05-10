<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-black text-gray-800 leading-tight">Proses Transaksi Penjualan</h2>
        <p class="text-xs text-gray-400 font-medium uppercase mt-1 tracking-wider">Catat penjualan unit, pilih pelanggan, dan terbitkan invoice</p>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-8">
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Data Administrasi & Klien</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">No. Invoice</label>
                                <input type="text" name="invoice_no" value="{{ old('invoice_no', 'INV-'.date('Ymd').'-'.rand(100,999)) }}" readonly
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-100 text-gray-500 font-black tracking-widest text-xs cursor-not-allowed shadow-inner">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Tanggal Transaksi</label>
                                <input type="date" name="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}" required
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-50 space-y-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 mb-2 ml-1">Pilih Customer (Database)</label>
                                <select name="customer_id" class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-blue-50/30 focus:border-blue-500 focus:ring-0 text-sm font-bold text-gray-700 transition appearance-none">
                                    <option value="">-- Pelanggan Baru (Input Manual) --</option>
                                    @foreach($customers ?? [] as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama }} - {{ $customer->telepon }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Atau Nama Pelanggan Baru</label>
                                <input type="text" name="new_customer_name" value="{{ old('new_customer_name') }}"
                                       class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition" 
                                       placeholder="Ketik nama pelanggan jika tidak ada di database...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30 flex items-center gap-3">
                        <div class="p-2 bg-green-50 text-green-600 rounded-xl border border-green-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-black text-gray-800 uppercase text-[10px] tracking-[0.2em]">Detail Aset & Keuangan</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Pilih Unit Mobil (Tersedia)</label>
                            <select name="car_id" required class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-black text-gray-800 transition appearance-none">
                                <option value="">-- Pilih Mobil yang Dijual --</option>
                                @foreach($cars ?? [] as $car)
                                    <option value="{{ $car->id }}">{{ $car->nopol }} - {{ $car->merk }} {{ $car->tipe }} ({{ $car->tahun }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-green-500 mb-2 ml-1">Harga Jual Akhir (Deal)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 font-bold text-sm">Rp</span>
                                <input type="number" name="total_amount" value="{{ old('total_amount') }}" required
                                       class="w-full pl-12 pr-4 py-4 rounded-xl border-green-200 bg-green-50/30 focus:border-green-500 focus:ring-0 text-lg font-black text-green-700 transition"
                                       placeholder="Contoh: 150000000">
                            </div>
                            <p class="text-[9px] text-gray-400 mt-2 font-bold uppercase tracking-widest">*Sistem otomatis menambahkan PPN 1,1% ke total laporan ROI (Sesuai PMK 65/2022).</p>
                        </div>

                        <div class="pt-4 border-t border-gray-50">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2 ml-1">Status Pembayaran</label>
                            <select name="payment_status" required class="w-full px-4 py-3.5 rounded-xl border-gray-100 bg-gray-50/50 focus:border-gray-900 focus:ring-0 text-sm font-bold text-gray-700 transition appearance-none">
                                <option value="Lunas">Lunas (Cash / Transfer Full)</option>
                                <option value="Kredit">Kredit (Leasing / Bertahap)</option>
                                <option value="DP">Uang Muka (Down Payment)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <a href="{{ route('sales.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Batal & Kembali
                </a>
                
                <button type="submit" class="bg-gray-900 hover:bg-black text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-gray-200 transition transform active:scale-95 uppercase text-xs tracking-[0.2em] flex items-center gap-3">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Proses Transaksi & Cetak Nota
                </button>
            </div>
        </form>
    </div>
</x-app-layout>