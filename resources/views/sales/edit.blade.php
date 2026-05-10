<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            Edit Transaksi Penjualan: {{ $sale->invoice_no }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow sm:rounded-lg">
                <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Nama Pelanggan</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', $sale->customer_name) }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700">Tanggal Penjualan</label>
                            <input type="date" name="sale_date" value="{{ old('sale_date', $sale->sale_date) }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700">Status Pembayaran</label>
                            <select name="payment_status" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Lunas" {{ $sale->payment_status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Kredit" {{ $sale->payment_status == 'Kredit' ? 'selected' : '' }}>Kredit</option>
                                <option value="DP" {{ $sale->payment_status == 'DP' ? 'selected' : '' }}>DP</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('sales.index') }}" class="text-gray-500 py-2 px-4">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-md shadow">
                            Update Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>