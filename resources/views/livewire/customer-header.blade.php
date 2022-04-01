<div>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:+628117816988"><i class="fa fa-phone"></i> +628117816988</a></li>
                                <li><a href="mailto:awan240288@gmail.com"><i class="fa fa-envelope"></i>
                                        awan240288@gmail.com </a></li>

                                <a href=""></a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="https://www.facebook.com/Awan_kerupukstore-628295864628104"><i
                                            class="fa fa-facebook"></i></a></li>
                                {{-- <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ url('/') }}"><span style="color: orange"> <b>&nbsp;TCA
                                        Tawan Cemerlang Abadi</b></span></a>
                        </div>
                        <div class="btn-group pull-right">
                            {{-- <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div> --}}

                            {{-- <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                {{-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> --}}

                                @if (auth('customer')->user())

                                <li><a class="{{ request()->is('cart') ? 'active' : '' }}" href="{{ url('cart') }}"><i
                                            class="fa fa-shopping-cart"></i> Cart ({{ $cartcount }})</a>
                                </li>
                                <li><a class="{{ request()->is('pesanan') ? 'active' : '' }}"
                                        href="{{ url('pesanan') }}"><i class="fa fa-crosshairs"></i> Pesanan saya</a>
                                </li>
                                {{-- <li><a class="{{ request()->is('akun') ? 'active' : '' }}"
                                        href="{{ url('akun') }}"><i class="fa fa-user"></i> Account</a></li> --}}
                                <li><a href="{{ url('auth/keluar') }}" class="btn btn-transparent"><i
                                            class="fa fa-user"></i>
                                        Logout</a></li>


                                @else
                                <li><a href="{{ url('auth') }}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ url('/') }}"
                                        class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                                </li>
                                <li class="dropdown"><a class="{{ request()->is('kategori*') ? 'active' : '' }}"
                                        href="#">Kategori<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @forelse ($kategoris as $kategori)
                                        <li><a class="{{ request()->is('kategori/'. $kategori->id) ? 'active' : '' }}"
                                                href="{{ url('kategori/'.$kategori->id) }}">{{ $kategori->nama
                                                }}</a>
                                        </li>
                                        @empty
                                        <li><a href="#">Kategori tidak ditemukan</a></li>
                                        @endforelse


                                    </ul>
                                </li>
                                {{-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="404.html">404</a></li> --}}
                                <li><a href="{{ url('tentang') }}"
                                        class="{{ request()->is('tentang') ? 'active' : '' }}">Tentang kami</a>
                                </li>
                                <li><a href="{{ url('kontak') }}"
                                        class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak kami</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
    {{-- Care about people's approval and you will be their prisoner. --}}
</div>
