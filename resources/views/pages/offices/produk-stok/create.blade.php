@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah produk</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('office/produk/store') }}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <img id="preview_img" src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class=""
                        width="200" height="150" />
                    <div class="custom-file mt-2">
                        <input value="{{ old('img_url') }}" name="img_url" type="file"
                            class="custom-file-input   @error('img_url') is-invalid @enderror" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" onchange="loadPreview(this);">
                        <label class="custom-file-label" for="inputGroupFile01">Ganti gambar</label>
                        @error('img_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-group">
                <input value="{{ old('nama') }}" name='nama' type="text"
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Produk">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="produk_kategori_id" name='produk_kategori_id'
                    class="form-control @error('produk_kategori_id') is-invalid @enderror">
                    <option value="">-Pilih Kategori-</option>
                    @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('produk_kategori_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="produk_brand_id" name='produk_brand_id'
                    class="form-control @error('produk_brand_id') is-invalid @enderror">
                    <option value="">-Pilih Brand-</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->nama }}</option>
                    @endforeach
                </select>
                @error('produk_brand_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input value="{{ old('harga_pokok') }}" name='harga_pokok' type="number"
                            class="form-control @error('harga_pokok') is-invalid @enderror" placeholder="Harga pokok">
                        @error('harga_pokok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input value="{{ old('harga_jual') }}" name='harga_jual' type="number"
                            class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Harga jual">
                        @error('harga_jual')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input value="{{ old('stok_gudang') }}" name='stok_gudang' type="number"
                            class="form-control @error('stok_gudang') is-invalid @enderror"
                            placeholder="Stok Awal gudang">
                        @error('stok_gudang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input value="{{ old('stok_toko') }}" name='stok toko' type="number"
                            class="form-control @error('stok_toko') is-invalid @enderror" placeholder="Stok Awal Toko">
                        @error('stok_toko')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                    id=" keterangan" cols="30" rows="5"
                    placeholder="Keterangan produk">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/produk') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
