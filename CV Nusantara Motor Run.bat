@echo off
title PIMS - System Starter
echo ---------------------------------------------------
echo SEDANG MENGHIDUPKAN SISTEM SHOWROOM...
echo ---------------------------------------------------

:: 1. Masuk ke folder project (GANTI PATH DI BAWAH INI)
cd /d "D:\TUGASAKHIRRPL\APLIKASI_PEMBUKUAN_DAN_PENOTAAN_FSS_GROUP"

:: 2. Cek apakah file artisan ada untuk memastikan path benar
if not exist artisan (
    echo [ERROR] Folder project tidak ditemukan! 
    echo Periksa kembali alamat folder di file .bat ini.
    pause
    exit
)

:: 3. Jalankan browser
echo Membuka Google Chrome...
start http://127.0.0.1:8000

:: 4. Jalankan server Laravel
echo Server sedang berjalan...
php artisan serve

pause