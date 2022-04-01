@extends('layouts.customer')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->

                    <h2>Masuk ke akun Anda</h2>

                    <form method="POST" action="{{ url('/auth/masuk') }}">
                        @method('POST')
                        @csrf
                        <input name='email' type="email" name="email" placeholder="Email Address"
                            class=" @error('email') is-invalid @enderror" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='password' type="password" name="password" placeholder="password"
                            class=" @error('password') is-invalid @enderror" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <span>

                            <input type="checkbox" class="checkbox">
                            Biarkan saya tetap masuk
                        </span>
                        <button type="submit" class="btn btn-default">Masuk</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Pendaftaran Pengguna Baru!</h2>

                    <form method="POST" action="{{ url('auth/daftar') }}">
                        @csrf
                        @method('POST')
                        <input name='name' type="text" placeholder="Name" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='demail' type="email" placeholder="Email Address" />
                        @error('demail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='dpassword' type="password" placeholder="Password" />
                        @error('dpassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='nohp' type="text" placeholder="nohp" />
                        @error('nohp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='provinsi' type="text" placeholder="provinsi" />
                        @error('provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='kota' type="text" placeholder="kota" />
                        @error('kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name='kecamatan' type="text" placeholder="kecamatan" />
                        @error('kecamatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <textarea name='alamat' placeholder="alamat" rows="3"></textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-default">Daftar</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

@endsection
