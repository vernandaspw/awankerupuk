<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukBrand;
use App\Models\ProdukKategori;
use App\Models\ProdukStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $datas = Produk::latest()->with(['kategori', 'brand'])->get();
        return view('pages.offices.produk.index', compact('datas'));
    }
    public function create()
    {
        $kategoris = ProdukKategori::get();
        $brands = ProdukBrand::get();
        return view('pages.offices.produk.create', compact('kategoris', 'brands'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'img_url' => 'mimes:png,jpg',
            'nama' => 'required|string',
            'produk_kategori_id' => 'required',
            'produk_brand_id' => 'required',
            'harga_pokok' => '',
            'harga_jual' => 'required',
            'stok_gudang' => '',
            'stok_toko' => '',
            'keterangan' => ''
        ]);
        if ($request->hasFile('img_url')) {
            $gambar = Storage::putFile('produk', $request->file('img_url'));
        } else {
            $gambar = null;
        }
        $data =  Produk::create([
            'img_url' => $gambar,
            'nama' => $request->nama,
            'produk_kategori_id' => $request->produk_kategori_id,
            'produk_brand_id' => $request->produk_brand_id,
            'harga_pokok' => $request->harga_pokok == null ? 0 : $request->harga_pokok,
            'harga_jual' => $request->harga_jual,
            'stok_gudang' => $request->stok_gudang == null ? 0 : $request->stok_gudang,
            'stok_toko' => $request->stok_toko == null ? 0 : $request->stok_toko,
            'keterangan' => $request->keterangan
        ]);
        if ($data) {
            return redirect('office/produk')->withSuccess('Berhasil menambahkan data' . $request->nama);
        } else {
            return back()->with('warning', 'Gagal menambahkan data');
        }
    }
    public function edit($id)
    {
        $data = Produk::findOrFail($id);
        $kategoris = ProdukKategori::get();
        $brands = ProdukBrand::get();
        return view('pages.offices.produk.edit', compact('data', 'kategoris', 'brands'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'img_url' => 'mimes:png,jpg,jpeg',
            'nama' => 'required|string',
            'produk_kategori_id' => 'required',
            'produk_brand_id' => 'required',
            'harga_pokok' => '',
            'harga_jual' => 'required',
            // 'stok_gudang' => '',
            // 'stok_toko' => '',
            'keterangan' => ''
        ]);
        $data =  Produk::findOrFail($id);
        if ($request->hasFile('img_url')) {
            Storage::delete($data->img_url);
            $gambar = Storage::putFile('produk', $request->file('img_url'));
        } else {
            $gambar = $data->img_url;
        }
        $cek = $data->update([
            'img_url' => $gambar,
            'nama' => $request->nama,
            'produk_kategori_id' => $request->produk_kategori_id,
            'produk_brand_id' => $request->produk_brand_id,
            'harga_pokok' => $request->harga_pokok == null ? 0 : $request->harga_pokok,
            'harga_jual' => $request->harga_jual,
            // 'stok_gudang' => $request->stok_gudang == null ? 0 : $request->stok_gudang,
            // 'stok_toko' => $request->stok_toko == null ? 0 : $request->stok_toko,
            'keterangan' => $request->keterangan
        ]);
        if ($cek) {
            return back()->withSuccess('Berhasil edit data' . $request->nama);
        } else {
            return back()->with('warning', 'Gagal edit data');
        }
    }
    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        if ($data->img_url == null) {
            $status = $data->delete();
            if ($status) {
                return back()->withSuccess('Berhasil hapus data ' . $data->name);
            } else {
                return back()->with('warning', 'Gagal hapus data');
            }
        } else {
            $hapusgambar = Storage::delete($data->img_url);
            if ($hapusgambar) {
                $status = $data->delete();
                if ($status) {
                    return back()->withSuccess('Berhasil hapus data ' . $data->name);
                } else {
                    return back()->with('warning', 'Gagal hapus data');
                }
            } else {
                return back()->with('warning', 'Gagal hapus gambar');
            }
        }
    }

    public function tambahstokgudang(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'qty' => 'required',
            'keterangan' => ''
        ]);

        $produkstok = ProdukStok::create([
            'posisi' => 'gudang',
            'status' => 'masuk',
            'produk_id' => $request->produk_id,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan == null ? null : $request->keterangan,
            'isPindah' => null,
        ]);

        if ($produkstok) {
            $dataproduk = Produk::findOrFail($request->produk_id);
            $produk = $dataproduk->update([
                'stok_gudang' => $dataproduk->stok_gudang + $request->qty
            ]);
            if ($produk) {
                return redirect('office/produk')->withSuccess('Berhasil menambahkan stok produk ' .  $dataproduk->nama . '<br>' . 'stok bertambah: ' . $request->qty . '<br>' . 'lalu stok gudang menjadi: ' . $dataproduk->stok_gudang);
            } else {
                return back()->with('warning', 'Gagal memperbarui stok gudang produk');
            }
        } else {
            return back()->with('warning', 'Gagal menambahkan stok produk');
        }
    }

    public function transferstokproduk(Request $request)
    {
        $request->validate([
            'posisi' => 'required',
            'produk_id' => 'required',
            'isPindah' => 'required'
        ]);

        if ($request->posisi == 'toko' && $request->isPindah == 'ketoko') {
            return back()->with('warning', 'Posisi awal dan lokasi pindah tidak boleh sama');
        }

        if ($request->posisi == 'gudang' && $request->isPindah == 'kegudang') {
            return back()->with('warning', 'Posisi awal dan lokasi pindah tidak boleh sama');
        }

        if ($request->posisi == 'toko' && $request->isPindah == 'kegudang') {
            $produkstokbuat = ProdukStok::create([
                'posisi' => $request->posisi,
                'status' => 'pindah',
                'produk_id' => $request->produk_id,
                'qty' => $request->qty,
                'isPindah' => $request->isPindah,
                'keterangan' => $request->keterangan == null ? null : $request->keterangan
            ]);
            if ($produkstokbuat) {
                $dataproduk = Produk::findOrFail($request->produk_id);
                $produkstoktoko = $dataproduk->update([
                    'stok_gudang' => $dataproduk->stok_gudang + $request->qty,
                    'stok_toko' => $dataproduk->stok_toko - $request->qty
                ]);
                if ($produkstoktoko) {
                    return redirect('office/produk')->withSuccess('Berhasil memindahkan ' . $request->qty . ' dari ' . $request->posisi . ' ' . $request->isPindah);
                } else {
                    return back()->with('warning', 'Gagal memperbarui stok produk');
                }
            } else {
                return back()->with('warning', 'gagal menambah produk stok');
            }
        }
        if ($request->posisi == 'gudang' && $request->isPindah == 'ketoko') {
            $produkstokbuat = ProdukStok::create([
                'posisi' => $request->posisi,
                'status' => 'pindah',
                'produk_id' => $request->produk_id,
                'qty' => $request->qty,
                'isPindah' => $request->isPindah,
                'keterangan' => $request->keterangan == null ? null : $request->keterangan
            ]);
            if ($produkstokbuat) {
                $dataproduk = Produk::findOrFail($request->produk_id);
                $produkstoktoko = $dataproduk->update([
                    'stok_gudang' => $dataproduk->stok_gudang - $request->qty,
                    'stok_toko' => $dataproduk->stok_toko + $request->qty
                ]);
                if ($produkstoktoko) {
                    return redirect('office/produk')->withSuccess('Berhasil memindahkan ' . $request->qty . ' dari ' . $request->posisi . ' ' . $request->isPindah);
                } else {
                    return back()->with('warning', 'Gagal memindahkan stok produk');
                }
            } else {
                return back()->with('warning', 'gagal menambah produk stok');
            }
        }
    }

    public function sesuaikanstok(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'stok_gudang' => '',
            'stok_toko' => ''
        ]);

        $produkresult = Produk::findOrFail($request->produk_id);
        $proses = $produkresult->update([
            'stok_gudang' => $request->stok_gudang == null ? $produkresult->stok_gudang : $request->stok_gudang,
            'stok_toko' => $request->stok_toko == null ? $produkresult->stok_toko : $request->stok_toko
        ]);

        if ($proses) {
            return redirect('office/produk')->withSuccess('Berhasil menyesuaikan stok produk di ' . $request->stok_gudang == null ? 'Gudang' : 'Toko' . ' <br> Jumlah produk' . $request->qty . ' ' . $request->isPindah);
        } else {
            return back()->with('warning', 'Gagal menyesuaikan stok produk');
        }
    }
}
