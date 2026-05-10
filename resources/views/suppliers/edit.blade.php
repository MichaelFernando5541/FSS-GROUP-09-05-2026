<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Data Supplier') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Instansi / Supplier</label>
                        <input type="text" name="name" value="{{ $supplier->name }}" class="w-full border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">No. Telepon / WA</label>
                        <input type="text" name="phone" value="{{ $supplier->phone }}" class="w-full border-gray-300 rounded-md">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full border-gray-300 rounded-md">{{ $supplier->address }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('suppliers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>