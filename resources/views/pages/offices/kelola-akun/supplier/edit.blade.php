@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-body">
        <h1 class="h3 mb-2 text-gray-800">Edit data akun {{ $data->name }}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ url('office/akunsupplier/update', $data->id) }}">
            @method('PUT')
            @csrf
            <br>
            <div class="form-group">
                <input value='{{ $data->name }}' name='name' type="text"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <input value='{{ $data->email }}' name='email' type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Alamat email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='password' type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->no_telp }}' name='no_telp' type="number"
                    class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telp">
                @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->provinsi }}' name='provinsi' type="text"
                    class="form-control @error('provinsi') is-invalid @enderror" placeholder="Provinsi">
                @error('provinsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->kota }}' name='kota' type="text"
                    class="form-control @error('kota') is-invalid @enderror" placeholder="Kota">
                @error('kota')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->kecamatan }}' name='kecamatan' type="text"
                    class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Kecamatan">
                @error('kecamatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->alamat }}' name='alamat' type="text"
                    class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->bank }}' name='bank' type="text"
                    class="form-control @error('bank') is-invalid @enderror" placeholder="Bank">
                @error('bank')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->an }}' name='atas_nama' type="text"
                    class="form-control @error('atas_nama') is-invalid @enderror" placeholder="Atas Nama">
                @error('atas_nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value='{{ $data->norek }}' name='no_rek' type="number"
                    class="form-control @error('no_rek') is-invalid @enderror" placeholder="Nomor Rekening">
                @error('no_rek')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/akunsupplier') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
