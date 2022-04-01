<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Produk;
use App\Models\ProdukBrand;
use App\Models\ProdukKategori;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ODashboardController extends Controller
{
    public function index()
    {
        $jmlcustomer = Customer::count();
        $jmloffice = Office::count();
        $jmlsupplier = Supplier::count();

        $jmlproduk =  Produk::count();
        $jmlkategori =  ProdukKategori::count();
        $jmlbrand = ProdukBrand::count();

        $prosespay = Transaksi::where('status_bayar', 'proses')->count();
        $dikemas = Transaksi::where('status_transaksi', 'dikemas')->count();
        $dikirim = Transaksi::where('status_transaksi', 'dikirim')->count();
        $diterima = Transaksi::where('status_transaksi', 'diterima')->count();
        $selesai = Transaksi::where('status_transaksi', 'selesai')->count();
        $batal = Transaksi::where('status_transaksi', 'batal')->count();

        $totalpendapatan = Transaksi::where('status_bayar', 'sdhbayar')->sum('subtotal');
        $pendapatan_hari = Transaksi::where('status_bayar', 'sdhbayar')->whereDay('updated_at', date('d'))->sum('subtotal');
        $pendapatan_bulan = Transaksi::where('status_bayar', 'sdhbayar')->whereMonth('updated_at', date('m'))->sum('subtotal');
        $pendapatan_tahun = Transaksi::where('status_bayar', 'sdhbayar')->whereYear('updated_at', date('Y'))->sum('subtotal');

        return view('pages.offices.dashboard', compact(
            'jmlcustomer',
            'jmloffice',
            'jmlsupplier',
            'jmlproduk',
            'jmlkategori',
            'jmlbrand',

            'prosespay',
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
}
