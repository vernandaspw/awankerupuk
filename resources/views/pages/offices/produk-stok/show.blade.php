@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Lihat produk Stok detail{{ $data->nama }}</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/produk/update', $data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <br>
            <h4>Data produk</h4>
            <div class="form-group">
                <div class="form-group">
                    @if ($data->produk->img_url != null)
                    <img id="preview_img" src="{{ Storage::url($data->produk->img_url) }}" class="" width="200"
                        height="150" />
                    @else
                    <img id="preview_img" src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class=""
                        width="200" height="150" />
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="">Nama Produk</label>
                <input disabled value="{{ old('nama', $data->produk->nama) }}" name='nama' type="text"
                    class="form-control" placeholder="Nama Produk">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Stok gudang</label>
                        <input disabled value="{{ old('nama', $data->produk->stok_gudang) }}" name='nama' type="text"
                            class="form-control" placeholder="Nama Produk">
                    </div>

                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Stok toko</label>
                        <input disabled value="{{ old('nama', $data->produk->stok_toko) }}" name='nama' type="text"
                            class="form-control" placeholder="Nama Produk">
                    </div>
                </div>
            </div>
            <hr>
            <h4>Perubahan Stok</h4>
            <div class="form-group">
                <label for="">Status</label>
                <input disabled value="{{ old('nama', $data->status) }}" name='nama' type="text" class="form-control"
                    placeholder="Nama Produk">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Posisi Stok</label>
                        <input disabled value="{{ old('nama', $data->posisi) }}" name='nama' type="text"
                            class="form-control" placeholder="Nama Produk">
                    </div>
                </div>
                <div class="col-6">
                    @if ($data->isPindah != null)
                    <div class="form-group">
                        <label for="">Pindah Stok ke</label>
                        <input disabled value="{{ old('nama', $data->isPindah) }}" name='nama' type="text"
                            class="form-control" placeholder="">
                    </div>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="">Jumlah Stok masuk/keluar/pindah</label>
                <input disabled value="{{ old('nama', $data->qty) }}" name='nama' type="text" class="form-control"
                    placeholder="Nama Produk">
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea disabled class="form-control" name="" id="" cols="30"
                    rows="10">{{ old('nama', $data->keterangan) }}</textarea>
            </div>




            <br>
            <a href="{{ url('office/produk-stok') }}" class="btn btn-secondary" type="button">Kembali</a>


        </form>
    </div>
</div>
@endsection
