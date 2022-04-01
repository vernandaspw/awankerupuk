@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit produk {{ $data->nama }}</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/produk/update', $data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <div class="form-group">
                    @if ($data->img_url != null)
                    <img id="preview_img" src="{{ Storage::url($data->img_url) }}" class="" width="200" height="150" />
                    @else
                    <img id="preview_img" src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class=""
                        width="200" height="150" />
                    @endif

                    <div class="custom-file mt-2">
                        <input value="{{ old('img_url', $data->img_url) }}" name="img_url" type="file"
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
                <input value="{{ old('nama', $data->nama) }}" name='nama' type="text"
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
                    <option value="{{ $kategori->id }}" @if (old('produk_kategori_id', $data->kategori->id) ==
                        $kategori->id)
                        selected
                        @endif>{{
                        $kategori->nama }}</option>
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
                    <option value="{{ $brand->id }}" @if (old('produk_brand_id', $data->brand->id) ==
                        $brand->id)
                        selected
                        @endif>{{ $brand->nama }}</option>
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
                        <input value="{{ old('harga_pokok', $data->harga_pokok) }}" name='harga_pokok' type="number"
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
                        <input value="{{ old('harga_jual', $data->harga_jual) }}" name='harga_jual' type="number"
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
                        <input value="{{ old('stok_gudang', $data->stok_gudang) }}" name='stok_gudang' type="number"
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
                        <input value="{{ old('stok_toko', $data->stok_toko) }}" name='stok toko' type="number"
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
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                    id="keterangan" cols="30" rows="5"
                    placeholder="Keterangan produk">{{ old('keterangan', $data->keterangan) }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/produk') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
