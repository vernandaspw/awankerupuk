<?php

use App\Http\Controllers\Customer\CAkunController;
use App\Http\Controllers\Customer\CAuthController;
use App\Http\Controllers\Customer\CBerandaController;
use App\Http\Controllers\Customer\CCartController;
use App\Http\Controllers\Customer\CCheckoutController;
use App\Http\Controllers\Customer\CKontakController;
use App\Http\Controllers\Customer\CPesananController;
use App\Http\Controllers\Customer\CProdukController;
use App\Http\Controllers\Customer\CTentangController;
use App\Http\Controllers\Office\BahanBakuController;
use App\Http\Controllers\Office\BahansController;
use App\Http\Controllers\Office\KelolaAkunCustomerController;
use App\Http\Controllers\Office\KelolaAkunOfficeController;
use App\Http\Controllers\Office\KelolaAkunSupplierController;
use App\Http\Controllers\Office\MetodePembayaranController;
use App\Http\Controllers\Office\OAuthController;
use App\Http\Controllers\Office\ODashboardController;
use App\Http\Controllers\Office\OPesanController;
use App\Http\Controllers\Office\PesananController;
use App\Http\Controllers\Office\ProdukBrandController;
use App\Http\Controllers\Office\ProdukController;
use App\Http\Controllers\Office\ProdukKategoriController;
use App\Http\Controllers\Office\ProdukStokController;
use App\Http\Controllers\Office\SatuanController;
use App\Http\Controllers\Office\SBahanController;
use App\Http\Controllers\Office\SettingController;
use App\Http\Controllers\Supplier\SAuthController;
use App\Http\Controllers\Supplier\SBahanBakuController;
use App\Http\Controllers\Supplier\SBahanBrandController;
use App\Http\Controllers\Supplier\SBahanController as SupplierSBahanController;
use App\Http\Controllers\Supplier\SBahanKategoriController;
use App\Http\Controllers\Supplier\SDashboardController;
use App\Http\Controllers\Supplier\SMetodeController;
use App\Http\Controllers\Supplier\SPesanController;
use App\Http\Livewire\Cartlivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', [CBerandaController::class, 'index']);
Route::get('kategori/{id}', [CBerandaController::class, 'kategoriid']);
Route::get('auth', [CAuthController::class, 'index']);
Route::post('auth/masuk', [CAuthController::class, 'masuk']);
Route::post('auth/daftar', [CAuthController::class, 'daftar']);

Route::get('produk/{id}', [CProdukController::class, 'show']);
Route::get('tentang', [CTentangController::class, 'index']);
Route::get('kontak', [CKontakController::class, 'index']);

Route::middleware(['auth:customer'])->group(function () {
    Route::get('auth/keluar', [CAuthController::class, 'keluar']);
    Route::get('cart', [CCartController::class, 'index']);
    Route::get('addtocart/{produkid}', [CCartController::class, 'addtocart']);
    Route::get('tambahqty/{cartdetailid}', [CCartController::class, 'tambahqty']);
    Route::get('kurangqty/{cartdetailid}', [CCartController::class, 'kurangqty']);
    Route::get('deletecart/{cartdetailid}', [CCartController::class, 'deleteprodukcart']);

    Route::get('check', [CCartController::class, 'checkout']);
    Route::get('checkout', [CCheckoutController::class, 'index']);
    Route::post('buatpesanan', [CCheckoutController::class, 'buatpesanan']);

    Route::get('pesanan', [CPesananController::class, 'index']);
    Route::get('pesanan/lihat/{id}', [CPesananController::class, 'lihat']);
    Route::get('pesanan/konfirm/{id}', [CPesananController::class, 'konfirm']);
    Route::get('pesanan/batal/{id}', [CPesananController::class, 'batal']);
    Route::get('pesanan/terima/{id}', [CPesananController::class, 'terima']);

    Route::get('akun', [CAkunController::class, 'index']);
});

Route::prefix('office')->group(function () {
    Route::get('/', [ODashboardController::class, 'index']);
    Route::post('login', [OAuthController::class, 'masuk']);

    Route::middleware(['auth:office'])->group(function () {
        Route::get('logout', [OAuthController::class, 'keluar']);

        Route::get('pesanan', [PesananController::class, 'index']);
        Route::get('pesanan/batal/{id}', [PesananController::class, 'batal']);
        Route::get('pesanan/selesai/{id}', [PesananController::class, 'selesai']);
        Route::get('pesanan/konfirm/{id}', [PesananController::class, 'confirm']);
        Route::get('pesanan/kirim/{id}', [PesananController::class, 'kirim']);

        Route::get('akuncustomer', [KelolaAkunCustomerController::class, 'index']);
        Route::get('akuncustomer/{id}', [KelolaAkunCustomerController::class, 'show']);

        Route::get('akunoffice', [KelolaAkunOfficeController::class, 'index']);
        Route::get('akunoffice/create', [KelolaAkunOfficeController::class, 'create']);
        Route::post('akunoffice/store', [KelolaAkunOfficeController::class, 'store']);
        Route::get('akunoffice/edit/{id}', [KelolaAkunOfficeController::class, 'edit']);
        Route::put('akunoffice/update/{id}', [KelolaAkunOfficeController::class, 'update']);
        Route::delete('akunoffice/delete/{id}', [KelolaAkunOfficeController::class, 'destroy']);

        Route::get('akunsupplier', [KelolaAkunSupplierController::class, 'index']);
        Route::get('akunsupplier/create', [KelolaAkunSupplierController::class, 'create']);
        Route::post('akunsupplier/store', [KelolaAkunSupplierController::class, 'store']);
        Route::get('akunsupplier/edit/{id}', [KelolaAkunSupplierController::class, 'edit']);
        Route::put('akunsupplier/update/{id}', [KelolaAkunSupplierController::class, 'update']);
        Route::delete('akunsupplier/delete/{id}', [KelolaAkunSupplierController::class, 'destroy']);


        Route::get('produk-kategori', [ProdukKategoriController::class, 'index']);
        Route::get('produk-kategori/create', [ProdukKategoriController::class, 'create']);
        Route::post('produk-kategori/store', [ProdukKategoriController::class, 'store']);
        Route::get('produk-kategori/edit/{id}', [ProdukKategoriController::class, 'edit']);
        Route::put('produk-kategori/update/{id}', [ProdukKategoriController::class, 'update']);
        Route::delete('produk-kategori/delete/{id}', [ProdukKategoriController::class, 'destroy']);

        Route::get('produk-brand', [ProdukBrandController::class, 'index']);
        Route::get('produk-brand/create', [ProdukBrandController::class, 'create']);
        Route::post('produk-brand/store', [ProdukBrandController::class, 'store']);
        Route::get('produk-brand/edit/{id}', [ProdukBrandController::class, 'edit']);
        Route::put('produk-brand/update/{id}', [ProdukBrandController::class, 'update']);
        Route::delete('produk-brand/delete/{id}', [ProdukBrandController::class, 'destroy']);

        Route::get('bahans/kategori/{id}', [BahansController::class, 'kategori']);

        Route::get('bahans', [BahansController::class, 'index']);
        Route::get('bahans/detail/{id}', [BahansController::class, 'detail']);
        Route::get('bahans/cart', [BahansController::class, 'cart']);
        Route::get('bahans/addtocart/{id}', [BahansController::class, 'addtocart']);
        Route::get('bahans/cart/hapus/{id}', [BahansController::class, 'deleteitemcart']);
        Route::get('bahans/cart/ubahqty/{id}', [BahansController::class, 'ubahqty']);
        Route::put('bahans/updateqty/{id}', [BahansController::class, 'updateqty']);
        Route::get('bahans/cart/checkout', [BahansController::class, 'checkout']);
        Route::put('bahans/cart/checkout/save/{id}', [BahansController::class, 'save']);
        Route::get('bahans/buatpesanan', [BahansController::class, 'buatpesanan']);

        Route::get('bahan', [BahanBakuController::class, 'index']);
        Route::get('pesanbahan/create', [BahanBakuController::class, 'create']);
        Route::post('pesanbahan/store', [BahanBakuController::class, 'store']);
        Route::get('bahan/lihat/{id}', [BahanBakuController::class, 'lihat']);
        Route::get('bahan/pesan/{id}', [BahanBakuController::class, 'pesan']);
        Route::get('bahan/terima/{id}', [BahanBakuController::class, 'terima']);
        Route::get('bahan/edit/{id}', [BahanBakuController::class, 'edit']);
        Route::delete('bahan/delete/{id}', [BahanBakuController::class, 'destroy']);



        Route::get('produk', [ProdukController::class, 'index']);
        Route::get('produk/create', [ProdukController::class, 'create']);
        Route::post('produk/store', [ProdukController::class, 'store']);
        Route::get('produk/edit/{id}', [ProdukController::class, 'edit']);
        Route::put('produk/update/{id}', [ProdukController::class, 'update']);
        Route::delete('produk/delete/{id}', [ProdukController::class, 'destroy']);
        Route::post('produk/tambahstokgudang', [ProdukController::class, 'tambahstokgudang']);
        Route::post('produk/transferstokproduk', [ProdukController::class, 'transferstokproduk']);
        Route::post('produk/sesuaikanstok', [ProdukController::class, 'sesuaikanstok']);

        Route::get('produk-stok', [ProdukStokController::class, 'index']);
        Route::get('produk-stok/show/{id}', [ProdukStokController::class, 'show']);
        Route::delete('produk-stok/delete/{id}/{produk_id}', [ProdukStokController::class, 'destroy']);

        Route::get('metode', [MetodePembayaranController::class, 'index']);
        Route::get('metode/create', [MetodePembayaranController::class, 'create']);
        Route::post('metode/store', [MetodePembayaranController::class, 'store']);
        Route::get('metode/edit/{id}', [MetodePembayaranController::class, 'edit']);
        Route::put('metode/update/{id}', [MetodePembayaranController::class, 'update']);
        Route::delete('metode/delete/{id}', [MetodePembayaranController::class, 'destroy']);

        Route::get('satuan', [SatuanController::class, 'index']);
        Route::get('satuan/create', [SatuanController::class, 'create']);
        Route::post('satuan/store', [SatuanController::class, 'store']);
        Route::get('satuan/edit/{id}', [SatuanController::class, 'edit']);
        Route::put('satuan/update/{id}', [SatuanController::class, 'update']);
        Route::delete('satuan/delete/{id}', [SatuanController::class, 'destroy']);

        Route::get('setting', [SettingController::class, 'edit']);
        Route::put('setting/update/{id}', [SettingController::class, 'update']);

        Route::get('pesanan-saya', [OPesanController::class, 'index']);
        Route::get('pesanan-saya/bayar/{id}', [OPesanController::class, 'bayar']);
        Route::get('pesanan-saya/sdhbayar/{id}', [OPesanController::class, 'sdhbayar']);
        Route::get('pesanan-saya/terima/{id}', [OPesanController::class, 'terima']);
        Route::get('pesanan-saya/batal/{id}', [OPesanController::class, 'batal']);
        Route::get('pesanan-saya/detail/{id}', [OPesanController::class, 'detail']);
        Route::post('pesanan-saya/rating/{id}', [OPesanController::class, 'rating']);
    });
});

Route::prefix('supplier')->group(function () {
    Route::get('/', [SDashboardController::class, 'index']);
    Route::post('login', [SAuthController::class, 'masuk']);

    Route::middleware(['auth:supplier'])->group(function () {
        Route::get('logout', [SAuthController::class, 'keluar']);

        Route::get('pesanan', [SPesanController::class, 'index']);
        Route::get('pesanan/beriharga/{id}', [SPesanController::class, 'beriharga']);
        Route::put('pesanan/biayaantar/{id}', [SPesanController::class, 'biayaantar']);
        Route::put('pesanan/beriharga/proses/{id}', [SPesanController::class, 'beriharga_proses']);
        Route::get('pesanan/perbarui/{id}', [SPesanController::class, 'perbarui']);
        Route::get('pesanan/tagih/{id}', [SPesanController::class, 'tagih']);
        Route::get('pesanan/kirim/{id}', [SPesanController::class, 'kirim']);
        Route::get('pesanan/selesai/{id}', [SPesanController::class, 'selesai']);
        Route::get('pesanan/batal/{id}', [SPesanController::class, 'batal']);


        Route::get('bahans', [SupplierSBahanController::class, 'index']);
        Route::get('bahans/create', [SupplierSBahanController::class, 'create']);
        Route::post('bahans/store', [SupplierSBahanController::class, 'store']);
        Route::get('bahans/edit/{id}', [SupplierSBahanController::class, 'edit']);
        Route::put('bahans/update/{id}', [SupplierSBahanController::class, 'update']);
        Route::delete('bahans/delete/{id}', [SupplierSBahanController::class, 'destroy']);

        Route::get('bahan-kategori', [SBahanKategoriController::class, 'index']);
        Route::get('bahan-kategori/create', [SBahanKategoriController::class, 'create']);
        Route::post('bahan-kategori/store', [SBahanKategoriController::class, 'store']);
        Route::get('bahan-kategori/edit/{id}', [SBahanKategoriController::class, 'edit']);
        Route::put('bahan-kategori/update/{id}', [SBahanKategoriController::class, 'update']);
        Route::delete('bahan-kategori/delete/{id}', [SBahanKategoriController::class, 'destroy']);

        Route::get('bahan-brand', [SBahanBrandController::class, 'index']);
        Route::get('bahan-brand/create', [SBahanBrandController::class, 'create']);
        Route::post('bahan-brand/store', [SBahanBrandController::class, 'store']);
        Route::get('bahan-brand/edit/{id}', [SBahanBrandController::class, 'edit']);
        Route::put('bahan-brand/update/{id}', [SBahanBrandController::class, 'update']);
        Route::delete('bahan-brand/delete/{id}', [SBahanBrandController::class, 'destroy']);

        Route::get('metode', [SMetodeController::class, 'index']);
        Route::get('metode/create', [SMetodeController::class, 'create']);
        Route::post('metode/store', [SMetodeController::class, 'store']);
        Route::get('metode/edit/{id}', [SMetodeController::class, 'edit']);
        Route::put('metode/update/{id}', [SMetodeController::class, 'update']);
        Route::delete('metode/delete/{id}', [SMetodeController::class, 'destroy']);

        Route::get('bahan', [SBahanBakuController::class, 'index']);
        Route::get('bahan/edit/{id}', [SBahanBakuController::class, 'edit']);
        Route::get('bahan/kirim/{id}', [SBahanBakuController::class, 'kirim']);
        Route::get('bahan/selesai/{id}', [SBahanBakuController::class, 'selesai']);
        Route::get('bahan/batal/{id}', [SBahanBakuController::class, 'batal']);
        Route::put('bahan/beriharga/{id}', [SBahanBakuController::class, 'beriharga']);
    });
});
