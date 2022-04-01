@extends('layouts.offices')

@section('content')

<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Edit data Setting</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/office/setting/update', $data->id) }}">
            @csrf
            @method('PUT')
            <br>
            <div class="form-group">
                <label for="nama_perusahaan">Nama perusahaan</label>
                <input id="nama_perusahaan" value="{{ $data->nama_perusahaan }}" name='nama_perusahaan' type="text"
                    class="form-control @error('nama_perusahaan') is-invalid @enderror" placeholder="nama_perusahaan">
                @error('nama_perusahaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_telp">No Telp perusahaan</label>
                <input id="no_telp" value="{{ $data->no_telp }}" name='no_telp' type="number"
                    class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telp">
                @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" value="{{ $data->email }}" name='email' type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Nama lengkap">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id=""
                    cols="30" rows="3">{{ $data->alamat }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pajak">Pajak</label>
                <input id="pajak" value="{{ $data->pajak }}" name='pajak' type="number"
                    class="form-control @error('pajak') is-invalid @enderror" placeholder="Nomor HP">
                @error('pajak')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tentang">Tentang Perusahaan</label>
                <textarea id="tentang" class="form-control @error('tentang') is-invalid @enderror" name="tentang" id=""
                    cols="30" rows="10">{{ $data->tentang }}</textarea>

                @error('tentang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn btn-success text-white">Simpan</button>

        </form>
    </div>
</div>
@endsection
