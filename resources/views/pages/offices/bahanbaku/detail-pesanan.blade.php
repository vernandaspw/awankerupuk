@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail</h1>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row m-4">

                <div class="col-12 text-start">

                    <div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row d-flex justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">Detail Pesanan bahan baku</h5>
                                    <div class="bukngkus ">

                                        @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role
                                        == 'admin' )
                                        <a href="{{ url('office/pesanan-saya') }}"
                                            class="my-1 btn btn-sm btn-secondary text-white">
                                            Kembali
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
                                                <th>Bahan</th>
                                                <th>Qty</th>
                                                <th>Total harga</th>
                                                @if (auth('office')->user()->role == 'produksi' ||
                                                auth('office')->user()->role == 'admin')
                                                <th width='35'>Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no = 0; ?>
                                            @forelse ($data->pesan_details as $item)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $item->bahan->nama }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->total_harga }}</td>
                                                </td>
                                                @if (auth('office')->user()->role == 'produksi' ||
                                                auth('office')->user()->role == 'admin')
                                                <td class="d-flex">

                                                    @if ($data->status == 'diterima' || $data->status == 'selesai')
                                                    {{-- <a
                                                        href="{{ url('office/pesanan-saya/rating', $item->bahan->id) }}"
                                                        class="btn btn-sm btn-warning text-white">Beri rating</a> --}}

                                                    <button type="button" class=" btn btn-sm btn-warning"
                                                        data-toggle="modal" data-target="#berirating">
                                                        Beri rating
                                                    </button>

                                                    <div class="modal fade" id="berirating" tabindex="-1" role="dialog"
                                                        aria-labelledby="beriratingTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="tambahStokGudangTitle">
                                                                        Beri Rating <i
                                                                            class="fas fa-star text-warning"></i></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="{{ url('office/pesanan-saya/rating',$item->bahan->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <select id="rating" name='rating'
                                                                                class="form-control @error('rating') is-invalid @enderror">
                                                                                <option value="">-Pilih Rating 1 s/d 5-
                                                                                </option>
                                                                                <option value="1">1 - Satu
                                                                                </option>
                                                                                <option value="2">2 - Dua
                                                                                </option>
                                                                                <option value="3">3 - Tiga
                                                                                </option>
                                                                                <option value="4">4 - Empat
                                                                                </option>
                                                                                <option value="5">5 - Lima
                                                                                </option>
                                                                            </select>
                                                                            @error('rating')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>



                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
                    <h3 class="text-dark font-weight-bold">{{ $data->created_at }}</h3>
                    <br>
                    <div class="mb-2">Supplier : {{ $data->supplier->name }}</div>
                    <div class="mb-2">Metode : {{ $data->metode }}</div>
                    <div class="mb-2">Biaya antar : @uang($data->biaya_antar)</div>
                    <div class="mb-2">Harga : @uang($data->total_harga)</div>
                    <div class="mb-2">Total pembayaran : @uang($data->total_pembayaran )</div>
                    <div class="mb-2">Status Bayar : {{ $data->status_bayar }}</div>

                    <div class="mb-2">Status : {{ $data->status }}</div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
