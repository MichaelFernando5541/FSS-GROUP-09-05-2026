@echo off
title PIMS - First Time Setup
echo ===================================================
echo   PIMS SYSTEM - INITIAL INSTALLATION
echo ===================================================
echo.

:: 1. Cek keberadaan file .env
if not exist .env (
    echo [STEP 1] Menyalin file .env...
    copy .env.example .env
    echo File .env berhasil dibuat.
) else (
    echo [STEP 1] File .env sudah ada, melewati langkah ini.
)

:: 2. Install Library PHP (Composer)
echo.
echo [STEP 2] Mengunduh Library Backend (Composer)...
call composer install

:: 3. Install Library Frontend (NPM)
echo.
echo [STEP 3] Mengunduh Library Frontend (NPM)...
call npm install

:: 4. Generate Key Laravel
echo.
echo [STEP 4] Membuat Application Key...
call php artisan key:generate

:: 5. Build Aset Frontend
echo.
echo [STEP 5] Mengompilasi Desain Tailwind CSS...
call npm run build

echo.
echo ===================================================
echo   PROSES SELESAI! 
echo ===================================================
echo Silakan atur database di file .env, lalu jalankan:
echo "php artisan migrate" untuk membuat tabel.
echo.
pause