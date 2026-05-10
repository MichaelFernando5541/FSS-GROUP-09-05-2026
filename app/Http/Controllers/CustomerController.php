<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi data dari form (SUDAH DITAMBAHKAN NIK/NPWP)
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik_npwp' => 'nullable|string|max:50', // Nullable agar tidak wajib diisi
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string'
        ]);

        // 2. Simpan ke database
        \App\Models\Customer::create([
            'nama' => $request->nama,
            'nik_npwp' => $request->nik_npwp, // Menyimpan data NIK/NPWP
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        // 3. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Data pelanggan baru berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // PERBAIKAN: Menggunakan nama kolom bahasa Indonesia yang benar dan menambah NIK/NPWP
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik_npwp' => 'nullable|string|max:50',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $customer = \App\Models\Customer::findOrFail($id);
        
        // Update data pelanggan
        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Data Pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus dari sistem!');
    }
}