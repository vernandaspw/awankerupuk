@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Pesan bahan baku</h1>
    </div>

    <div class="card-body">



        <div class="form-group">
            <select disabled required id="supplier_id" name='supplier_id'
                class="form-control @error('supplier_id') is-invalid @enderror">


                <option value="{{ $datas->supplier->id }}">{{ $datas->supplier->name }}</option>

            </select>
            @error('supplier_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <input disabled value="{{ old('no_telp', $datas->no_telp) }}" name='no_telp' type="text"
                class="form-control @error('no_telp') is-invalid @enderror" placeholder="No telp ">

            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <input disabled value="{{ old('alamat', $datas->alamat) }}" name='alamat' type="text"
                class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat ">

            @error('alamat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <textarea disabled name="catatan" class="form-control @error('catatan') is-invalid @enderror" id=" catatan"
                cols="30" rows="5" placeholder="catatan">{{ old('catatan', $datas->catatan) }}</textarea>
            @error('catatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <table class="table table-bordered" id="dynamicTable">
            <tr>
                <th>Bahan baku</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total harga</th>
            </tr>
            @foreach ($datas->details as $detail)
            <tr>
                <td><input disabled value="{{ $detail->nama_bahan }}" required type="text" name="addmore[0][name]"
                        placeholder="Enter bahan baku" class="form-control" />
                </td>
                <td><input disabled value="{{ $detail->qty }}" type="number" required name="addmore[0][qty]"
                        placeholder="Enter your Qty" class="form-control" />
                </td>
                <td>@uang($detail->harga)
                </td>
                <td>@uang($detail->total_harga)
                </td>

            </tr>
            @endforeach
        </table>

        {{-- buat detail --}}





        <br>
        <a href="{{ url('office/bahan') }}" class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</a>


    </div>
</div>
@endsection

@push('script')

@endpush
