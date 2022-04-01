@extends('layouts.offices')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Riwayat Produk Stok</h1>
    <br>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold"></h5>
                <div class="bukngkus">
                    {{-- <a href="{{ url('office/produk/create') }}" class="btn btn-sm btn-success text-white">
                        Tambah
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
                            <td>Waktu</td>
                            <th>Produk</th>
                            <th>Qty Stok</th>
                            <th>Status</th>
                            <th>Posisi</th>
                            <th>Pindah</th>
                            <th>Keterangan</th>
                            <th width='35'>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->produk->nama }}</td>
                            <td>{{ $data->qty }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->posisi }}</td>
                            <td>{{ $data->isPindah != null ? $data->isPindah : '-' }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td class="d-flex">
                                <a href="{{ url('office/produk-stok/show', $data->id) }}"
                                    class="btn btn-sm btn-warning text-white">Lihat</a>
                                @if (auth()->user()->role == 'gudang' || auth()->user()->role == 'produksi')

                                @endif
                                @if (auth('office')->user()->role == 'admin')

                                <form onsubmit="return confirm('Apakah Anda Yakin ? ');" method="post"
                                    action="{{ url('office/produk-stok/delete', $data->id .'/' .$data->produk->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger text-white">Hapus</button>
                                </form>
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
