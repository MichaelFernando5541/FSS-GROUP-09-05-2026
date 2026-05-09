<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faktur Pembelian (Barang Masuk)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">No. Faktur Supplier</label>
                            <input type="text" name="faktur_no" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="INV-001..." required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pilih Supplier</label>
                            <select name="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Barang Masuk</h3>
                        <button type="button" onclick="tambahBaris()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded shadow text-sm">
                            + Tambah Baris
                        </button>
                    </div>

                    <table class="w-full text-left border-collapse mb-6">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-2 font-semibold text-gray-600">Pilih Item</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/4">Harga Modal / Pcs</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/6">Qty</th>
                                <th class="p-2 font-semibold text-gray-600 w-1/12 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="item-container">
                            <tr class="border-b">
                                <td class="p-2">
                                    <select name="items[0][item_id]" class="w-full border-gray-300 rounded-md" required>
                                        <option value="">-- Pilih Item --</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2">
                                    <input type="number" name="items[0][modal]" class="w-full border-gray-300 rounded-md" placeholder="Rp" required>
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
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Simpan & Masukkan Stok</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Kita mulai dari index 1, karena index 0 sudah dipakai oleh baris pertama di atas
        let barisIndex = 1; 

        function tambahBaris() {
            const container = document.getElementById('item-container');
            
            // HTML untuk baris baru
            const barisBaru = `
                <tr class="border-b">
                    <td class="p-2">
                        <select name="items[${barisIndex}][item_id]" class="w-full border-gray-300 rounded-md" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-2">
                        <input type="number" name="items[${barisIndex}][modal]" class="w-full border-gray-300 rounded-md" placeholder="Rp" required>
                    </td>
                    <td class="p-2">
                        <input type="number" name="items[${barisIndex}][qty]" class="w-full border-gray-300 rounded-md" placeholder="Jml" required>
                    </td>
                    <td class="p-2 text-center">
                        <button type="button" onclick="hapusBaris(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">Hapus</button>
                    </td>
                </tr>
            `;
            
            // Masukkan baris baru ke dalam tabel
            container.insertAdjacentHTML('beforeend', barisBaru);
            barisIndex++; // Naikkan angka index untuk baris berikutnya
        }

        function hapusBaris(tombol) {
            // Hapus elemen <tr> (baris) tempat tombol ini berada
            tombol.closest('tr').remove();
        }
    </script>
</x-app-layout>