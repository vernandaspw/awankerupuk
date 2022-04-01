<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PesanBahan;
use Illuminate\Http\Request;

class SDashboardController extends Controller
{
    public function index()
    {
        $menunggu = PesanBahan::where('status', 'menunggu')->count();
        $harga = PesanBahan::where('status', 'harga')->count();
        $dikemas = PesanBahan::where('status', 'dikemas')->count();
        $dikirim = PesanBahan::where('status', 'dikirim')->count();
        $diterima = PesanBahan::where('status', 'diterima')->count();
        $selesai = PesanBahan::where('status', 'selesai')->count();
        $batal = PesanBahan::where('status', 'batal')->count();
        return view('pages.suppliers.dashboard', compact(
            'menunggu',
            'harga',
            'dikemas',
            'dikirim',
            'diterima',
            'selesai',
            'batal',
        ));
    }
}
