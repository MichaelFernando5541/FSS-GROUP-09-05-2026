<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Master Data: Daftar Supplier') }}
            </h2>
            <a href="{{ route('suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                + Tambah Supplier
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
                                    <th class="py-4 px-6 font-semibold text-gray-600">Nama Supplier</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">No. Telepon</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="py-4 px-6 font-bold">{{ $supplier->name }}</td>
                                        <td class="py-4 px-6">{{ $supplier->phone ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $supplier->address ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-gray-500">
                                            Belum ada data supplier. Klik "Tambah Supplier" untuk memulai!
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