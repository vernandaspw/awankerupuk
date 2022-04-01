<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\ProdukStok;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiMetode;
use Illuminate\Http\Request;

class CCheckoutController extends Controller
{
    public function index()
    {
        $auth = auth('customer')->user()->id;
        $carts = Cart::with(['cartdetails'])->where('customer_id', $auth)->first();
        $user = Customer::find($auth)->first();
        $metodes = TransaksiMetode::get();

        return view('pages.customers.isAuth.checkout', compact('carts', 'user', 'metodes'));
    }

    public function buatpesanan(Request $request)
    {
        $auth = auth('customer')->user()->id;
        $carts = Cart::with('cartdetails')->where('customer_id', $auth)->first();

        $metode = TransaksiMetode::findOrFail($request->metode);

        //cek apakah metode cod atau transfer
        if ($metode->metode == 'cod') {
            $status_transaksi = 'dikemas';
        } else {
            $status_transaksi = 'pembayaran';
        }

        $buat_transaksi = Transaksi::create([
            'customer_id' => $carts->customer_id,
            'subtotal' => $carts->subtotal,
            'total_pembayaran' => $carts->total_pembayaran,
            'transaksi_metode_id' => $request->metode,
            'status_bayar' => 'blmbayar',
            'status_transaksi' => $status_transaksi,
            'catatan' => $request->catatan != null ? $request->catatan : ''
        ]);

        if ($buat_transaksi) {
            if ($status_transaksi == 'dikemas') {
                foreach ($carts->cartdetails as $value) {
                    $cek = TransaksiDetail::create([
                        'customer_id' => $value->customer_id,
                        'transaksi_id' => $buat_transaksi->id,
                        'produk_id' =>  $value->produk_id,
                        'qty' => $value->qty,
                        'subharga' => $value->subharga
                    ]);

                    $produk = Produk::findOrFail($value->produk_id);
                    $cek = $produk->update([
                        'stok_toko' => $produk->stok_toko - $value->qty
                    ]);
                    $cek = ProdukStok::create([
                        'posisi' => 'toko',
                        'status' => 'keluar',
                        'produk_id' => $value->produk_id,
                        'qty' => $value->qty,
                        'keterangan' => 'terjual'
                    ]);
                }
                if ($cek) {
                    //hapus cartdetail
                    $cartauth = auth('customer')->user()->id;
                    $cek = CartDetail::where('customer_id', $cartauth)->delete();
                    return redirect('pesanan')->with('success', 'berhasil membuat pesanan');
                } else {
                    return back()->with('success', 'gagal membuat pesanan');
                }
            } else {
                foreach ($carts->cartdetails as $value) {
                    $cek2 = TransaksiDetail::create([
                        'customer_id' => $value->customer_id,
                        'transaksi_id' => $buat_transaksi->id,
                        'produk_id' =>  $value->produk_id,
                        'qty' => $value->qty,
                        'subharga' => $value->subharga
                    ]);
                }
                if ($cek2) {
                    //hapus cartdetail
                    $cartauth = auth('customer')->user()->id;
                    $cek = CartDetail::where('customer_id', $cartauth)->delete();
                    return redirect('pesanan')->with('success', 'silahkan bayar pesanan Ke ' . '<br>' . $metode->keterangan . '<br>' . $metode->norek . '<br>' . $metode->an);
                } else {
                    return back()->with('success', 'gagal membuat pesanan');
                }
            }
        }
    }
}
