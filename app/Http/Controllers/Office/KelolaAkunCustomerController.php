<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class KelolaAkunCustomerController extends Controller
{
    public function index()
    {
        $datas = Customer::latest()->get();
        $all = $datas->count();
        return view('pages.offices.kelola-akun.customer.index', compact('datas', 'all'));
    }

    public function show($id)
    {
        $data = Customer::findOrFail($id);

        return view('pages.offices.kelola-akun.customer.show', compact('data'));
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
