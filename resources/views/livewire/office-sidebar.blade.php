<div>
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Office <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if (request()->is('office')) active @endif">
            <a class="nav-link" href="{{ url('office') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        @if (auth('office')->user()->role == 'admin')

        <!-- Heading -->
        <div class="sidebar-heading">
            Kelola pesanan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if (request()->is('office/transaksi*')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pesanan</h6>
                    <a class="collapse-item" href="{{ url('office/pesanan') }}">Pesanan</a>

                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        @endif
        <div class="sidebar-heading">
            Kelola produk
        </div>



        <li class="nav-item @if (request()->is('office/produk')) active @endif">
            <a class="nav-link" href="{{ url('office/produk') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kelola Produk</span></a>
        </li>
        <li class="nav-item @if (request()->is('office/produk-stok*')) active @endif">
            <a class="nav-link" href="{{ url('office/produk-stok') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Riwayat Stok Produk</span></a>
        </li>
        @if (auth('office')->user()->role == 'admin')
        <li class="nav-item @if (request()->is('office/produk-kategori*')) active @endif">
            <a class="nav-link" href="{{ url('office/produk-kategori') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kelola Kategori Produk</span></a>
        </li>
        <li class="nav-item @if (request()->is('office/produk-brand*')) active @endif">
            <a class="nav-link" href="{{ url('office/produk-brand') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Kelola Brand Produk</span></a>
        </li>
        @endif

        @if (auth('office')->user()->role == 'admin' || auth('office')->user()->role == 'produksi')
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Kelola Bahan baku
        </div>
        {{-- <li class="nav-item @if (request()->is('office/bahans*')) active @endif">
            <a class="nav-link" href="{{ url('office/bahans') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Belanja bahan baku</span></a>
        </li> --}}
        <li class="nav-item @if (request()->is('office/bahans*')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwobelanja"
                aria-expanded="true" aria-controls="collapseTwobelanja">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Belanja Bahan baku</span>
            </a>
            <div id="collapseTwobelanja" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded ">
                    <a class="collapse-item @if (request()->is('office/bahans*')) active @endif"
                        href="{{ url('office/bahans') }}">Semua</a>
                    @forelse ($kategori as $item)
                    <a class="collapse-item @if (request()->is('office/bahans*')) active @endif"
                        href="{{ url('office/bahans/kategori', $item->id) }}">{{ $item->nama }}</a>
                    @empty

                    @endforelse
                </div>
            </div>
        </li>
        <li class="nav-item @if (request()->is('office/pesanan-saya*')) active @endif">
            <a class="nav-link" href="{{ url('office/pesanan-saya') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pesanan saya</span></a>
        </li>

        {{-- <li class="nav-item @if (request()->is('office/bahan*')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebahan"
                aria-expanded="true" aria-controls="collapsebahan">
                <i class="fas fa-fw fa-cog"></i>
                <span>Bahan baku</span>
            </a>
            <div id="collapsebahan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Bahan baku</h6>
                    <a class="collapse-item" href="{{ url('office/bahan') }}">Bahan baku</a>

                </div>
            </div>
        </li> --}}
        @endif

        @if (auth('office')->user()->role == 'admin')
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Data Master
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if (request()->is('office/akun*')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kelola data akun</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data akun</h6>
                    <a class="collapse-item @if (request()->is('office/akuncustomer*')) active @endif"
                        href="{{ url('/office/akuncustomer', []) }}">Data Customer</a>
                    <a class="collapse-item @if (request()->is('office/akunoffice')) active @endif"
                        href="{{ url('/office/akunoffice', []) }}">Data Office</a>
                    <a class="collapse-item @if (request()->is('office/akunsupplier')) active @endif"
                        href="{{ url('/office/akunsupplier', []) }}">Data Supplier</a>
                </div>
            </div>
        </li>


        <!-- Nav Item - Charts -->
        <li class="nav-item @if (request()->is('office/satuan*')) active @endif">
            <a class="nav-link" href="{{ url('office/satuan') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data satuan</span></a>
        </li>
        <li class="nav-item @if (request()->is('office/metode*')) active @endif">
            <a class="nav-link" href="{{ url('office/metode') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Metode Pembayaran customer</span></a>
        </li>
        <li class="nav-item @if (request()->is('office/setting')) active @endif">
            <a class="nav-link" href="{{ url('office/setting') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Setting</span></a>
        </li>
        @endif



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

</div>
