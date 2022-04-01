@extends('layouts.supplier')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelola bahan baku</h1>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary"> Data bahan baku</h5>

                <div class="bukngkus">
                    <a href="{{ url('supplier/bahans/create') }}" class="btn btn-sm btn-success text-white">
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
                            <th>Gambar</th>
                            <th>Nama Bahan</th>
                            <th>Kategori</th>
                            <th>Brand</th>
                            <th>Satuan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td><img src="{{ $data->img_url != null ? Storage::url($data->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                    alt="" width="50" height="50"></td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kategori == null ? '' : $data->kategori->nama }}</td>
                            <td>{{ $data->brand == null ? '' : $data->brand->nama }}</td>
                            <td>{{ $data->satuan == null ? '' : $data->satuan->nama }}</td>
                            <td>{{ $data->keterangan == null ? 'tidak ada ket' : 'ada keterangan' }}</td>
                            <td><a href="{{ url('supplier/bahans/edit', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Ubah</a>
                                <form onsubmit="return confirm('Apakah Anda Yakin ? ');" method="post"
                                    action="{{ url('supplier/bahans/delete', $data->id) }}">
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
