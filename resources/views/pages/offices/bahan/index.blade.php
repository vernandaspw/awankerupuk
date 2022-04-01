@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bahan baku</h1>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Data bahan baku</h5>
                <div class="bukngkus ">







                    @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin' )
                    <a href="{{ url('office/pesanbahan/create') }}" class="my-1 btn btn-sm btn-success text-white">
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
                            <th>tanggal</th>
                            <th>Supplier</th>
                            <th>No telp</th>
                            <th>Alamat</th>

                            <th>Total bayar</th>
                            <th>Status</th>
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
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->alamat }}</td>

                            <td>@uang($data->total_bayar)</td>
                            <td>{{ $data->status == 'harga' ? 'harga telah ada, segera pesan' : $data->status }}</td>
                            <td>{{ $data->catatan }}</td>
                            @if (auth('office')->user()->role != 'gudang')
                            <td class="d-flex">
                                @if (auth('office')->user()->role == 'admin' || auth('office')->user()->role ==
                                'produksi')
                                <a href="{{ url('office/bahan/lihat', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Lihat</a>
                                @if ($data->status == 'harga')
                                <a href="{{ url('office/bahan/pesan', $data->id) }}"
                                    class="btn btn-sm btn-success text-white">Pesan</a>
                                @endif
                                @if ($data->status == 'dikirim')
                                <a href="{{ url('office/bahan/terima', $data->id) }}"
                                    class="btn btn-sm btn-warning text-white">telah diterima</a>

                                @endif
                                @endif

                                @if (auth('office')->user()->role == 'admin')
                                <form onsubmit="return confirm('Apakah Anda Yakin ? ');" method="post"
                                    action="{{ url('office/bahan/delete', $data->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger text-white">Hapus</button>
                                </form>
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
