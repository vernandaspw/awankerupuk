<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProdukKategori;
use App\Models\Setting;
use Illuminate\Http\Request;

class CKontakController extends Controller
{
    public function index()
    {
        $kategoris = ProdukKategori::get();
        $kontak = Setting::findOrFail(1);

        return view('pages.customers.kontak', compact('kategoris', 'kontak'));
    }
}
