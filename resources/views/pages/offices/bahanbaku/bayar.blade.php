@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Bayar bahan baku</h1>
    </div>

    <div class="card-body">

        <div class="form-group">
            <label for="Perusahaan">Supplier</label>
            <input type="text" class="form-control" disabled value="{{ $datas->supplier->name }}">
        </div>
        <div class="form-group">
            <label for="Perusahaan">No telp supplier</label>
            <input type="text" class="form-control" disabled value="{{ $datas->supplier->no_telp }}">
        </div>

        <div class="form-group">
            <label for="catatan pesanan">Catatan pesanan</label>
            <textarea disabled name="catatan" class="form-control @error('catatan') is-invalid @enderror" id=" catatan"
                cols="30" rows="5" placeholder="catatan">{{ old('catatan', $datas->catatan) }}</textarea>
            @error('catatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>



        <div class="form-group">
            <label for="">Biaya antar : </label>
            @uang($datas->biaya_antar)
        </div>
        <div class="form-group">
            <label for="">Total harga bahan produk : </label>
            @uang($datas->total_harga)
        </div>
        <div class="form-group text-danger">
            <label for="">Total pembayaran : </label>
            @uang($datas->total_pembayaran)
        </div>
        <div class="form-group">
            <label for="">Silahkan transfer sejumlah : </label>
            @uang($datas->total_pembayaran)
            @if ($datas->metode == 'transfer')
            <div>
                Ke {{ $datas->supplier->bank }}
            </div>

            <div>No :{{ $datas->supplier->norek }}</div>
            <div>Atas nama : {{ $datas->supplier->an }}</div>
            @endif
        </div>



        <br>
        <a href="{{ url('office/pesanan-saya/sdhbayar',$datas->id) }}" class="btn btn-success" type="button"
            data-dismiss="modal">Konfirm
            Sudah bayar</a>
        <a href="{{ url('office/pesanan-saya') }}" class="btn btn-white" type="button" data-dismiss="modal">Kembali</a>


    </div>
</div>
@endsection

@push('script')

@endpush
