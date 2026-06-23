<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Produk;
use App\Models\Supplier;
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
        $produks = Produk::where('StatusAktif', 1)->get();
        $suppliers = Supplier::where('StatusAktif', 1)->get();
        return view('inventory.purchase_orders.create', compact('produks', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ProdukID' => 'required|exists:produk,ProdukID',
            'SupplierID' => 'required|exists:supplier,SupplierID',
            'jumlah_beli' => 'required|integer|min:1',
            'isi_kardus' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        PurchaseOrder::create([
            'ProdukID' => $validated['ProdukID'],
            'SupplierID' => $validated['SupplierID'],
            'JumlahBeli' => $validated['jumlah_beli'],
            'IsiKardus' => $validated['isi_kardus'],
            'HargaSatuan' => $validated['harga_satuan'],
            'TotalHarga' => $validated['jumlah_beli'] * $validated['harga_satuan'],
            'Status' => 'Pending',
        ]);

        return redirect()->route('purchase-order.index')->with('success', 'Purchase order created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $produks = Produk::where('StatusAktif', 1)->get();
        $suppliers = Supplier::where('StatusAktif', 1)->get();
        return view('inventory.purchase_orders.edit', compact('purchaseOrder', 'produks', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'ProdukID' => 'required|exists:produk,ProdukID',
            'SupplierID' => 'required|exists:supplier,SupplierID',
            'jumlah_beli' => 'required|integer|min:1',
            'isi_kardus' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $purchaseOrder->update([
            'ProdukID' => $validated['ProdukID'],
            'SupplierID' => $validated['SupplierID'],
            'JumlahBeli' => $validated['jumlah_beli'],
            'IsiKardus' => $validated['isi_kardus'],
            'HargaSatuan' => $validated['harga_satuan'],
            'TotalHarga' => $validated['jumlah_beli'] * $validated['harga_satuan'],
        ]);

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

    public function incoming()
    {
        $pendingPOs = PurchaseOrder::with(['produk', 'supplier'])->where('Status', 'Pending')->get();
        return view('inventory.incoming', compact('pendingPOs'));
    }

    public function receive(Request $request, $id)
    {
        $request->validate([
            'jumlah_diterima' => 'required|integer|min:1'
        ]);

        $po = PurchaseOrder::findOrFail($id);
        
        if ($po->Status !== 'Pending') {
            return redirect()->back()->with('error', 'PO sudah diproses.');
        }

        // Toko Pusat StoreID = 1 (assuming ST001 has ID 1, we should fetch it)
        $tokoPusat = \App\Models\Store::where('KodeStore', 'ST001')->first();
        if (!$tokoPusat) {
            return redirect()->back()->with('error', 'Toko Pusat (ST001) tidak ditemukan.');
        }

        // Add to Inventori
        $inventori = \App\Models\Inventori::firstOrNew([
            'ProdukID' => $po->ProdukID,
            'StoreID' => $tokoPusat->StoreID
        ]);

        $saldoSebelum = $inventori->StokSaatIni ?? 0;
        $inventori->StokSaatIni = $saldoSebelum + $request->jumlah_diterima;
        // set MinStok and Harga from Produk/PO
        $inventori->MinimumStok = $po->produk->MinStok ?? 0;
        $inventori->HargaBeliTerakhir = $po->HargaSatuan;
        // HargaJual bisa diset 0 dulu atau biarkan
        if (!$inventori->exists) {
            $inventori->HargaJual = 0;
            $inventori->CreatedAt = now();
        }
        $inventori->UpdatedAt = now();
        $inventori->save();

        // Add to MutasiStok
        \App\Models\MutasiStok::create([
            'Tanggal' => now()->toDateString(),
            'ProdukID' => $po->ProdukID,
            'StoreID' => $tokoPusat->StoreID,
            'JenisMutasi' => 1, // 1 = Barang Masuk
            'ReferensiTabel' => 'purchase_orders',
            'ReferensiID' => $po->id,
            'Qty' => $request->jumlah_diterima,
            'SaldoSebelum' => $saldoSebelum,
            'SaldoSesudah' => $inventori->StokSaatIni,
            'Keterangan' => 'Penerimaan PO',
            'UserID' => auth()->id() ?? 1,
            'CreatedAt' => now()
        ]);

        // Update PO
        $po->Status = 'Diterima';
        $po->save();

        return redirect()->route('inventory.incoming')->with('success', 'Barang berhasil diterima.');
    }
}
?>
