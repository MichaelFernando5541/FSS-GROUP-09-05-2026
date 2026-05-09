<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pesanan (Barang Keluar)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">No. Invoice</label>
                            <input type="text" name="invoice_no" class="w-full border-gray-300 rounded-md" placeholder="INV-OUT-001..." required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tanggal Pesanan</label>
                            <input type="date" name="sale_date" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nama Sales / Kasir</label>
                            <input type="text" name="sales_name" class="w-full border-gray-300 rounded-md" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pilih Customer (Opsional)</label>
                            <select name="customer_id" class="w-full border-gray-300 rounded-md">
                                <option value="">-- Pelanggan Umum (Walk-in) --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nama Pelanggan Umum</label>
                            <input type="text" name="customer_name" class="w-full border-gray-300 rounded-md" placeholder="Ketik jika bukan member...">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Status Pembayaran</label>
                            <select name="payment_status" class="w-full border-gray-300 rounded-md" required>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas (Hutang)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Barang Dibeli</h3>
                        <button type="button" onclick="tambahBarisPenjualan()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded shadow text-sm">
                            + Tambah Baris
                        </button>
                    </div>

                    <table class="w-full text-left border-collapse mb-6">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-2 font-semibold text-gray-600">Pilih Item</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/4">Harga Jual / Pcs</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/6">Qty</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/12 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="item-penjualan-container">
                            <tr class="border-b">
                                <td class="p-2">
                                    <select name="items[0][item_id]" class="w-full border-gray-300 rounded-md" required>
                                        <option value="">-- Pilih Item --</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2">
                                    <input type="number" name="items[0][price]" class="w-full border-gray-300 rounded-md" placeholder="Rp" required>
                                </td>
                                <td class="p-2">
                                    <input type="number" name="items[0][qty]" class="w-full border-gray-300 rounded-md" placeholder="Jml" required>
                                </td>
                                <td class="p-2 text-center">
                                    <span class="text-gray-400 text-sm italic">Tetap</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <a href="{{ route('items.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Proses Pesanan & Kurangi Stok</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        let barisJualIndex = 1; 

        function tambahBarisPenjualan() {
            const container = document.getElementById('item-penjualan-container');
            const barisBaru = `
                <tr class="border-b">
                    <td class="p-2">
                        <select name="items[${barisJualIndex}][item_id]" class="w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-2">
                        <input type="number" name="items[${barisJualIndex}][price]" class="w-full border-gray-300 rounded-md" placeholder="Rp" required>
                    </td>
                    <td class="p-2">
                        <input type="number" name="items[${barisJualIndex}][qty]" class="w-full border-gray-300 rounded-md" placeholder="Jml" required>
                    </td>
                    <td class="p-2 text-center">
                        <button type="button" onclick="hapusBaris(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
                    </td>
                </tr>
            `;
            container.insertAdjacentHTML('beforeend', barisBaru);
            barisJualIndex++;
        }

        function hapusBaris(tombol) {
            tombol.closest('tr').remove();
        }
    </script>
</x-app-layout>