<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukStok;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $datas = Transaksi::with(['customer', 'metode'])->latest()->get();

        $all = $datas->count();

        $prosespay = Transaksi::where('status_bayar', 'proses')->count();
        $blmbayar = Transaksi::where('status_bayar', 'blmbayar')->count();
        $sdhbayar = Transaksi::where('status_bayar', 'sdhbayar')->count();
        $pembayaran = Transaksi::where('status_transaksi', 'pembayaran')->count();
        $dikemas = Transaksi::where('status_transaksi', 'dikemas')->count();
        $dikirim = Transaksi::where('status_transaksi', 'dikirim')->count();
        $diterima = Transaksi::where('status_transaksi', 'diterima')->count();
        $selesai = Transaksi::where('status_transaksi', 'selesai')->count();
        $batal = Transaksi::where('status_transaksi', 'batal')->count();

        $totalpendapatan = Transaksi::where('status_bayar', 'sdhbayar')->sum('subtotal');
        $pendapatan_hari = Transaksi::where('status_bayar', 'sdhbayar')->whereDay('updated_at', date('d'))->sum('subtotal');
        $pendapatan_bulan = Transaksi::where('status_bayar', 'sdhbayar')->whereMonth('updated_at', date('m'))->sum('subtotal');
        $pendapatan_tahun = Transaksi::where('status_bayar', 'sdhbayar')->whereYear('updated_at', date('Y'))->sum('subtotal');


        return view('pages.offices.pesanan.index', compact(
            'datas',
            'all',
            'blmbayar',
            'prosespay',
            'sdhbayar',
            'pembayaran',
            'dikemas',
            'dikirim',
            'diterima',
            'selesai',
            'batal',

            'totalpendapatan',
            'pendapatan_hari',
            'pendapatan_bulan',
            'pendapatan_tahun'
        ));
    }

    public function batal($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $cek = $transaksi->update([
            'status_transaksi' => 'batal'
        ]);
        return back()->with('success', 'Pesanan telah dibatalkan');
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $cek = $transaksi->update([
            'status_transaksi' => 'selesai'
        ]);
        return back()->with('success', 'Pesanan telah selesai');
    }
    public function kirim($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $cek = $transaksi->update([
            'status_transaksi' => 'dikirim'
        ]);
        return back()->with('success', 'Pesanan telah dikirim');
    }

    public function confirm($id)
    {
        $transaksi = Transaksi::with('transaksidetails')->findOrFail($id);
        $cek = $transaksi->update([
            'status_bayar' => 'sdhbayar',
            'status_transaksi' => 'dikemas'
        ]);

        foreach ($transaksi->transaksidetails as $key => $value) {
            $produk = Produk::findOrFail($value->produk_id);
            $updatedetail = $produk->update([
                'stok_toko' => $produk->stok_toko - $value->qty
            ]);

            $createstok = ProdukStok::create([
                'posisi' => 'toko',
                'status' => 'keluar',
                'produk_id' => $value->produk_id,
                'qty' => $value->qty,
                'keterangan' => 'terjual'
            ]);
        }

        if ($createstok) {
            return back()->with('success', 'Pembayaran telah dikonfirmasi');
        }
    }
}
