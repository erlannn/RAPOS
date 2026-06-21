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
}