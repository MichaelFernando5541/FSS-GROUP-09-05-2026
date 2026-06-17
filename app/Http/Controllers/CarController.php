<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Menampilkan halaman Split-Pane
public function index(Request $request)
{
    // Mulai query ke model Car
    $query = \App\Models\Car::query();

    // Jika ada inputan pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        
        // GANTI 'plat_nomor' MENJADI 'nopol' DI SINI
        $query->where('merk', 'like', "%{$search}%")
              ->orWhere('tipe', 'like', "%{$search}%")
              ->orWhere('nopol', 'like', "%{$search}%");
    }

    // Ambil data terbaru
    $cars = $query->latest()->get();

    // Pastikan variabel $selectedCar aman (untuk split-screen)
    $selectedCar = null;
    
    // Jika ada parameter 'show' di URL, ambil data mobil tersebut
    if ($request->filled('show')) {
        $selectedCar = \App\Models\Car::find($request->show);
    }

    return view('cars.index', compact('cars', 'selectedCar'));
}

    // Menampilkan form tambah mobil baru
    public function create()
    {
        return view('cars.create');
    }

    // Menyimpan mobil baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|unique:cars',
            'no_rangka' => 'required|unique:cars',
            'no_mesin' => 'required|unique:cars',
            'merk' => 'required|string',
            'tipe' => 'required|string',
            'tahun' => 'required|integer',
            'kondisi' => 'required|string',
            'harga_beli' => 'required|numeric',
            'biaya_operasional' => 'nullable|numeric',
        ]);

        $validated['biaya_operasional'] = $validated['biaya_operasional'] ?? 0;
        $validated['status'] = 'Tersedia'; // Default saat baru ditambah

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Unit mobil berhasil didaftarkan ke showroom!');
    }

    // Menghapus mobil dari database
    public function destroy(Car $car)
    {
        if ($car->status === 'Terjual') {
            // Mengirimkan flash message dengan key 'error'
            return redirect()->route('cars.index')->with('error', 'Unit ini sudah terjual! Hapus transaksi penjualannya terlebih dahulu jika ingin menghapus unit ini dari inventori.');
        }

        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Unit berhasil dihapus.');
    }

    public function edit($id)
    {
        // Menarik data mobil yang mau diedit
        $car = \App\Models\Car::findOrFail($id);
        
        // PENGAMANAN: Blokir akses jika status mobil sudah Terjual
        if ($car->status === 'Terjual') {
            return redirect()->route('cars.index')
                ->with('error', 'Akses ditolak! Data unit yang sudah terjual telah dikunci oleh sistem untuk menjaga integritas laporan.');
        }
        
        // Melempar data ke halaman view edit yang baru kita buat
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = \App\Models\Car::findOrFail($id);

        // PENGAMANAN GANDA: Tolak penyimpanan jika status mobil sudah Terjual
        // (Berjaga-jaga jika ada yang mencoba bypass (melewati) tampilan)
        if ($car->status === 'Terjual') {
            return redirect()->route('cars.index')
                ->with('error', 'Update ditolak! Data unit yang sudah terjual telah dikunci oleh sistem.');
        }

        // Validasi input
        $request->validate([
            'merk' => 'required|string',
            'tipe' => 'required|string',
            'tahun' => 'required|numeric',
            'kondisi' => 'required|string',
            'nopol' => 'required|string',
            'no_rangka' => 'required|string',
            'no_mesin' => 'required|string',
            'harga_beli' => 'required|numeric',
            'biaya_operasional' => 'required|numeric',
        ]);

        // Temukan dan update data di database
        $car->update($request->all());

        // Kembali ke halaman stok dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Data unit mobil berhasil diperbarui!');
    }
}