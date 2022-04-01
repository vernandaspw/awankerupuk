<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\ProdukBrand;
use Illuminate\Http\Request;

class ProdukBrandController extends Controller
{
    public function index()
    {
        $datas = ProdukBrand::latest()->get();
        return view('pages.offices.produk-brand.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.offices.produk-brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'max:50|string',
        ]);
        $data =  ProdukBrand::create([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return redirect('office/produk-brand')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data =  ProdukBrand::findOrFail($id);
        return view('pages.offices.produk-brand.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'max:50|string',
        ]);
        $data = ProdukBrand::findOrFail($id)->update([
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
        $data = ProdukBrand::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
