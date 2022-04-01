@extends('layouts.supplier')
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





                    {{-- <a href="{{ url('office/pesanbahan/create') }}" class="my-1 btn btn-sm btn-success text-white">
                        Pesan bahan baku
                    </a> --}}



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

                            <th width='35'>Aksi</th>



                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr @if ($data->status == 'menunggu')
                            style="background-color: cyan"
                            @elseif ($data->status == 'dikemas')
                            style="background-color: orange"\
                            @elseif ($data->status == 'batal')
                            style="background-color: red"
                            @elseif ($data->status == 'selesai')
                            style="background-color: green"
                            @endif>
                            <td>{{ $no }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->supplier->name }}</td>
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->alamat }}</td>

                            <td>@uang($data->total_bayar)</td>
                            <td>{{ $data->status == 'harga' ? 'harga telah ada' : $data->status }}</td>
                            <td>{{ $data->catatan }}</td>

                            <td class="d-flex">



                                @if (auth('customer'))
                                @if ($data->status == 'menunggu')
                                <a href="{{ url('supplier/bahan/edit', $data->id) }}"
                                    class="btn btn-sm btn-warning text-white">Beri harga</a>
                                @endif
                                @if ($data->status == 'dikemas')
                                <a href="{{ url('supplier/bahan/kirim', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Kirim barang</a>
                                @endif
                                @if ($data->status == 'dikirim' || $data->status == 'diterima')
                                <a href="{{ url('supplier/bahan/selesai', $data->id) }}"
                                    class="btn btn-sm btn-success text-white">Sekesai</a>
                                @endif
                                @if ($data->status != 'selesai')
                                <a href="{{ url('supplier/bahan/batal', $data->id) }}"
                                    class="btn btn-sm btn-danger text-white">Batal</a>
                                @endif
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
