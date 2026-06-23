<?php

namespace App\Http\Controllers;

use App\Models\Inventori;
use Illuminate\Http\Request;

class InventoriController extends Controller
{
    public function index()
    {
        $inventori = Inventori::all();
        return view('Master-data.Inventori.index', compact('inventori'));
    }

    public function create()
    {
        return view('Master-data.Inventori.create');
    }

    public function store(Request $request)
    {
        try {
            Inventori::create($request->all());
            return redirect()->route('inventori.index')->with('success', 'Data berhasil ditambahkan!');
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
        $inventori = Inventori::findOrFail($id);
        return view('Master-data.Inventori.edit', compact('inventori'));
    }

    public function update(Request $request, $id)
    {
        try {
            $inventori = Inventori::findOrFail($id);
        $reqData = $request->except(['_token', '_method']);
        $inventori->update($reqData);
            return redirect()->route('inventori.index')->with('success', 'Data berhasil diperbarui!');
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
            Inventori::destroy($id);
            return redirect()->route('inventori.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return back()->with('error', 'Gagal! Data ini tidak bisa dihapus karena sedang digunakan oleh tabel lain.');
            }
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function stock(Request $request)
    {
        $store_id = $request->input('store_id');
        $stores = \App\Models\Store::all();

        $barangMasuk = \App\Models\MutasiStok::with(['produk', 'store'])->where('Qty', '>', 0)->orderBy('CreatedAt', 'desc')->get();
        $barangKeluar = \App\Models\MutasiStok::with(['produk', 'store'])->where('Qty', '<', 0)->orderBy('CreatedAt', 'desc')->get();

        if ($store_id) {
            $inventoris = \App\Models\Inventori::with(['produk', 'store'])->where('StoreID', $store_id)->get();
            $isAllStores = false;
        } else {
            $inventoris = \App\Models\Inventori::with(['produk'])
                ->selectRaw('ProdukID, SUM(StokSaatIni) as TotalStok, MAX(MinimumStok) as MinStok')
                ->groupBy('ProdukID')
                ->get();
            
            // Map the aggregated data to match the expected format somewhat
            $inventoris->transform(function($inv) {
                $inv->StokSaatIni = $inv->TotalStok;
                $inv->MinimumStok = $inv->MinStok;
                return $inv;
            });
            $isAllStores = true;
        }

        return view('inventory.stock', compact('inventoris', 'barangMasuk', 'barangKeluar', 'stores', 'store_id', 'isAllStores'));
    }
}