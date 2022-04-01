@extends('layouts.supplier')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit data Metode pembayaran</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('office/metode/update', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <div class="form-group">
                    <label for="metode">Metode Pembayaran</label>
                    <select required name="metode" id="metode"
                        class="form-control @error('metode') is-invalid @enderror">
                        <option value="">-Pilih Metode Pembayaran-</option>
                        <option value="tunai" @if ($data->metode == 'tunai')
                            selected
                            @endif>Tunai</option>
                        <option value="cod" @if ($data->metode == 'cod')
                            selected
                            @endif>COD</option>
                        <option value="transfer" @if ($data->metode == 'transfer')
                            selected
                            @endif>transfer</option>
                    </select>
                    @error('metode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="keterangan">keterangan Pembayaran (bank, tunai, dompet digital)</label>
                <input id="keterangan" value="{{ $data->keterangan }}" name='keterangan' type="text"
                    class="form-control @error('keterangan') is-invalid @enderror"
                    placeholder="Bank BRI / Tunai / Dompet digital">
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="an">Atas Nama</label>
                <input id="an" value="{{ $data->an }}" name='an' type="text"
                    class="form-control @error('an') is-invalid @enderror" placeholder="Atas nama rekening">
                @error('an')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="norek">Nomor Rekening / Nomor</label>
                <input value="{{ $data->norek }}" name='norek' type="number"
                    class="form-control @error('norek') is-invalid @enderror" placeholder="Nomor Rekening / Nomor">
                @error('norek')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/metode') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
