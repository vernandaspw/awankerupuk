<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\pesan;
use App\Models\pesan_detail;
use Illuminate\Http\Request;

class SPesanController extends Controller
{
    public function index()
    {
        $auth = auth('supplier')->user()->id;
        $datas = pesan::with(['supplier', 'setting'])->where('supplier_id', $auth)->latest()->get();

        return view('pages.suppliers.pesanan.pesanan', compact('datas'));
    }

    public function beriharga($id)
    {
        $datas = pesan::with(['supplier', 'setting', 'pesan_details'])->findOrFail($id);

        return view('pages.suppliers.pesanan.harga', compact('datas'));
    }

    public function beriharga_proses(Request $request, $id)
    {
        $data = pesan_detail::findOrFail($id);
        $update = $data->update([
            'harga' => $request->harga,
            'total_harga' => $request->harga * $data->qty
        ]);

        if ($update) {
            $jml =  pesan_detail::where('pesan_id', $data->pesan_id)->sum('total_harga');
            $pesan = pesan::findOrFail($data->pesan_id);
            $perbarui = $pesan->update([
                'total_harga' =>  $jml
            ]);
        }

        return back()->with('toast_success', 'behasil memberi harga');
    }

    public function biayaantar(Request $request, $id)
    {
        $pesan = pesan::findOrFail($id);
        $totalharga = $pesan->total_harga;
        $biayaantar = $request->biaya_antar == null ? $pesan->biaya_antar : $request->biaya_antar;
        $total = $pesan->total_pembayaran;
        $hasiltotal = $totalharga + $biayaantar;

        $perbarui = $pesan->update([
            'biaya_antar' => $biayaantar,
            'total_pembayaran' =>  $hasiltotal
        ]);

        return back()->with('toast_success', 'behasil memperbarui biaya antar');
    }

    public function perbarui($id)
    {
        $data = pesan::findOrFail($id);
        $antar = $data->biaya_antar;
        $harga = $data->total_harga;
        $perbarui =  $data->update([
            'status_bayar' => 'blmbayar',
            'status' => 'harga',
            'total_pembayaran' => $antar + $harga
        ]);
        return back()->with('toast_success', 'behasil memperbarui total pembayaran');
    }

    public function tagih($id)
    {
        $data = pesan::findOrFail($id);
        $antar = $data->biaya_antar;
        $harga = $data->total_harga;

        $perbarui =  $data->update([
            'status_bayar' => 'blmbayar',
            'status' => 'harga',
            'total_pembayaran' => $antar + $harga
        ]);


        return redirect('supplier/pesanan')->with('success', 'Behasil menginformasikan tagihan pesanan');
    }

    public function kirim($id)
    {
        $kirim = pesan::findOrFail($id)->update([
            'status' => 'dikirim'
        ]);

        return back()->with('toast_success', 'Mengirim bahan baku');
    }

    public function selesai($id)
    {
        $kirim = pesan::findOrFail($id)->update([
            'status' => 'selesai'
        ]);

        return back()->with('toast_success', 'Pesanan telah selesai');
    }

    public function batal($id)
    {
        $kirim = pesan::findOrFail($id)->update([
            'status' => 'batal'
        ]);

        return back()->with('toast_success', 'Telah dibatalkan');
    }
}
