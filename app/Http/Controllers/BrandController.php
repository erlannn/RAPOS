<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return view('Master-data.Brand.index', compact('brand'));
    }

    public function create()
    {
        return view('Master-data.Brand.create');
    }

    public function store(Request $request)
    {
        try {
            Brand::create($request->all());
            return redirect()->route('brand.index')->with('success', 'Data berhasil ditambahkan!');
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
        $brand = Brand::findOrFail($id);
        return view('Master-data.Brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::findOrFail($id);
        $reqData = $request->except(['_token', '_method']);
        $brand->update($reqData);
            return redirect()->route('brand.index')->with('success', 'Data berhasil diperbarui!');
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
            Brand::destroy($id);
            return redirect()->route('brand.index')->with('success', 'Data berhasil dihapus!');
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