<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Office;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KelolaAkunOfficeController extends Controller
{
    public function index()
    {
        $datas = Office::latest()->get();
        $all = $datas->count();
        $admin = $datas->where('role', '=', 'admin')->count();
        $produksi = $datas->where('role', '=', 'produksi')->count();
        $gudang = $datas->where('role', '=', 'gudang')->count();
        return view('pages.offices.kelola-akun.office.index', compact('datas', 'all', 'admin', 'produksi', 'gudang'));
    }
    public function create()
    {
        return view('pages.offices.kelola-akun.office.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:50|required',
            'nohp' => 'max:16',
            'email'     => 'required|email|unique:offices,email',
            'password'  => 'required|max:60',
            'role' => 'max:30',
            'isAktif' => ''
        ]);
        $pass = Hash::make($request->password);
        $data = Office::create([
            'name' => $request->name,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'password' => $pass,
            'role' => $request->role,
            'isAktif' => $request->isAktif
        ]);
        if ($data) {
            return redirect('office/akunoffice')->with('success', 'Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    public function edit($id)
    {
        $data = Office::findOrFail($id);
        return view('pages.offices.kelola-akun.office.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'max:50|required',
            'noHP' => 'max:16',
            'email'     => 'required|email', Rule::unique('offices')->ignore($id),
            'password'  => 'max:60',
            'role' => 'max:30',
            'isAktif' => ''
        ]);
        $pass = Hash::make($request->password);
        $data = Office::find($id)->update([
            'name' => $request->name,
            'nohp' => $request->noHP,
            'email' => $request->email,
            'password' => $pass,
            'role' => $request->role,
            'isAktif' => $request->isAktif
        ]);
        if ($data) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->withErrors('Gagal edit data');
        }
    }
    public function destroy($id)
    {
        $data = Office::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ' . $data->name);
        } else {
            return back()->withErrors('Gagal hapus data');
        }
    }
}
