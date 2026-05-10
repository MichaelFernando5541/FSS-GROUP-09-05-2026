@echo off
title PIMS Enterprise - Auto Installer & Server
cd /d "%~dp0"

echo ===================================================
echo    PIMS SYSTEM - AUTOMATED INSTALLER
echo ===================================================
echo.

:: --- STEP 1: COMPOSER (BACKEND) ---
if not exist vendor (
    echo [!] Folder VENDOR tidak ditemukan.
    echo [INFO] Menjalankan Composer Install...
    echo Harap tunggu, ini mungkin memakan waktu beberapa menit...
    call composer install --ignore-platform-reqs
    
    if %errorlevel% neq 0 (
        echo [WARNING] Install gagal, mencoba Composer Update...
        call composer update --ignore-platform-reqs
    )
) else (
    echo [OK] Backend Library sudah terpasang.
)

:: --- STEP 2: NPM (FRONTEND) ---
if not exist node_modules (
    echo.
    echo [!] Folder NODE_MODULES tidak ditemukan.
    echo [INFO] Menjalankan NPM Install...
    call npm install
    
    echo.
    echo [INFO] Mengompilasi aset visual (Building)...
    call npm run build
) else (
    echo [OK] Frontend Library sudah terpasang.
)

:: --- STEP 3: LARAVEL PREPARATION ---
echo.
echo [INFO] Menyiapkan Aplikasi...

if not exist .env (
    copy .env.example .env
    call php artisan key:generate
)

:: Membersihkan cache agar tidak error
call php artisan config:clear
call php artisan cache:clear

:: --- STEP 4: RUN SERVER ---
echo.
echo ---------------------------------------------------
echo  SISTEM SIAP! JANGAN TUTUP JENDELA INI.
echo ---------------------------------------------------
echo.

:: Buka browser otomatis
start http://127.0.0.1:8000

:: Nyalakan server
php artisan serve

pause