<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Menampilkan halaman Split-Pane
    public function index(Request $request)
    {
        $cars = Car::latest()->get(); // Ambil semua mobil
        
        // Cek apakah ada mobil yang diklik untuk dilihat detailnya di panel kanan
        $selectedCar = null;
        if ($request->has('show')) {
            $selectedCar = Car::find($request->show);
        } elseif ($cars->count() > 0) {
            $selectedCar = $cars->first(); // Default tampilkan mobil pertama
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
        $validated['status'] = 'Tersedia'; // Default saat baru ditambah [cite: 241]

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
}