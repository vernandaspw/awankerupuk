@extends('layouts.offices')

@section('content')

<!-- Page Heading -->
<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Lihat data akun {{ $data->name }}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ url('/office/akunoffice/store') }}">
            @method('PUT')
            @csrf
            <br>
            <div class="form-group">
                <input disabled value="{{ $data->name }}" name='name' type="text"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled value="{{ $data->nohp }}" name='nohp' type="number"
                    class="form-control @error('noHP') is-invalid @enderror" placeholder="Nomor HP">
                @error('noHP')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled value="{{ $data->email }}" name='email' type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Alamat email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled name='password' type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled value="{{ $data->provinsi }}" name='provinsi' type="text"
                    class="form-control @error('provinsi') is-invalid @enderror" placeholder="provinsi">
                @error('provinsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled value="{{ $data->kota }}" name='kota' type="text"
                    class="form-control @error('kota') is-invalid @enderror" placeholder="kota">
                @error('kota')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input disabled value="{{ $data->kecamatan }}" name='kecamatan' type="text"
                    class="form-control @error('kecamatan') is-invalid @enderror" placeholder="kecamatan">
                @error('kecamatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" id="" cols="30"
                    rows="5">{{ $data->alamat == null ? 'alamat' : $data->alamat }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/akuncustomer') }}" class="btn btn-secondary" type="button">Kembali</a>
            {{-- <button type="submit" class="btn btn-success text-white">Tambah</button> --}}

        </form>
    </div>
</div>
@endsection
