<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('Master-data.Produk.Produk', compact('produk'));
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
        return view('Master-data.Produk.edit', compact('produk', 'brands', 'departemens', 'kategoris', 'subkategoris'));
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