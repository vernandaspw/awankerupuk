<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SAuthController extends Controller
{
    public function masuk(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|max:60'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard('supplier')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'supplier']);
            return redirect('supplier')->with('success', 'Berhasil Login');
        } else {
            return back()->with('warning', 'Alamat Email atau Password Anda salah!');
        }
    }

    public function keluar()
    {
        $cek = auth('supplier')->logout();

        return redirect('supplier')->with('success', 'Berhasil logout');
    }
}
