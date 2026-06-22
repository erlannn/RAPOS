<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PurchaseOrder::orderBy('created_at', 'desc')->paginate(15);
        return view('inventory.purchase_orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.purchase_orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:255|unique:purchase_orders,sku',
            'nama_produk' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'min' => 'required|integer|min:0',
            'max' => 'required|integer|min:0',
            'jumlah_beli' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'isi_kardus' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $validated['total_harga'] = $validated['jumlah_beli'] * $validated['harga_satuan'];

        PurchaseOrder::create($validated);

        return redirect()->route('purchase-order.index')->with('success', 'Purchase order created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('inventory.purchase_orders.edit', compact('purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:255|unique:purchase_orders,sku,' . $purchaseOrder->id,
            'nama_produk' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'min' => 'required|integer|min:0',
            'max' => 'required|integer|min:0',
            'jumlah_beli' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'isi_kardus' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $validated['total_harga'] = $validated['jumlah_beli'] * $validated['harga_satuan'];

        $purchaseOrder->update($validated);

        return redirect()->route('purchase-order.index')->with('success', 'Purchase order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-order.index')->with('success', 'Purchase order deleted successfully');
    }
}
?>
