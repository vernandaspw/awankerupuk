<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\TransaksiMetode;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $datas = TransaksiMetode::latest()->get();
        return view('pages.offices.metode-pembayaran.index', compact('datas'));
    }

    public function create()
    {
        return view('pages.offices.metode-pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode' => 'max:30',
            'keterangan' => 'max:50',
            'an' => 'max:50',
            'norek' => 'max:100',
        ]);
        $data =  TransaksiMetode::create([
            'metode' => $request->metode,
            'keterangan' => $request->keterangan,
            'an' => $request->an,
            'norek' => $request->norek,
        ]);
        if ($data) {
            return redirect('office/metode')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data =  TransaksiMetode::findOrFail($id);
        return view('pages.offices.metode-pembayaran.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'metode' => 'max:30',
            'keterangan' => 'max:50',
            'an' => 'max:50',
            'norek' => 'max:100',
        ]);
        $data = TransaksiMetode::find($id)->update([
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
        $data = TransaksiMetode::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
