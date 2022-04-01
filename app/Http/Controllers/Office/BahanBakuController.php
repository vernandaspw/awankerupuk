<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\PesanBahan;
use App\Models\PesanBahanDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{

    public function caribahan()
    {
        //
    }

    public function index()
    {
        $datas = PesanBahan::latest()->get();
        return view('pages.offices.bahan.index', compact('datas'));
    }

    public function create(Request $request)
    {
        $supp = Supplier::get();
        return view('pages.offices.bahan.create', compact('supp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => '',
            'no_telp' => '',
            'alamat' => '',
            'catatan' => '',
            'addmore.*.name' => '',
            'addmore.*.qty' => ''
        ]);

        $bahanbaku = PesanBahan::create([
            'supplier_id' => $request->supplier_id,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan == null ? '' : $request->catatan
        ]);

        foreach ($request->addmore  as $key => $value) {
            $detail = PesanBahanDetail::create([
                'supplier_id' => $request->supplier_id,
                'pesan_bahan_id' => $bahanbaku->id,
                'nama_bahan' => $value['name'],
                'qty' => $value['qty'],
                'harga' => 0,
                'total_harga' => 0,
                'catatan' => '',
            ]);
        }

        return back()->with('success', 'berhasil memesan bahan baku, tunggu konfirmasi dari supplier');
    }

    public function lihat($id)
    {
        $datas = PesanBahan::with(['supplier', 'details'])->findOrFail($id);
        return view('pages.offices.bahan.lihat', compact('datas'));
    }

    public function pesan($id)
    {
        $update = PesanBahan::findOrFail($id)->update([
            'status' => 'dikemas'
        ]);

        return back()->with('success', 'barang telah dipesan, dan sedang dikemas');
    }

    public function terima($id)
    {
        $update = PesanBahan::findOrFail($id)->update([
            'status' => 'diterima'
        ]);

        return back()->with('success', 'barang telah diterima');
    }
}
