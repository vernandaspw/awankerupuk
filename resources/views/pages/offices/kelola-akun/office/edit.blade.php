@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit data akun {{ $data->name }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/office/akunoffice/update', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <input value="{{ $data->name }}" name='name' type="text"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value="{{ $data->noHP }}" name='nohp' type="number"
                    class="form-control @error('noHP') is-invalid @enderror" placeholder="Nomor HP">
                @error('noHP')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value="{{ $data->email }}" name='email' type="email"
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
                <select id="role" name='role' class="form-control @error('role') is-invalid @enderror">
                    <option value="">-Pilih Role-</option>
                    <option value="admin" @if ($data->role == 'admin')
                        selected
                        @endif>Admin</option>
                    <option value="produksi" @if ($data->role == 'produksi')
                        selected
                        @endif >Produksi</option>
                    <option value="gudang" @if ($data->role == 'gudang')
                        selected
                        @endif>Gudang</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <select id="isAktif" name='isAktif' class="form-control @error('isAktif') is-invalid @enderror">
                    <option value="">-Pilih status-</option>
                    <option value="1" @if ($data->isAktif == '1')
                        selected
                        @endif>Aktif</option>
                    <option value="0" @if ($data->isAktif == '0')
                        selected
                        @endif>Tidak aktif</option>
                </select>
                @error('isAktif')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/akunoffice') }}" class="btn btn-secondary" type="button">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
