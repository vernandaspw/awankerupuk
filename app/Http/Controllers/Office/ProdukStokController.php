<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukStok;
use Illuminate\Http\Request;

class ProdukStokController extends Controller
{
    public function index()
    {
        $datas = ProdukStok::with('produk')->latest()->get();
        return view('pages.offices.produk-stok.index', compact('datas'));
    }
    public function show($id)
    {
        $data = ProdukStok::with('produk')->findOrFail($id);
        return view('pages.offices.produk-stok.show', compact('data'));
    }
    public function destroy(Request $request, $id, $produk_id)
    {
        $stok = ProdukStok::findOrFail($id);
        if ($stok != null) {
            if ($stok->status == 'masuk') {
                $stok2 = ProdukStok::findOrFail($id);
                if ($stok2->posisi == 'gudang') {
                    $produk = Produk::findOrFail($produk_id);
                    $cek = $produk->update([
                        'stok_gudang' => $produk->stok_gudang - $stok2->qty
                    ]);
                    if ($cek) {
                        $status = ProdukStok::findOrFail($id)->delete();
                        if ($status) {
                            return redirect('office/produk-stok')->withSuccess('Berhasil hapus riwayat stok gudang');
                        } else {
                            return back()->with('warning', 'Gagal hapus riwayat stok gudang');
                        }
                    } else {
                        return back()->with('warning', 'Gagal hapus stok produk');
                    }
                }
            } elseif ($stok->status == 'keluar') {
                //
            } elseif ($stok->status == 'pindah') {
                if ($stok->posisi == 'toko' && $stok->isPindah == 'kegudang') {
                    $stok = ProdukStok::findOrFail($id);
                    $produk = Produk::findOrFail($produk_id);
                    $update = $produk->update([
                        'stok_toko' => $produk->stok_toko + $stok->qty,
                        'stok_gudang' => $produk->stok_gudang - $stok->qty
                    ]);
                    if ($update) {
                        $status = ProdukStok::findOrFail($id)->delete();
                        if ($status) {
                            return redirect('office/produk-stok')->withSuccess('Berhasil hapus riwayat stok transfer');
                        } else {
                            return back()->with('warning', 'Gagal hapus riwayat stok transfer');
                        }
                    } else {
                        return back()->with('warning', 'Gagal hapus stok produk');
                    }
                } elseif ($stok->posisi == 'gudang' && $stok->isPindah == 'ketoko') {
                    $stok = ProdukStok::findOrFail($id);
                    $produk = Produk::findOrFail($produk_id);
                    $update = $produk->update([
                        'stok_toko' => $produk->stok_toko - $stok->qty,
                        'stok_gudang' => $produk->stok_gudang + $stok->qty
                    ]);
                    if ($update) {
                        $status = ProdukStok::findOrFail($id)->delete();
                        if ($status) {
                            return redirect('office/produk-stok')->withSuccess('Berhasil hapus riwayat stok transfer');
                        } else {
                            return back()->with('warning', 'Gagal hapus riwayat stok transfer');
                        }
                    } else {
                        return back()->with('warning', 'Gagal hapus stok produk');
                    }
                }
            }
        }
    }
}
