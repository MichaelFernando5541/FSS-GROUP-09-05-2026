<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CV. Nusantara Motor</title>
        
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-hero {
                background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), 
                            url('{{ asset("images/hero-car.jpg") }}'); /* Masukkan gambar mobil sport di sini */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            .text-shadow-lg {
                text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body class="antialiased bg-black font-sans text-white">
        <div class="relative min-h-screen flex flex-col justify-center items-center bg-hero">
            
            <div class="absolute top-0 right-0 p-8">
                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-red-500 transition tracking-wider">Akses Masuk</a>
            </div>

            <div class="max-w-4xl mx-auto px-6 text-center">
                
                <div class="flex justify-center mb-6">
                    <div class="bg-red-600 p-4 rounded-2xl shadow-2xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-2 text-shadow-lg">
                    CV. Nusantara Motor
                </h1>
                <p class="text-sm md:text-lg font-semibold tracking-[0.3em] uppercase text-gray-300 mb-8">
                    Personal Management System
                </p>

                <p class="text-sm md:text-base leading-relaxed text-gray-200 max-w-3xl mx-auto mb-10 opacity-90">
                    Selamat datang di portal resmi <strong class="text-white">CV. Nusantara Motor</strong>. Sistem ini dirancang khusus untuk mengelola data mobil, inventaris mobil, transaksi main diversitas finansial (B/C & P+L) serta memantau performa bisnis showroom secara akurat dan real-time.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-black py-4 px-10 rounded-xl shadow-xl transition transform active:scale-95 uppercase text-sm tracking-widest">
                        Akses Masuk Sistem
                    </a>
                    <a href="#" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-bold py-4 px-10 rounded-xl transition uppercase text-sm tracking-widest">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="absolute bottom-0 w-full p-8 text-center">
                <p class="text-[10px] md:text-xs text-gray-400 font-medium tracking-wide uppercase">
                    © 2026 CV. Nusantara Motor. All rights reserved. | 
                    <span class="text-red-500">Dikembangkan oleh Development Team</span> dengan fitur terintegrasi 
                    <span class="text-white font-bold">FSS GRUP</span>
                </p>
            </div>

            <div class="absolute bottom-0 right-0 p-8">
                <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center border border-white/20 cursor-pointer hover:bg-white/30 transition">
                    <span class="font-bold text-gray-300">?</span>
                </div>
            </div>
        </div>
    </body>
</html>