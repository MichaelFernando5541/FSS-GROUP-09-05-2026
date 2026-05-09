<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Master Data: Daftar Item') }}
            </h2>
            <a href="{{ route('items.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                + Tambah Item
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="py-4 px-6 font-semibold text-gray-600">Nama Item</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">Modal (Rp)</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">Harga Jual (Rp)</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">Stok</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="py-4 px-6">{{ $item->name }}</td>
                                        <td class="py-4 px-6">{{ number_format($item->modal, 0, ',', '.') }}</td>
                                        <td class="py-4 px-6">{{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="py-4 px-6">
                                            <span class="px-2 py-1 text-sm rounded font-bold {{ $item->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $item->stock }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="text-gray-400 italic text-sm">Edit | Hapus</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500">
                                            Belum ada item yang terdaftar. Klik "Tambah Item" untuk memulai!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>