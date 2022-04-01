<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $id = auth('office')->user()->setting_id;
        $data = Setting::findOrFail($id);

        return view('pages.offices.setting', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'string|max:50',
            'no_telp' => 'numeric',
            'email' => 'email',
            'alamat' => 'string',
            'pajak' => 'max:10',
            'tentang' => 'string'
        ]);

        $cek = Setting::findOrFail($id)->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'pajak' => $request->pajak,
            'tentang' => $request->tentang
        ]);

        if ($cek) {
            return back()->with('success', 'Berhasil edit data');
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }
}
