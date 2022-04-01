@extends('layouts.supplier')
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
                            <th width='35'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr @if ($data->status == 'selesai')
                            style="background-color: greenyellow"
                            @elseif ($data->status == 'batal')
                            style="background-color: red; color:white;"
                            @endif>
                            <td>{{ $no }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->supplier->name }}</td>
                            <td>@uang($data->total_pembayaran)</td>
                            <td>{{ $data->metode }}</td>
                            <td>{{ $data->status_bayar }}</td>
                            <td @if ($data->status == 'harga')
                                style="background-color: green; color:white;"
                                @endif>{{ $data->status == 'harga' ? 'harga telah diberikan' :
                                $data->status }}</td>
                            <td>{{ $data->catatan == null ? 'tidak ada catatan' :'ada catatan' }}</td>
                            <td class="d-flex">
                                @if ($data->status == 'menunggu')
                                <a href="{{ url('supplier/pesanan/beriharga', $data->id) }}"
                                    class="btn btn-sm btn-warning text-white">Beri harga</a>
                                @endif
                                @if ($data->status == 'dikemas')
                                <a href="{{ url('supplier/pesanan/kirim', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Kirim</a>
                                @endif
                                @if ($data->status == 'dikirim' || $data->status == 'diterima')
                                <a href="{{ url('supplier/pesanan/selesai', $data->id) }}"
                                    class="btn btn-sm btn-success text-white">Selesaikan</a>
                                @endif
                                @if ($data->status != 'selesai' && $data->status != 'diterima' && $data->status !=
                                'batal')
                                <a href="{{ url('supplier/pesanan/batal', $data->id) }}"
                                    class="btn btn-sm btn-danger text-white">batalkan</a>
                                @endif

                            </td>
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
