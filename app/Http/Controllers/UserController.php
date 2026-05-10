<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Menampilkan Halaman Manajemen Akun
    public function index()
    {
        // Ambil semua user kecuali diri sendiri agar tidak tidak sengaja terhapus
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    // 2. Menyimpan Akun Baru (Admin/Kasir)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed', // Pastikan input password_confirmation ada di form
            'role' => 'required|in:admin,kasir',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun baru berhasil didaftarkan ke sistem!');
    }

    // 3. Menghapus Akun (Opsi Tambahan)
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun telah berhasil dihapus.');
    }
}