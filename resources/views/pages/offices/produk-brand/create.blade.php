@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah Brand produk</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('office/produk-brand/store') }}">
            @method('POST')
            @csrf
            <div class="form-group">
                <input name='nama' type="text" class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Nama Brand">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/produk-brand') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
