<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;

class ProdukKategoriController extends Controller
{
    public function index()
    {
        $datas = ProdukKategori::latest()->get();
        return view('pages.offices.produk-kategori.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.offices.produk-kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'max:50|string',
        ]);
        $data =  ProdukKategori::create([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return redirect('office/produk-kategori')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data =  ProdukKategori::findOrFail($id);
        return view('pages.offices.produk-kategori.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'max:50|string',
        ]);
        $data = ProdukKategori::findOrFail($id)->update([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }


    public function destroy($id)
    {
        $data = ProdukKategori::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
