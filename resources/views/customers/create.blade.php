<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pelanggan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Pelanggan / Instansi</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">No. Telepon / WA</label>
                        <input type="text" name="phone" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Pelanggan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>