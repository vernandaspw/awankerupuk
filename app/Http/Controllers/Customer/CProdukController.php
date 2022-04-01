<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;

class CProdukController extends Controller
{

    public function show($id)
    {
        $kategoris = ProdukKategori::get();
        $produk = Produk::with(['kategori', 'brand'])->findOrFail($id);
        $produks = Produk::latest()->paginate(3);
        return view('pages.customers.produk-detail', compact('kategoris', 'produk', 'produks'));
    }
}
