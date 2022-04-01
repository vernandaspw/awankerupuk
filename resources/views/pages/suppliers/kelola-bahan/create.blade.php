@extends('layouts.supplier')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah bahan baku</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('supplier/bahans/store') }}" enctype="multipart/form-data">
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
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama bahan baku">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="bahan_kategori_id" name='bahan_kategori_id'
                    class="form-control @error('bahan_kategori_id') is-invalid @enderror">
                    <option value="">-Pilih Kategori-</option>
                    @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('bahan_kategori_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="bahan_brand_id" name='bahan_brand_id'
                    class="form-control @error('bahan_brand_id') is-invalid @enderror">
                    <option value="">-Pilih Brand-</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->nama }}</option>
                    @endforeach
                </select>
                @error('bahan_brand_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="satuan_id" name='satuan_id' class="form-control @error('satuan_id') is-invalid @enderror">
                    <option value="">-Pilih satuan-</option>
                    @foreach ($satuans as $satuan)
                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                    @endforeach
                </select>
                @error('satuan_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                    id="summernote" cols="30" rows="5"
                    placeholder="Keterangan bahan baku">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('supplier/bahans') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
