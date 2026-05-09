<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Faktur Pembelian') }}
            </h2>
            <a href="{{ route('purchases.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                + Nota Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Halaman riwayat nota akan kita desain nanti. Silakan klik tombol "Nota Baru" di pojok kanan atas!</p>
            </div>
        </div>
    </div>
</x-app-layout>