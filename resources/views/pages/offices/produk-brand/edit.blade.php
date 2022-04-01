@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit brand produk {{ $data->nama }}</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/produk-brand/update', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <label for="metode">Ubah nama brand</label>
                <input id="nama" value="{{ $data->nama }}" name='nama' type="text"
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Nama brand">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <br>
            <a href="{{ url('office/produk-brand') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
