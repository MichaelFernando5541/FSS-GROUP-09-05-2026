<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        // Menampilkan daftar history nota (kita buat tampilannya nanti)
        $purchases = Purchase::all();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        // Mengambil data Supplier dan Item untuk dimasukkan ke dalam Dropdown pilihan
        $suppliers = Supplier::all();
        $items = Item::all();
        return view('purchases.create', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        // 1. Simpan Kepala Nota dulu
        $purchase = Purchase::create([
            'faktur_no' => $request->faktur_no,
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'total_amount' => 0, // Kita set 0 dulu, nanti dihitung otomatis
        ]);

        $grandTotal = 0;

        // 2. Looping semua barang yang diinput dari form dinamis
        foreach ($request->items as $row) {
            $subtotal = $row['qty'] * $row['modal'];
            $grandTotal += $subtotal;

            // Simpan detail barang ke nota
            PurchaseDetail::create([
                'purchase_id' => $purchase->id,
                'item_id' => $row['item_id'],
                'qty' => $row['qty'],
                'modal' => $row['modal'],
                'subtotal' => $subtotal,
            ]);

            // 3. KEAJAIBAN: Tambah stok master otomatis!
            $masterItem = Item::find($row['item_id']);
            $masterItem->stock += $row['qty'];
            $masterItem->save();
        }

        // 4. Update total harga di kepala nota
        $purchase->update(['total_amount' => $grandTotal]);

        return redirect()->route('items.index'); // Lempar kembali ke halaman item untuk melihat stok bertambah!
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
