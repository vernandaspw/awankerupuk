@extends('layouts.supplier')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah Kategori bahan</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('supplier/bahan-kategori/store') }}">
            @method('POST')
            @csrf
            <div class="form-group">
                <input name='nama' type="text" class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Nama kategori">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('supplier/bahan-kategori') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
