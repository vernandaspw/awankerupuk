@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Tambah akun office</h1>

    </div>

    <div class="card-body">

        <form method="POST" action="{{ url('/office/akunoffice/store') }}">
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
                <input name='nohp' type="number" class="form-control @error('nohp') is-invalid @enderror"
                    placeholder="Nomor HP">
                @error('nohp')
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
                <select id="role" name='role' class="form-control @error('role') is-invalid @enderror">
                    <option value="">-Pilih Role-</option>
                    <option value="admin">Admin</option>
                    <option value="produksi">Produksi</option>
                    <option value="gudang">Gudang</option>
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
                    <option value="1">Aktif</option>
                    <option value="0">Tidak aktif</option>
                </select>
                @error('isAktif')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <a href="{{ url('office/akunoffice') }}" class="btn btn-secondary" type="button"
                data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Tambah</button>

        </form>
    </div>
</div>
@endsection
