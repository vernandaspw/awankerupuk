<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\bahan;
use App\Models\BahanRate;
use App\Models\cart_bahan;
use App\Models\cart_bahan_detail;
use App\Models\cart_bahan_supp;
use App\Models\CartDetail;
use App\Models\metode_pembayaran;
use App\Models\pesan;
use App\Models\pesan_detail;
use Illuminate\Http\Request;

class BahansController extends Controller
{
    public function index()
    {
        $cart = cart_bahan_detail::get()->count();
        $datas = bahan::with(['supplier', 'kategori', 'brand', 'satuan', 'ratings'])->latest()->get();


        return view('pages.offices.bahanbaku.index', compact('datas', 'cart'));
    }

    public function detail($id)
    {
        $data = bahan::with(['supplier', 'kategori', 'brand', 'satuan'])->findOrFail($id);
        $rate = BahanRate::where('bahans_id', $id)->avg('rating');


        return view('pages.offices.bahanbaku.detail', compact('data', 'rate'));
    }

    public function cart()
    {
        $datas = cart_bahan_detail::with(['supplier'])->get();
        return view('pages.offices.bahanbaku.cart', compact('datas'));
    }

    public function ubahqty($id)
    {
        $data = cart_bahan_detail::findOrFail($id);
        return view('pages.offices.bahanbaku.ubahqty', compact('data'));
    }

    public function updateqty(Request $request, $id)
    {
        $data = cart_bahan_detail::findOrFail($id)->update(
            [
                'qty' => $request->qty
            ]
        );

        return redirect('office/bahans/cart')->with('success', 'berhasil diubah');
    }

    public function deleteitemcart($id)
    {
        $cartdetail = cart_bahan_detail::findOrFail($id);
        $cek = $cartdetail->supplier_id;
        $cartsup = cart_bahan_supp::with('cartdetails')->where('supplier_id', $cek)->first();

        if ($cartsup->cartdetails->count() == 1) {
            $cartsup2 = cart_bahan_supp::with('cartdetails')->where('supplier_id', $cek)->first();
            $cartdetail->delete();
            $cartsup2->delete();

            return back()->with('success', 'Berhasil dihapus dari cart');
        } else {
            $cartdetail->delete();
            return back()->with('success', 'Berhasil dihapus dari cart');
        }
    }

    public function addtocart($id)
    {
        $cart = cart_bahan::first();
        if ($cart == null) {
            $auth = auth('office')->user()->setting_id;
            $buatcart = cart_bahan::create([
                'setting_id' => $auth
            ]);
            //cek apakah ada cartsupps

            $bahan = bahan::findOrFail($id);
            $buatcartsupp = cart_bahan_supp::create([
                'supplier_id' => $bahan->supplier_id,
                'cart_bahan_id' => $buatcart->id,
                'setting_id' => auth('office')->user()->setting_id,
                'catatan' => null
            ]);

            $buatcartdetail = cart_bahan_detail::create([
                'supplier_id' => $bahan->supplier_id,
                'cart_bahan_supp_id' => $buatcartsupp->id,
                'setting_id' =>  auth('office')->user()->setting_id,
                'bahan_id' => $bahan->id,
                'qty' => 1,
            ]);
            return back()->with('toast_success', 'berhasil menambahkan ke keranjang');
        } else {
            //cek apakah cartsupp ada id supplier dari bahan input
            $bahan = bahan::findOrFail($id);
            $ceksup = cart_bahan_supp::where('supplier_id', $bahan->supplier_id)->first();
            if ($ceksup == null) {
                $auth = auth('office')->user()->setting_id;
                $caricart = cart_bahan::where('setting_id', $auth)->first();
                $bahan = bahan::findOrFail($id);
                $buatcartsupp2 = cart_bahan_supp::create([
                    'supplier_id' => $bahan->supplier_id,
                    'cart_bahan_id' => $caricart->id,
                    'setting_id' => $auth,
                    'catatan' => null
                ]);

                $buatcartdetail = cart_bahan_detail::create([
                    'supplier_id' => $bahan->supplier_id,
                    'cart_bahan_supp_id' => $buatcartsupp2->id,
                    'setting_id' =>  $auth,
                    'bahan_id' => $bahan->id,
                    'qty' => 1,
                ]);
                return back()->with('toast_success', 'berhasil menambahkan ke keranjang');
            } else {
                //jika telah memiliki tb sup lalu cek detail
                $auth = auth('office')->user()->setting_id;
                $bahan = bahan::findOrFail($id);
                $ceksup = cart_bahan_supp::where('supplier_id', $bahan->supplier_id)->first();
                $idcartsupp = $ceksup->id;
                $cartdetail = cart_bahan_detail::where('bahan_id', $bahan->id)->first();
                //cek detail pada id bahan supp
                if ($cartdetail == null) {
                    //jika tidak memiliki cart detail berdasarkan bahan yang ditambahkan
                    $buatcartdetail = cart_bahan_detail::create([
                        'supplier_id' => $bahan->supplier_id,
                        'cart_bahan_supp_id' => $idcartsupp,
                        'setting_id' =>  auth('office')->user()->setting_id,
                        'bahan_id' => $bahan->id,
                        'qty' => 1,
                    ]);
                    return back()->with('toast_success', 'berhasil menambahkan ke keranjang');
                } else {
                    // jika telah memiliki cart detail berdasarkan bahan yg ditambahkan
                    $qty = cart_bahan_detail::where('bahan_id', $id)->first();
                    $qtyy = $qty->qty + 1;
                    $updatecartdetail = $qty->update([
                        'qty' => $qtyy
                    ]);

                    return back()->with('toast_success', 'berhasil menambahkan ke keranjang');
                }
            }
        }
    }

    public function checkout()
    {
        $datas =  cart_bahan::with(['cartsupps'])->latest()->first();
        $metode = metode_pembayaran::latest()->get();
        return view('pages.offices.bahanbaku.checkout', compact('datas', 'metode'));
    }

    public function save(Request $request, $id)
    {
        $updatecartsupp = cart_bahan_supp::findOrFail($id)->update([
            'metode' => $request->metode,
            'catatan' => $request->catatan
        ]);
        return back()->with('toast_success', 'metode pembayaran atau catatan berhasil disimpan');
    }

    public function buatpesanan()
    {
        $cart = cart_bahan::with(['cartsupps'])->latest()->first();
        $cartdetails = cart_bahan_detail::get();

        foreach ($cart->cartsupps as $key => $cartsupp) {
            $buatpesan = pesan::create([
                'supplier_id' => $cartsupp->supplier_id,
                'setting_id' => $cartsupp->setting_id,
                'biaya_antar' => 0,
                'total_harga' => 0,
                'total_pembayaran' => 0,
                'metode' => $cartsupp->metode,
                'status_bayar' => 'menunggu',
                'status' => 'menunggu',
                'catatan' => $cartsupp->catatan
            ]);
            foreach ($cartsupp->cartdetails as $key => $value) {
                $buatpesandetail = pesan_detail::create([
                    'pesan_id' => $buatpesan->id,
                    'supplier_id' => $value->supplier_id,
                    'setting_id' => $value->setting_id,
                    'bahan_id' => $value->bahan_id,
                    'harga' => 0,
                    'qty' => $value->qty,
                    'tota_harga' => 0,
                ]);
            }
        }

        $deletecart = cart_bahan::findOrFail($cart->id)->delete();

        return redirect('office/pesanan-saya')->with('success', 'berhasil membuat pesanan');
    }

    public function kategori($id)
    {
        $cart = cart_bahan_detail::get()->count();
        $datas = bahan::with(['supplier', 'kategori', 'brand', 'satuan'])->where('bahan_kategori_id', $id)->latest()->get();
        return view('pages.offices.bahanbaku.index', compact('datas', 'cart'));
    }
}
