@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail</h1>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row m-4">
                <div class="col-6 d-flex justify-content-center">
                    <img src="{{ $data->img_url != null ? Storage::url($data->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                        alt="" width="220" height="220">
                </div>
                <div class="col-6 text-start">
                    <h3 class="text-dark font-weight-bold">{{ $data->nama }}</h3>
                    <br>
                    Penilaian :
                    @if ($rate <= 1.5) <i class="fas fa-star text-warning"></i>
                        @elseif ($rate <= 2.5) <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            @elseif ($rate <= 3.5) <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                @elseif ($rate <= 4.5) <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    @elseif ($rate > 4.5) <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    @endif

                                    <div class="mb-2">Supplier : {{ $data->supplier->name }}</div>
                                    <div class="mb-2">Kategori : {{ $data->kategori->nama }}</div>
                                    <div class="mb-2">Brand : {{ $data->brand->nama }}</div>
                                    <div class="mb-2">Satuan : {{ $data->satuan->nama }}</div>
                                    <div> <a href="{{ url('office/bahans/addtocart', $data->id) }}"
                                            class="btn btn-warning mr-2"><i class="fas fa-cart-plus"></i></i> Tambah</a>
                                        <a href="{{ url('office/bahans') }}" class="btn btn-secondary">
                                            Kembali</a>
                                    </div>
                </div>
            </div>

            <div class="row mt-5 m-4">
                <div class="container">
                    <h5 class="text-dark">Deskripsi bahan baku :</h5>
                    <p>{!! $data->keterangan !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
