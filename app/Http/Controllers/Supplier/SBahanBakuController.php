<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PesanBahan;
use App\Models\PesanBahanDetail;
use Illuminate\Http\Request;

class SBahanBakuController extends Controller
{
    public function index()
    {
        $datas = PesanBahan::latest()->get();
        return view('pages.suppliers.bahan.index', compact('datas'));
    }

    public function edit($id)
    {
        $datas = PesanBahan::with(['supplier', 'details'])->findOrFail($id);
        return view('pages.suppliers.bahan.edit', compact('datas'));
    }

    public function beriharga(Request $request, $id)
    {
        $data = PesanBahanDetail::findOrFail($id);
        $update = $data->update([
            'harga' => $request->harga,
            'total_harga' => $request->harga * $data->qty
        ]);

        if ($update) {
            $jml = PesanBahanDetail::find($data->pesan_bahan_id)->sum('total_harga');
            $pesan = PesanBahan::findOrFail($data->pesan_bahan_id);
            $perbarui = $pesan->update([
                'status' => 'harga',
                'total_bayar' => $jml
            ]);
        }

        return back()->with('toast_success', 'behasil memberi harga');
    }

    public function kirim($id)
    {
        $update = PesanBahan::findOrFail($id)->update([
            'status' => 'dikirim'
        ]);

        return back()->with('success', 'barang berhasil dikirim');
    }

    public function selesai($id)
    {
        $update = PesanBahan::findOrFail($id)->update([
            'status' => 'selesai'
        ]);

        return back()->with('success', 'pesanan selesai');
    }
    public function batal($id)
    {
        $update = PesanBahan::findOrFail($id)->update([
            'status' => 'batal'
        ]);

        return back()->with('success', 'barang berhasil dibatalkan');
    }
}
