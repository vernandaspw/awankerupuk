@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelola Metode pembayaran untuk transaksi Costumer</h1>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary"> Data metode pembayaran</h5>

                <div class="bukngkus">
                    <a href="{{ url('office/metode/create') }}" class="btn btn-sm btn-success text-white">
                        Tambah
                    </a>
                </div>

            </div>
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Metode</th>
                            <th>keterangan</th>
                            <th>Atas Nama</th>
                            <th>No Rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->metode }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ $data->an }}</td>
                            <td>{{ $data->norek }}</td>
                            <td><a href="{{ url('office/metode/edit', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Ubah</a>
                                <form onsubmit="return confirm('Apakah Anda Yakin ? ');" method="post"
                                    action="{{ url('office/metode/delete', $data->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger text-white">Hapus</button>
                                </form>
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
