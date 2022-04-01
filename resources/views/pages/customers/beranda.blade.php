@extends('layouts.customer')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">@if (Request::is('/'))
                        Semua Produk Terbaru
                        @elseif (Request::is('kategori*'))
                        Produk berdasarkan kategori
                        @endif</h2>

                    @forelse ($allproduks as $allproduk)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ url('produk', $allproduk->id) }}" class="btn btn-transparant"><img
                                            width="200" height="200"
                                            src="{{ $allproduk->img_url != null ? Storage::url($allproduk->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                            alt="" /></a>
                                    <a href="{{ url('produk', $allproduk->id) }}">
                                        <h2>@uang($allproduk->harga_jual)</h2>
                                        <p>{{ $allproduk->nama }}</p>
                                    </a>
                                    <a href="{{ url('addtocart', $allproduk->id) }}"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                        cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <a href="{{ url('produk', $allproduk->id) }}"><img width="200" height="200"
                                                src="{{ $allproduk->img_url != null ? Storage::url($allproduk->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png'  }}"
                                                alt="" /></a>
                                        <a href="{{ url('produk', $allproduk->id) }}">
                                            <h2>@uang($allproduk->harga_jual)</h2>
                                            <p>{{ $allproduk->nama }}</p>
                                        </a>
                                        <a href="@if (auth('customer')->user())
                                            {{ url('addtocart', $allproduk->id) }}
                                        @else
                                        {{ url('auth') }}
                                        @endif" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add
                                            to cart</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    @empty
                    Tidak ada produk
                    @endforelse

                </div>
                <div class="row">
                    <center> {{ $allproduks->links() }}
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
