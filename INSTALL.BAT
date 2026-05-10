@echo off
title PIMS Enterprise - Manager
setlocal enabledelayedexpansion

echo ===================================================
echo    PIMS SYSTEM - AUTOMATED MANAGER
echo ===================================================
echo.

:: --- BAGIAN 1: SETUP AWAL (Hanya jalan jika baru di-clone) ---

:: 1. Cek .env
if not exist .env (
    echo [STEP 1] Menyalin file .env...
    copy .env.example .env
    echo File .env berhasil dibuat.
)

:: 2. Install Backend (Composer)
if not exist vendor (
    echo [STEP 2] Mengunduh Library Backend (Composer)...
    call composer install --ignore-platform-reqs
    if !errorlevel! neq 0 (
        echo [WARNING] Install gagal. Mencoba update...
        call composer update --ignore-platform-reqs
    )
    echo.
    echo [STEP 3] Membuat Application Key...
    call php artisan key:generate
)

:: 3. Install Frontend (NPM)
if not exist node_modules (
    echo [STEP 4] Mengunduh Library Frontend (NPM)...
    call npm install
    echo [STEP 5] Mengompilasi Desain Tailwind CSS...
    call npm run build
)

:: --- BAGIAN 2: PERBAIKAN ERROR & MAINTENANCE ---

echo.
echo [INFO] Optimalisasi Sistem...
:: Membersihkan cache untuk mencegah error 'package:discover'
call php artisan config:clear
call php artisan cache:clear
call php artisan view:clear

:: --- BAGIAN 3: MENJALANKAN APLIKASI ---

echo.
echo ---------------------------------------------------
echo  SISTEM SIAP! JANGAN TUTUP JENDELA INI.
echo ---------------------------------------------------
echo.

:: Membuka Browser otomatis ke alamat lokal
start http://127.0.0.1:8000

:: Menjalankan server Laravel
php artisan serve

pause