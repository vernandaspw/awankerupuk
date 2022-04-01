<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\BahanRate;
use App\Models\pesan;
use Illuminate\Http\Request;

class OPesanController extends Controller
{
    public function index()
    {
        $datas = pesan::with(['supplier', 'setting'])->latest()->get();

        return view('pages.offices.bahanbaku.pesanan-saya', compact('datas'));
    }

    public function bayar($id)
    {
        $datas = pesan::with(['supplier', 'setting', 'pesan_details'])->findOrFail($id);

        return view('pages.offices.bahanbaku.bayar', compact('datas'));
    }

    public function sdhbayar($id)
    {
        $update = pesan::findOrFail($id)->update([
            'status_bayar' => 'sdhbayar',
            'status' => 'dikemas'
        ]);
        return redirect('office/pesanan-saya')->with('success', 'Berhasil membayar,' . '<br>' . 'barang segera dikemas');
    }

    public function terima($id)
    {
        $update = pesan::findOrFail($id)->update([
            'status' => 'diterima'
        ]);
        return back()->with('success', 'Barang telah diterima');
    }

    public function batal($id)
    {
        $update = pesan::findOrFail($id)->update([
            'status_bayar' => 'batal',
            'status' => 'batal'
        ]);
        return back()->with('success', 'Pesanan telah dibatalkan');
    }

    public function detail($id)
    {
        $data = pesan::with(['supplier', 'setting', 'pesan_details'])->findOrFail($id);

        return view('pages.offices.bahanbaku.detail-pesanan', compact('data'));
    }

    public function rating(Request $req, $id)
    {
        $idauth = auth('office')->user()->id;
        $create = BahanRate::create([
            'bahans_id' => $id,
            'office_id' => $idauth,
            'rating' => $req->rating
        ]);
        return back()->with('success', 'berhasil memberi rating');
    }
}
