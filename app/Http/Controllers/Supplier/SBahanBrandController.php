<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\bahan_brands;
use Illuminate\Http\Request;

class SBahanBrandController extends Controller
{
    public function index()
    {
        $auth = auth('supplier')->user()->id;
        $datas = bahan_brands::latest()->where('supplier_id', $auth)->get();
        return view('pages.suppliers.bahan-brand.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.suppliers.bahan-brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'max:30',
        ]);
        $auth = auth('supplier')->user()->id;
        $data =  bahan_brands::create([
            'supplier_id' => $auth,
            'nama' => $request->nama,
        ]);
        if ($data) {
            return redirect('supplier/bahan-brand')->with('success', 'Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data =  bahan_brands::findOrFail($id);
        return view('pages.suppliers.bahan-brand.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'max:30|string',
        ]);
        $auth = auth('supplier')->user()->id;
        $data = bahan_brands::findOrFail($id)->update([
            'supplier_id' => $auth,
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
        $data = bahan_brands::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ');
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
