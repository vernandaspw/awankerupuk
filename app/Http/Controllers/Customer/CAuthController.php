<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CAuthController extends Controller
{
    public function index()
    {
        $kategoris = ProdukKategori::get();
        return view('pages.customers.auth', compact('kategoris'));
    }

    public function masuk(Request $req)
    {
        $req->validate([
            'email'     => 'required|email',
            'password'  => 'required|max:60'
        ]);
        $credentials = ['email' => $req->email, 'password' => $req->password];
        if (Auth::guard('customer')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'customer']);
            return redirect('/');
        } else {
            return back()->with('warning', 'Alamat Email atau Password Anda salah!');
        }
    }

    public function daftar(Request $req)
    {
        $req->validate([
            'name' => 'max:50|required',
            'demail'     => 'required|email',
            'dpassword'  => 'required|max:60',
            'nphp' => 'max:16',
            'provinsi' => 'max:30',
            'kota' => 'max:30',
            'kecamatan' => 'max:30',
            'alamat' => 'max:200|required'
        ]);

        $pass = Hash::make($req->dpassword);

        $data = Customer::create([
            'name' => $req->name,
            'email' => $req->demail,
            'password' => $pass,
            'nohp' => $req->noHP,
            'provinsi' => $req->provinsi,
            'kota' => $req->kota,
            'kecamatan' => $req->kecamatan,
            'alamat' => $req->alamat
        ]);

        if ($data) {
            return back()->with('success', 'Pendaftaran Anda berhasil, Silahkan masuk di halaman login');
        } else {
            return back()->with('warning', 'Gagal daftar');
        }
    }

    public function keluar()
    {
        $cek = auth('customer')->logout();
        return redirect('/')->with('success', 'Berhasil logout');
    }
}
