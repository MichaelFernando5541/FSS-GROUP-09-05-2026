<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
public function index(Request $request)
{
    // 1. Panggil Model Transaksi Anda (Pastikan namanya sesuai, misal: Sale atau Transaksi)
    // Pastikan juga menambahkan relasi ke mobil jika ada, misal: with('car')
    $query = \App\Models\Sale::query(); 

    // =========================================================================
    // ⚠️ PENTING: Ganti 'created_at' dengan nama kolom tanggal di database Anda.
    // Jika di tabel Anda namanya 'tanggal', 'sale_date', atau 'tgl_transaksi', 
    // ubah kata 'created_at' di bawah ini menjadi nama kolom tersebut!
    // =========================================================================
    $kolomTanggal = 'created_at'; 

    // 2. Filter dari tanggal (Start Date)
    if ($request->filled('start_date')) {
        $query->whereDate($kolomTanggal, '>=', $request->start_date);
    }

    // 3. Filter sampai tanggal (End Date)
    if ($request->filled('end_date')) {
        $query->whereDate($kolomTanggal, '<=', $request->end_date);
    }

    // 4. Eksekusi query dan ambil datanya
    $sales = $query->get();

    // 5. Lempar variabel $sales ke tampilan (View)
    return view('reports.index', compact('sales'));
}
    public function print(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $sales = Sale::with('car')->whereBetween('sale_date', [$startDate, $endDate])->get();
        $totalRevenue = $sales->sum('total_amount');
        $totalTax = $sales->sum('tax_amount');
        $totalROI = $sales->sum('roi_amount');

        return view('reports.print', compact('sales', 'startDate', 'endDate', 'totalRevenue', 'totalTax', 'totalROI'));
    }
}