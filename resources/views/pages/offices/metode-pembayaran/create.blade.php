@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah metode pembayaran untuk customer</h1>
    </div>

    <div class="card-body">
        <span class="text-danger">*untuk metode pembayaran cod, colum AN dan No rek tidak perlu diisi, tulis colum
            keterangan 'pembayaran ditempat'</span>
        <form method="POST" action="{{ url('office/metode/store') }}">
            @method('POST')
            @csrf
            <div class="form-group">

                <select required name="metode" id="metode" class="form-control @error('metode') is-invalid @enderror">
                    <option value="">-Pilih Metode Pembayaran-</option>
                    <option value="cod">COD</option>
                    <option value="transfer">transfer</option>
                </select>
                @error('metode')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='keterangan' type="text" class="form-control @error('keterangan') is-invalid @enderror"
                    placeholder="Bank BRI / Tunai / Dompet digital">
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='an' type="text" class="form-control @error('an') is-invalid @enderror"
                    placeholder="Atas nama rekening">
                @error('an')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='norek' type="number" class="form-control @error('norek') is-invalid @enderror"
                    placeholder="Nomor Rekening / Nomor">
                @error('norek')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <br>
            <a href="{{ url('office/metode') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
