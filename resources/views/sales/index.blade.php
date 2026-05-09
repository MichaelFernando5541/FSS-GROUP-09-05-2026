<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Pesanan') }}
            </h2>
            <a href="{{ route('sales.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                + Pesanan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Halaman riwayat pesanan akan kita desain nanti. Silakan klik tombol "Pesanan Baru" di pojok kanan atas!</p>
            </div>
        </div>
    </div>
</x-app-layout> 