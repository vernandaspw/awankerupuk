<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\metode_pembayaran;
use Illuminate\Http\Request;

class SMetodeController extends Controller
{
    public function index()
    {
        $auth = auth('supplier')->user()->id;
        $datas = metode_pembayaran::latest()->where('supplier_id', $auth)->get();
        return view('pages.suppliers.metode.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.suppliers.metode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode' => 'max:30',
            'keterangan' => 'max:50',
            'an' => 'max:50',
            'norek' => 'max:100',
        ]);
        $auth = auth('supplier')->user()->id;
        $data =  metode_pembayaran::create([
            'supplier_id' => $auth,
            'metode' => $request->metode,
            'keterangan' => $request->keterangan,
            'an' => $request->an,
            'norek' => $request->norek,
        ]);
        if ($data) {
            return redirect('supplier/metode')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data =  metode_pembayaran::findOrFail($id);
        return view('pages.suppliers.metode.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'metode' => 'max:30',
            'keterangan' => 'max:50',
            'an' => 'max:50',
            'norek' => 'max:100',
        ]);
        $auth = auth('supplier')->user()->id;
        $data = metode_pembayaran::find($id)->update([
            'supplier_id' => $auth,
            'metode' => $request->metode,
            'keterangan' => $request->keterangan,
            'an' => $request->an,
            'norek' => $request->norek
        ]);
        if ($data) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }


    public function destroy($id)
    {
        $data = metode_pembayaran::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
