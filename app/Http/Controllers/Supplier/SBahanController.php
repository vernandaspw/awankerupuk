<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\bahan;
use App\Models\bahan_brands;
use App\Models\bahan_kategori;
use App\Models\satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SBahanController extends Controller
{

    public function index()
    {
        $auth = auth('supplier')->user()->id;
        $datas = bahan::latest()->where('supplier_id', $auth)->with(['kategori', 'brand', 'satuan'])->get();
        return view('pages.suppliers.kelola-bahan.index', compact('datas'));
    }

    public function create()
    {
        $kategoris = bahan_kategori::latest()->get();
        $brands = bahan_brands::latest()->get();
        $satuans = satuan::latest()->get();
        return view('pages.suppliers.kelola-bahan.create', compact('kategoris', 'brands', 'satuans'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => '',
            'img_url' => 'mimes:png,jpg,jpeg',
            'nama' => 'required',
            'bahan_kategori_id' => 'required',
            'bahan_brand_id' => 'required',
            'satuan_id' => 'required',
            'keterangan' => ''
        ]);

        if ($request->hasFile('img_url')) {
            $gambar = Storage::putFile('bahan', $request->file('img_url'));
        } else {
            $gambar = null;
        }
        $auth = auth('supplier')->user()->id;
        $data =  bahan::create([
            'supplier_id' => $auth,
            'img_url' => $gambar,
            'nama' => $request->nama,
            'bahan_kategori_id' => $request->bahan_kategori_id,
            'bahan_brand_id' => $request->bahan_brand_id,
            'satuan_id' => $request->satuan_id,
            'keterangan' => $request->keterangan
        ]);

        if ($data) {
            return redirect('supplier/bahans')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = bahan::findOrFail($id);
        $kategoris = bahan_kategori::latest()->get();
        $brands = bahan_brands::latest()->get();
        $satuans = satuan::latest()->get();
        return view('pages.suppliers.kelola-bahan.edit', compact('data', 'kategoris', 'brands', 'satuans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => '',
            'img_url' => 'mimes:png,jpg,jpeg',
            'nama' => '',
            'bahan_kategori_id' => '',
            'bahan_brand_id' => '',
            'satuan_id' => '',
            'keterangan' => ''
        ]);
        $data =  bahan::findOrFail($id);
        if ($request->hasFile('img_url')) {
            Storage::delete($data->img_url);
            $gambar = Storage::putFile('bahan', $request->file('img_url'));
        } else {
            $gambar = $data->img_url;
        }
        $auth = auth('supplier')->user()->id;
        $cek = $data->update([
            'supplier_id' => $auth,
            'img_url' => $gambar,
            'nama' => $request->nama,
            'bahan_kategori_id' => $request->bahan_kategori_id,
            'bahan_brand_id' => $request->bahan_brand_id,
            'satuan_id' => $request->satuan_id,
            'keterangan' => $request->keterangan
        ]);
        if ($cek) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }
    public function destroy($id)
    {
        $data = bahan::findOrFail($id);
        if ($data->img_url == null) {
            $status = $data->delete();
            if ($status) {
                return back()->withSuccess('Berhasil hapus data ');
            } else {
                return back()->with('warning', 'Gagal hapus data');
            }
        } else {
            $hapusgambar = Storage::delete($data->img_url);
            if ($hapusgambar) {
                $status = $data->delete();
                if ($status) {
                    return back()->withSuccess('Berhasil hapus data ');
                } else {
                    return back()->with('warning', 'Gagal hapus data');
                }
            } else {
                return back()->with('warning', 'Gagal hapus gambar');
            }
        }
    }
}
