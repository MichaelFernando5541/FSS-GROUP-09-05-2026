<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV. Nusantara Motor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />
</head>
<body class="font-sans antialiased bg-[#F8FAFC]">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-100 hidden md:flex flex-col sticky top-0 h-screen">
            <div class="p-6 flex items-center gap-3">
                <div class="bg-black p-1.5 rounded-xl shadow-lg shadow-black/20">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <h1 class="text-[11px] font-black text-gray-800 leading-none uppercase tracking-tighter">CV. Nusantara</h1>
                    <p class="text-[10px] text-gray-400 font-bold tracking-[0.2em] uppercase mt-0.5">Motor</p>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1.5 mt-4">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="dashboard">Dashboard</x-sidebar-link>
                
                @if(Auth::user()->role == 'admin')
                    <div class="pt-4 pb-2 px-4">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Master Data</p>
                    </div>
                    <x-sidebar-link :href="route('cars.index')" :active="request()->routeIs('cars.*')" icon="car">Daftar Mobil</x-sidebar-link>
                    <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" icon="chart">Keuangan & ROI</x-sidebar-link>
                    <x-sidebar-link :href="route('users.index')" :active="request()->routeIs('users.*')" icon="users">Manajemen Akun</x-sidebar-link>
                @endif

                <div class="pt-4 pb-2 px-4">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Operasional</p>
                </div>
                <x-sidebar-link :href="route('sales.index')" :active="request()->routeIs('sales.*')" icon="cart">Transaksi Penjualan</x-sidebar-link>
                <x-sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" icon="user-group">Pelanggan</x-sidebar-link>
            </nav>

            <div class="p-4 border-t border-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col">
            <header class="bg-white/80 backdrop-blur-md sticky top-0 z-30 border-b border-gray-100 px-8 py-4 flex justify-between items-center">
                <div class="flex flex-col">
                    @if (isset($header)) 
                        {{ $header }} 
                    @endif
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                        <p class="text-sm font-black text-gray-800 leading-none mt-1">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
                        <span class="text-white text-xs font-black uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
            </header>

            <div class="p-8 flex-1">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center gap-3 animate-fade-in">
                        <span class="text-green-600">✅</span>
                        <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3 animate-shake">
                        <span class="text-red-600">🚫</span>
                        <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
                    </div>
                @endif

                {{ $slot }}
            </div>