@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Belanja bahan baku</h1>
        <a href="{{ url('office/bahans/cart') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i
                class="fas fa-shopping-cart"></i>&nbsp; Cart ({{ $cart }})</a>
    </div>
    <div class="row">
        @forelse ($datas as $data)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a href="{{ url('office/bahans/detail', $data->id) }}" class="btn text-left">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->nama }}</div>
                                <div class="text-sm font-weight-bold text-success mb-1">
                                    Supplier : {{ $data->supplier->name }}</div>
                                <div class="text-sm b-1">
                                    Penilaian :@if ($data->ratings->avg('rating') == 0)
                                    blm ada
                                    @elseif ($data->ratings->avg('rating') <= 1.5) <i class="fas fa-star text-warning">
                                        </i>
                                        @elseif ($data->ratings->avg('rating') <= 2.5) <i
                                            class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            @elseif ($data->ratings->avg('rating') <= 3.5) <i
                                                class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                <i class="fas fa-star text-warning"></i>
                                                @elseif ($data->ratings->avg('rating') <= 4.5) <i
                                                    class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    @elseif ($data->ratings->avg('rating') > 4.5) <i
                                                        class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>

                                                    @endif
                                </div>
                                <div class="text-sm b-1">
                                    Kategori : {{ $data->kategori->nama }}
                                </div>
                                <div class="text-sm b-1">
                                    Brand : {{ $data->brand->nama }}
                                </div>
                                <div class="text-sm b-1">
                                    Satuan : {{ $data->satuan->nama }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ $data->img_url != null ? Storage::url($data->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                    alt="" width="50" height="50">
                            </div>
                        </div>
                    </div>
                </a>
                <div class="card-footer">
                    <a href="{{ url('office/bahans/addtocart', $data->id) }}" class="btn"><i
                            class="fas fa-cart-plus"></i></i> Tambah</a>
                    <a href="{{ url('office/bahans/detail', $data->id) }}" class="btn"><i class="fas fa-file-alt"></i>
                        Detail</a>
                </div>
            </div>

        </div>
        @empty
        <span>Tidak ada data</span>
        @endforelse
    </div>
</div>
@endsection
