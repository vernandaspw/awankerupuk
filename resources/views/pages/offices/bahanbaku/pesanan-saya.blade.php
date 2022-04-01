@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pesanan bahan baku</h1>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Pesanan bahan baku</h5>
                <div class="bukngkus ">

                    @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin' )
                    <a href="{{ url('office/bahans') }}" class="my-1 btn btn-sm btn-success text-white">
                        Pesan bahan baku
                    </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width='10'>No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>total_pembayaran</th>
                            <th>Metode pembayaran</th>
                            <th>status bayar</th>
                            <th>status pesanan</th>
                            <th>Catatan</th>
                            @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin')
                            <th width='35'>Aksi</th>
                            @endif


                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->supplier->name }}</td>
                            <td>@uang($data->total_pembayaran)</td>
                            <td>{{ $data->metode }}</td>
                            <td>{{ $data->status_bayar }}</td>
                            <td>{{ $data->status == 'harga' ? 'harga telah ada, segera pesan' : $data->status }}</td>
                            <td>{{ $data->catatan == null ? 'tidak ada catatan' :'ada catatan' }}</td>
                            @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin')
                            <td class="d-flex">
                                <a href="{{ url('office/pesanan-saya/detail', $data->id) }}"
                                    class="btn btn-sm btn-secondary text-white">Lihat</a>

                                @if ($data->status == 'harga')
                                <a href="{{ url('office/pesanan-saya/bayar', $data->id) }}"
                                    class="btn btn-sm btn-success text-white">Bayar</a>
                                @endif
                                @if ($data->status == 'dikirim')
                                <a href="{{ url('office/pesanan-saya/terima', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Telah diterima</a>
                                @endif
                                @if ($data->status == 'diterima' || $data->status == 'selesai')
                                <a href="{{ url('office/pesanan-saya/detail', $data->id) }}"
                                    class="btn btn-sm btn-warning text-white">Beri rating</a>

                                @endif

                                @if ($data->status == 'menunggu')
                                <a href="{{ url('office/pesanan-saya/batal', $data->id) }}"
                                    class="btn btn-sm btn-danger text-white">Batal</a>
                                @endif


                            </td>
                            @endif

                        </tr>
                        @empty
                        data tidak ada
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
