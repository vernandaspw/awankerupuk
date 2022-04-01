<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Supplier <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('supplier') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Kelola Bahan baku
    </div>
    <li class="nav-item @if (request()->is('supplier/pesanan*')) active @endif">
        <a class="nav-link" href="{{ url('supplier/pesanan') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pesanan bahan baku</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Kelola Bahan baku
    </div>
    <li class="nav-item @if (request()->is('supplier/bahans*')) active @endif">
        <a class="nav-link" href="{{ url('supplier/bahans') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data bahan baku</span></a>
    </li>
    <li class="nav-item @if (request()->is('supplier/bahan-kategori*')) active @endif">
        <a class="nav-link" href="{{ url('supplier/bahan-kategori') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data kategori bahan</span></a>
    </li>
    <li class="nav-item @if (request()->is('supplier/bahan-brand*')) active @endif">
        <a class="nav-link" href="{{ url('supplier/bahan-brand') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data brand bahan</span></a>
    </li>
    {{-- <li class="nav-item @if (request()->is('supplier/metode*')) active @endif">
        <a class="nav-link" href="{{ url('supplier/metode') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Metode Pembayaran</span></a>
    </li> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebahan" aria-expanded="true"
            aria-controls="collapsebahan">
            <i class="fas fa-fw fa-cog"></i>
            <span>Bahan baku</span>
        </a>
        <div id="collapsebahan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bahan baku</h6>
                <a class="collapse-item" href="{{ url('supplier/bahan') }}">Bahan baku</a>

            </div>
        </div>
    </li> --}}






    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
