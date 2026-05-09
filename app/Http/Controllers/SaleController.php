<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.create', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        // 1. Simpan Kepala Invoice
        $sale = Sale::create([
            'invoice_no' => $request->invoice_no,
            'customer_id' => $request->customer_id, 
            'customer_name' => $request->customer_name, 
            'sales_name' => $request->sales_name,
            'sale_date' => $request->sale_date,
            'payment_status' => $request->payment_status,
            'total_amount' => 0, // Akan dihitung otomatis di bawah
        ]);

        $grandTotal = 0;

        // 2. Looping semua barang yang dijual
        foreach ($request->items as $row) {
            $subtotal = $row['qty'] * $row['price'];
            $grandTotal += $subtotal;

            // Simpan detail barang ke invoice
            SaleDetail::create([
                'sale_id' => $sale->id,
                'item_id' => $row['item_id'],
                'qty' => $row['qty'],
                'price' => $row['price'],
                'subtotal' => $subtotal,
            ]);

            // 3. KEAJAIBAN: Kurangi stok master otomatis!
            $masterItem = Item::find($row['item_id']);
            $masterItem->stock -= $row['qty']; // Perhatikan tanda minus (-) ini
            $masterItem->save();
        }

        // 4. Update total harga di kepala invoice
        $sale->update(['total_amount' => $grandTotal]);

        return redirect()->route('items.index'); // Kembali ke halaman item untuk melihat stok berkurang
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
