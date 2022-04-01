@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit data satuan</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/satuan/update', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <label for="nama">Nama Satuan</label>
                <input id="nama" value="{{ $data->nama }}" name='nama' type="text"
                    class="form-control @error('nama') is-invalid @enderror" placeholder="Atas nama rekening">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/satuan') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
