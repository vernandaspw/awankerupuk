<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KelolaAkunSupplierController extends Controller
{
    public function index()
    {
        $datas = Supplier::latest()->get();
        $all = $datas->count();
        return view('pages.offices.kelola-akun.supplier.index', compact('datas', 'all'));
    }


    public function create()
    {
        return view('pages.offices.kelola-akun.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:50|required',
            'email'     => 'required|email|unique:offices,email',
            'password'  => 'required|max:60',
            'no_telp' => 'max:16',
            'provinsi' => 'max:30',
            'kota' => 'max:30',
            'kecamatan' => 'max:30',
            'alamat' => '',
            'bank' => 'max:30',
            'atas_nama' => 'max:30',
            'no_rek' => 'max:80',
        ]);
        $pass = Hash::make($request->password);
        $data = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
            'no_telp' => $request->no_telp,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'an' => $request->atas_nama,
            'norek' => $request->no_rek,
        ]);
        if ($data) {
            return redirect('office/akunsupplier')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->withErrors('Gagal menambahkan data');
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Supplier::findOrFail($id);
        return view('pages.offices.kelola-akun.supplier.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'max:50|required',
            'email'     => 'required|email', Rule::unique('suppliers')->ignore($id),
            'password'  => 'max:60',
            'no_telp' => 'max:16',
            'provinsi' => 'max:30',
            'kota' => 'max:30',
            'kecamatan' => 'max:30',
            'alamat' => '',
            'bank' => 'max:30',
            'atas_nama' => 'max:30',
            'no_rek' => 'max:80',
        ]);
        $pass = Hash::make($request->password);
        $data = Supplier::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
            'no_telp' => $request->no_telp,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'an' => $request->atas_nama,
            'norek' => $request->no_rek
        ]);
        if ($data) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->withErrors('Gagal edit data');
        }
    }


    public function destroy($id)
    {
        $data = Supplier::find($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->withErrors('Gagal hapus data');
        }
    }
}
