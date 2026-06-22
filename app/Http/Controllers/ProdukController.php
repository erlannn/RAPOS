<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $stores = \App\Models\Store::all();
        $departemens = \App\Models\Departemen::all();
        $subkategoris = \App\Models\SubKategori::with('kategori')->get();

        $toko_id = $request->input('toko_id');
        $departemen_id = $request->input('departemen_id');
        $subkategori_id = $request->input('subkategori_id');
        $search = $request->input('search');

        $query = Produk::query();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('NamaProduk', 'like', "%{$search}%")
                  ->orWhere('Barcode', 'like', "%{$search}%")
                  ->orWhere('SKU', 'like', "%{$search}%");
            });
        }

        if (!empty($departemen_id)) {
            $query->whereHas('kategori', function($q) use ($departemen_id) {
                $q->where('DepartemenID', $departemen_id);
            });
        }

        if (!empty($subkategori_id)) {
            $query->where('SubKategoriID', $subkategori_id);
        }

        if (!empty($toko_id)) {
            $query->whereHas('inventori', function($q) use ($toko_id) {
                $q->where('StoreID', $toko_id);
            });
        }

        $query->with(['kategori.departemen', 'subKategori', 'inventori' => function($q) use ($toko_id) {
            if (!empty($toko_id)) {
                $q->where('StoreID', $toko_id);
            }
        }]);

        $produk = $query->get();

        return view('Master-data.Produk.Produk', compact(
            'produk', 
            'stores', 
            'departemens', 
            'subkategoris', 
            'toko_id', 
            'departemen_id', 
            'subkategori_id', 
            'search'
        ));
    }

    public function create()
    {
        $brands = \App\Models\Brand::all();
        $departemens = \App\Models\Departemen::all();
        $kategoris = \App\Models\Kategori::all();
        $subkategoris = \App\Models\SubKategori::all();
        return view('Master-data.Produk.create', compact('brands', 'departemens', 'kategoris', 'subkategoris'));
    }

    public function store(Request $request)
    {
        try {
            Produk::create($request->all());
            return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan!');
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
        $produk = Produk::findOrFail($id);
        $brands = \App\Models\Brand::all();
        $departemens = \App\Models\Departemen::all();
        $kategoris = \App\Models\Kategori::all();
        $subkategoris = \App\Models\SubKategori::all();
        return view('Master-data.Produk.Edit', compact('produk', 'brands', 'departemens', 'kategoris', 'subkategoris'));
    }

    public function update(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);
        $reqData = $request->except(['_token', '_method']);
        $produk->update($reqData);
            return redirect()->route('produk.index')->with('success', 'Data berhasil diperbarui!');
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
            Produk::destroy($id);
            return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return back()->with('error', 'Gagal! Data ini tidak bisa dihapus karena sedang digunakan oleh tabel lain.');
            }
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}