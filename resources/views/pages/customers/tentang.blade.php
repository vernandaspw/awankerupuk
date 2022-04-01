@extends('layouts.customer')
@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Tentang Kami</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if ($settings != null)
                {{ $settings->nama_perusahaan }}
                <br>
                <br>
                {{ $settings->tentang }}
                @else
                tidak ada data
                @endif
            </div>
        </div>
        <div class="row">
            <br>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <br>
        </div>
    </div>
</div>
<!--/#contact-page-->

@endsection