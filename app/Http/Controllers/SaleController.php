<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        // Tarik data penjualan beserta data mobil yang terkait, urutkan dari yang terbaru
        $sales = \App\Models\Sale::with('car')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        // Ambil semua data pelanggan
        $customers = \App\Models\Customer::all();
        
        // HANYA ambil unit mobil yang belum laku
        $cars = \App\Models\Car::where('status', 'Tersedia')->get();
        
        // Buat nomor invoice otomatis
        $invoice_no = 'INV-' . date('Ymd') . '-' . rand(100, 999);

        return view('sales.create', compact('customers', 'cars', 'invoice_no'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'sale_date' => 'required|date',
            'car_id' => 'required|exists:cars,id',
            'total_amount' => 'required|numeric',
            'payment_status' => 'required'
        ]);

        // 2. Simpan Data ke Database
        $sale = new \App\Models\Sale();
        $sale->invoice_no = $request->invoice_no ?? ('INV-' . date('Ymd') . '-' . rand(100, 999));
        $sale->sale_date = $request->sale_date;
        $sale->customer_id = $request->customer_id; 
        $sale->car_id = $request->car_id;
        $sale->total_amount = $request->total_amount; 
        $sale->payment_status = $request->payment_status;

        // PERBAIKAN 1: Tangkap input nama pelanggan manual jika dipilih
        if ($request->filled('new_customer_name')) {
            $sale->customer_name = $request->new_customer_name;
        }

        // PERBAIKAN 2: Mengisi kolom sales_name agar tidak error 1364
        // Mengambil nama akun admin/kasir yang sedang login untuk dicatat
        if (Auth::check()) {
            $sale->sales_name = Auth::user()->name;
        } else {
            $sale->sales_name = 'Admin System';
        }

        $sale->save();

        // 3. Ubah status mobil menjadi "Terjual"
        $car = \App\Models\Car::find($request->car_id);
        if($car) {
            $car->status = 'Terjual';
            $car->save();
        }

        return redirect()->route('sales.index')->with('success', 'Unit Terjual! Transaksi berhasil dicatat.');
    }

    public function show(string $id)
    {
        //
    }

    // Menampilkan halaman edit transaksi
    public function edit($id)
    {
        $sale = \App\Models\Sale::findOrFail($id);
        return view('sales.edit', compact('sale'));
    }

    // Menyimpan perubahan transaksi
    public function update(Request $request, $id)
    {
        $sale = \App\Models\Sale::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'payment_status' => 'required|in:Lunas,Kredit,DP',
        ]);

        $sale->update([
            'customer_name' => $request->customer_name,
            'sale_date' => $request->sale_date,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('sales.index')->with('success', 'Data transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sale = \App\Models\Sale::findOrFail($id);
        
        // Ambil data mobil yang terkait dengan transaksi ini
        $car = \App\Models\Car::find($sale->car_id);
        
        if ($car) {
            // Kembalikan status mobil menjadi Tersedia karena transaksi dibatalkan
            $car->update(['status' => 'Tersedia']);
        }

        // Hapus data transaksi
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus dan unit mobil telah dikembalikan ke stok tersedia.');
    }

    // Menampilkan & mencetak Nota Digital
    public function print($id)
    {
        // Tarik data transaksi berdasarkan ID beserta relasi mobilnya
        $sale = \App\Models\Sale::with('car')->findOrFail($id);
        
        return view('sales.print', compact('sale'));
    }
}