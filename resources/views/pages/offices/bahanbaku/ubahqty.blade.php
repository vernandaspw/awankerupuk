@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Ubah qty</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/bahans/updateqty', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <label for="metode">Ubah qty</label>
                <input min="1" id="qty" value="{{ $data->qty }}" name='qty' type="number"
                    class="form-control @error('qty') is-invalid @enderror" placeholder="qty">
                @error('qty')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <br>
            <a href="{{ url('office/bahans/cart') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
