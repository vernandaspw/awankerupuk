<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    public function masuk(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|max:60'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard('office')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'office']);
            return redirect('office')->with('success', 'Berhasil Login');
        } else {
            return back()->with('warning', 'Alamat Email atau Password Anda salah!');
        }
    }

    public function keluar()
    {
        $cek = auth('office')->logout();

        return redirect('office')->with('success', 'Berhasil logout');
    }
}
