<?php

namespace App\Http\Controllers;

use App\Models\MutasiStok;
use Illuminate\Http\Request;

class MutasiStokController extends Controller
{
    public function index()
    {
        $mutasistok = MutasiStok::all();
        return view('Master-data.MutasiStok.index', compact('mutasistok'));
    }

    public function create()
    {
        return view('Master-data.MutasiStok.create');
    }

    public function store(Request $request)
    {
        try {
            MutasiStok::create($request->all());
            return redirect()->route('mutasistok.index')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('error', 'Gagal! Terdapat duplikat data (ID atau data unik sudah ada).')->withInput();
            }
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $mutasistok = MutasiStok::findOrFail($id);
        return view('Master-data.MutasiStok.edit', compact('mutasistok'));
    }

    public function update(Request $request, $id)
    {
        try {
            $mutasistok = MutasiStok::findOrFail($id);
        $reqData = $request->except(['_token', '_method']);
        $mutasistok->update($reqData);
            return redirect()->route('mutasistok.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('error', 'Gagal! Terdapat duplikat data (ID atau data unik sudah ada).')->withInput();
            }
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            MutasiStok::destroy($id);
            return redirect()->route('mutasistok.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return back()->with('error', 'Gagal! Data ini tidak bisa dihapus karena sedang digunakan oleh tabel lain.');
            }
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function outgoing()
    {
        // Get Inventori items in Toko Pusat that have stock > 0
        $tokoPusat = \App\Models\Store::where('KodeStore', 'ST001')->first();
        if (!$tokoPusat) {
            return back()->with('error', 'Toko Pusat (ST001) tidak ditemukan.');
        }

        $inventoris = \App\Models\Inventori::with('produk')->where('StoreID', $tokoPusat->StoreID)->where('StokSaatIni', '>', 0)->get();
        $stores = \App\Models\Store::where('StoreID', '!=', $tokoPusat->StoreID)->get();

        return view('inventory.outgoing', compact('inventoris', 'stores'));
    }

    public function processOutgoing(Request $request)
    {
        $request->validate([
            'InventoriID' => 'required|exists:inventori,InventoriID',
            'TujuanStoreID' => 'required|exists:store,StoreID',
            'qty' => 'required|integer|min:1'
        ]);

        $inventoriAsal = \App\Models\Inventori::findOrFail($request->InventoriID);
        
        if ($inventoriAsal->StokSaatIni < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Deduct from Toko Pusat
        $saldoSebelumPusat = $inventoriAsal->StokSaatIni;
        $inventoriAsal->StokSaatIni -= $request->qty;
        $inventoriAsal->UpdatedAt = now();
        $inventoriAsal->save();

        // Log Mutasi Keluar dari Pusat (3 = Perpindahan Stok)
        \App\Models\MutasiStok::create([
            'Tanggal' => now()->toDateString(),
            'ProdukID' => $inventoriAsal->ProdukID,
            'StoreID' => $inventoriAsal->StoreID,
            'JenisMutasi' => 3, // Perpindahan Stok (Keluar)
            'ReferensiTabel' => 'store',
            'ReferensiID' => $request->TujuanStoreID,
            'Qty' => -$request->qty,
            'SaldoSebelum' => $saldoSebelumPusat,
            'SaldoSesudah' => $inventoriAsal->StokSaatIni,
            'Keterangan' => 'Mutasi Keluar ke Store ID: ' . $request->TujuanStoreID,
            'UserID' => auth()->id() ?? 1,
            'CreatedAt' => now()
        ]);

        // Add to Destination Store
        $inventoriTujuan = \App\Models\Inventori::firstOrNew([
            'ProdukID' => $inventoriAsal->ProdukID,
            'StoreID' => $request->TujuanStoreID
        ]);

        $saldoSebelumTujuan = $inventoriTujuan->StokSaatIni ?? 0;
        $inventoriTujuan->StokSaatIni = $saldoSebelumTujuan + $request->qty;
        $inventoriTujuan->MinimumStok = $inventoriAsal->MinimumStok;
        $inventoriTujuan->HargaBeliTerakhir = $inventoriAsal->HargaBeliTerakhir;
        
        if (!$inventoriTujuan->exists) {
            $inventoriTujuan->HargaJual = $inventoriAsal->HargaJual;
            $inventoriTujuan->CreatedAt = now();
        }
        $inventoriTujuan->UpdatedAt = now();
        $inventoriTujuan->save();

        // Log Mutasi Masuk ke Tujuan
        \App\Models\MutasiStok::create([
            'Tanggal' => now()->toDateString(),
            'ProdukID' => $inventoriAsal->ProdukID,
            'StoreID' => $request->TujuanStoreID,
            'JenisMutasi' => 3, // Perpindahan Stok (Masuk)
            'ReferensiTabel' => 'store',
            'ReferensiID' => $inventoriAsal->StoreID,
            'Qty' => $request->qty,
            'SaldoSebelum' => $saldoSebelumTujuan,
            'SaldoSesudah' => $inventoriTujuan->StokSaatIni,
            'Keterangan' => 'Mutasi Masuk dari Toko Pusat',
            'UserID' => auth()->id() ?? 1,
            'CreatedAt' => now()
        ]);

        return redirect()->route('inventory.outgoing')->with('success', 'Mutasi stok berhasil diproses.');
    }
}