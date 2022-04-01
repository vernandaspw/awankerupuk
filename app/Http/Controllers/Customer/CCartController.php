<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;

class CCartController extends Controller
{
    public function index()
    {
        $auth = auth('customer')->user()->id;
        $kategoris = ProdukKategori::get();
        $carts = Cart::with('cartdetails')->where('customer_id', $auth)->first();
        $cartdetail = CartDetail::where('customer_id', $auth)->first();
        $subtotal = CartDetail::where('customer_id', $auth)->sum('subharga');

        return view('pages.customers.isAuth.cart', compact('kategoris', 'carts', 'cartdetail', 'subtotal'));
    }

    public function update(Request $request)
    {
    }

    public function addtocart($produkid)
    {
        $auth = auth('customer')->user();
        $produk = Produk::findOrFail($produkid);
        $carts = Cart::where('customer_id', $auth->id)->first();
        $cartsdetail = CartDetail::where('customer_id', $auth->id)->first();
        if ($carts == null) {
            $createcart = Cart::create([
                'customer_id' => $auth->id,
            ]);

            if ($createcart) {
                if ($cartsdetail == null) {
                    $createCartDetail = CartDetail::create([
                        'customer_id' => $auth->id,
                        'cart_id' => $createcart->id,
                        'produk_id' => $produk->id,
                        'qty' => 1,
                        'subharga' => $produk->harga_jual
                    ]);
                    if ($createCartDetail) {
                        return back()->with('toast_success', 'berhasil menambahkan ke cart');
                    } else {
                        return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                    }
                } else {
                    $cekproduk = CartDetail::where('customer_id', $auth->id)->where('produk_id', $produk->id)->get();
                    if ($cekproduk != null) {
                        $hasilqty = $cekproduk->qty + 1;
                        $subharga = $produk->harga_jual * $hasilqty;
                        $updateqty = $cekproduk::update([
                            'qty' => $hasilqty,
                            'subharga' => $subharga
                        ]);
                        if ($updateqty) {
                            return back()->with('toast_success', 'berhasil menambahkan ke cart');
                        } else {
                            return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                        }
                    } else {
                        //jika produk tsb blm ada, maka buat cart detail baru
                        $buatCartDetail = CartDetail::create([
                            'customer_id' => $auth->id,
                            'cart_id' => $createcart,
                            'produk_id' => $produk->id,
                            'qty' => 1,
                            'subharga' => $produk->harga_jual
                        ]);
                        if ($buatCartDetail) {
                            return back()->with('toast_success', 'berhasil menambahkan ke cart');
                        } else {
                            return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                        }
                    }
                }
            }
        } else {
            $caricart = Cart::where('customer_id', $auth->id)->first();
            if ($cartsdetail == null) {
                $createCartDetail = CartDetail::create([
                    'customer_id' => $auth->id,
                    'cart_id' => $caricart->id,
                    'produk_id' => $produk->id,
                    'qty' => 1,
                    'subharga' => $produk->harga_jual
                ]);
                if ($createCartDetail) {
                    return back()->with('toast_success', 'berhasil menambahkan ke cart');
                } else {
                    return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                }
            } else {
                $cekproduk = CartDetail::where('customer_id', $auth->id)->where('produk_id', $produk->id)->first();

                if ($cekproduk != null) {

                    $hasilqty = $cekproduk->qty + 1;

                    $subharga = $produk->harga_jual * $hasilqty;

                    $updateqty = $cekproduk->update([
                        'qty' => $hasilqty,
                        'subharga' => $subharga
                    ]);

                    if ($updateqty) {
                        return back()->with('toast_success', 'berhasil menambahkan ke cart');
                    } else {
                        return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                    }
                } else {
                    //jika produk tsb blm ada, maka buat cart detail baru
                    $buatCartDetail = CartDetail::create([
                        'customer_id' => $auth->id,
                        'cart_id' => $caricart->id,
                        'produk_id' => $produk->id,
                        'qty' => 1,
                        'subharga' => $produk->harga_jual
                    ]);
                    if ($buatCartDetail) {
                        return back()->with('toast_success', 'berhasil menambahkan ke cart');
                    } else {
                        return back()->with('toast_warning', 'Gagal menambahkan ke cart');
                    }
                }
            }
        }
    }

    public function deleteprodukcart($cartdetailid)
    {
        $del = CartDetail::findOrFail($cartdetailid)->delete();
        if ($del) {
            return back()->with('toast_success', 'Berhasil hapus produk dari cart');
        } else {
            return back()->with('toast_warning', 'Gagal hapus produk dari cart');
        }
    }

    public function tambahqty($cartdetailid)
    {
        $data = CartDetail::with('produk')->findOrFail($cartdetailid);

        if ($data->qty >= 0) {
            $qty = $data->qty + 1;
            $subharga = $data->produk->harga_jual * $qty;
            $q = $data->update([
                'qty' => $qty,
                'subharga' => $subharga
            ]);
            return back();
        } else {
            return back()->with('warning', 'Tidak boleh kosong');
        }



        return back();
    }

    public function kurangqty($cartdetailid)
    {
        $data = CartDetail::with('produk')->findOrFail($cartdetailid);
        if ($data->qty > 1) {
            $qty = $data->qty - 1;
            $subharga = $data->produk->harga_jual * $qty;
            $q = $data->update([
                'qty' => $qty,
                'subharga' => $subharga
            ]);

            return back();
        } else {
            $data->delete();
            return back();
        }
    }

    public function checkout()
    {
        $auth = auth('customer')->user();
        $cart = Cart::with('cartdetails')->where('customer_id', $auth->id)->get();
        $detailproduk = CartDetail::where('customer_id', $auth->id)->get();

        $subtotal = CartDetail::where('customer_id', $auth->id)->sum('subharga');
        $totalpembayaran = CartDetail::where('customer_id', $auth->id)->sum('subharga');

        $updatecart = Cart::where('customer_id', $auth->id)->update([
            'subtotal' => $subtotal,
            'total_pembayaran' => $totalpembayaran
        ]);

        if ($updatecart) {
            return redirect('/checkout')->with('toast_success', 'Silahkan cek pesanan');
        } else {
            return back()->with('toast_warning', 'ada kesalahan');
        }
    }
}
