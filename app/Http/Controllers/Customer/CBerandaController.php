<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;

class CBerandaController extends Controller
{
    public function index()
    {
        $allproduks = Produk::latest()->paginate(12);
        $kategoris = ProdukKategori::get();

        return view('pages.customers.beranda', compact('allproduks', 'kategoris'));
    }
    public function kategoriid($id)
    {
        $allproduks = Produk::where('produk_kategori_id', 'like', '%' . $id . '%')->paginate(12);
        $kategoris = ProdukKategori::get();

        return view('pages.customers.beranda', compact('allproduks', 'kategoris'));
    }
}
