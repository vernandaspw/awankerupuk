<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = satuan::latest()->get();
        return view('pages.offices.satuan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.offices.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'max:30',
        ]);
        $data =  satuan::create([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return redirect('office/satuan')->withSuccess('Berhasil menambahkan data');
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  satuan::findOrFail($id);
        return view('pages.offices.satuan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'max:30',
        ]);
        $data = satuan::find($id)->update([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return back()->withSuccess('Berhasil edit data');
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = satuan::findOrFail($id);
        $status = $data->delete();
        if ($status) {
            return back()->withSuccess('Berhasil hapus data ');
        } else {
            return back()->with('warning', 'Gagal hapus data');
        }
    }
}
