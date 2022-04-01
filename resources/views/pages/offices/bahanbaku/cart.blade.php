@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cart</h1>

    <br>

    <!-- DataTales Example -->
    @if ($datas != null)
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Supplier</th>
                            <th>Gambar</th>
                            <th>Nama Bahan baku</th>
                            <th>Qty</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($datas as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->supplier->name }}</td>
                            <td><img width="50" height="50"
                                    src="{{ $detail->bahan->img_url != null ? Storage::url($detail->bahan->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                    alt=""></td>
                            <td>{{ $detail->bahan->nama }}</td>
                            <td class="d-flex justify-content-center"><b>{{ $detail->qty }}</b> <a
                                    class="btn btn-sm btn-warning ml-3"
                                    href="{{ url('office/bahans/cart/ubahqty', $detail->id) }}">Ubah qty</a></td>
                            <td>
                                <a class="btn btn-sm btn-danger"
                                    href="{{ url('office/bahans/cart/hapus', $detail->id) }}">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        Tidak ada data
                        @endforelse

                    </tbody>
                </table>
            </div>
            <br>
            <a href="{{ url('office/bahans/cart/checkout') }}" class="btn btn-warning">Checkout</a>
            <a href="{{ url('office/bahans') }}" class="btn btn-secondary mr-2">Kembali</a>
        </div>
    </div>
    @else
    <p>Tidak ada data</p>
    @endif

</div>
@endsection
