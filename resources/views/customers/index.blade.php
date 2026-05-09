<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Master Data: Daftar Pelanggan') }}
            </h2>
            <a href="{{ route('customers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                + Tambah Pelanggan
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
                                    <th class="py-4 px-6 font-semibold text-gray-600">Nama Pelanggan</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">No. Telepon / WA</th>
                                    <th class="py-4 px-6 font-semibold text-gray-600">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="py-4 px-6 font-bold text-blue-600">{{ $customer->name }}</td>
                                        <td class="py-4 px-6">{{ $customer->phone ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $customer->address ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-gray-500">
                                            Belum ada data pelanggan tetap. Klik "Tambah Pelanggan" untuk memulai!
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