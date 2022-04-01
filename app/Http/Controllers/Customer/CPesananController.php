<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProdukKategori;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiMetode;
use Illuminate\Http\Request;

class CPesananController extends Controller
{
    public function index()
    {
        $auth = auth('customer')->user()->id;
        $kategoris = ProdukKategori::get();
        $transaksis = Transaksi::latest()->where('customer_id', $auth)->with(['transaksidetails', 'customer'])->get();

        return view('pages.customers.isAuth.pesanan', compact('kategoris', 'transaksis'));
    }

    public function lihat($id)
    {
        $transaksi = Transaksi::with(['customer', 'metode', 'transaksidetails'])->findOrFail($id);
        $item = TransaksiDetail::with('produk')->where('transaksi_id', $transaksi->id)->get();

        return view('pages.customers.isAuth.pesanandetail', compact('transaksi', 'item'));
    }

    public function konfirm($id)
    {

        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status_bayar == 'blmbayar') {
            $cek = Transaksi::findOrFail($id)->update([
                'status_bayar' => 'proses'
            ]);
            return back()->with('success', 'berhasil, pembayaran sedang dicek admin');
        }
    }

    public function batal($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status_bayar == 'blmbayar') {
            $cek = Transaksi::findOrFail($id)->update([
                'status_transaksi' => 'batal'
            ]);

            return back()->with('success', 'Pesanan telah dibatalkan');
        }
    }

    public function terima($id)
    {
        $auth = auth('customer')->user()->id;
        $transaksi = Transaksi::with('metode')->where('customer_id', $auth)->findOrFail($id);


        if ($transaksi->metode->metode == 'transfer') {
            $cek = $transaksi->update([
                'status_transaksi' => 'diterima'
            ]);

            return back()->with('success', 'Pesanan telah diterima');
        } elseif ($transaksi->metode->metode == 'cod') {
            $transaksi = $transaksi->update([
                'status_bayar' => 'sdhbayar',
                'status_transaksi' => 'diterima'
            ]);
            return back()->with('success', 'Pesanan telah dibatalkan');
        }
    }
}
