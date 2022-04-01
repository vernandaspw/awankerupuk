<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProdukKategori;
use App\Models\Setting;
use Illuminate\Http\Request;

class CTentangController extends Controller
{
    public function index()
    {
        $kategoris = ProdukKategori::get();
        $settings = Setting::findOrFail(1);
        return view('pages.customers.tentang', compact('kategoris', 'settings'));
    }
}
