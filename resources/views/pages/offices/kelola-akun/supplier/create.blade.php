@extends('layouts.offices')

@section('content')



<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah data akun supplier</h1>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ url('/office/akunsupplier/store') }}">
            @method('POST')
            @csrf
            <div class="form-group">
                <input name='name' type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama lengkap">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <input name='email' type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Alamat email">
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
                <input name='no_telp' type="number" class="form-control @error('no_telp') is-invalid @enderror"
                    placeholder="Nomor Telp">
                @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='provinsi' type="text" class="form-control @error('provinsi') is-invalid @enderror"
                    placeholder="Provinsi">
                @error('provinsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='kota' type="text" class="form-control @error('kota') is-invalid @enderror"
                    placeholder="Kota">
                @error('kota')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='kecamatan' type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                    placeholder="Kecamatan">
                @error('kecamatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='alamat' type="text" class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="Alamat">
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='bank' type="text" class="form-control @error('bank') is-invalid @enderror"
                    placeholder="Bank">
                @error('bank')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='atas_nama' type="text" class="form-control @error('atas_nama') is-invalid @enderror"
                    placeholder="Atas Nama">
                @error('atas_nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input name='no_rek' type="number" class="form-control @error('no_rek') is-invalid @enderror"
                    placeholder="Nomor Rekening">
                @error('no_rek')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/akunsupplier') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Cancel</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
