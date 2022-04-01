@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelola Produk</h1>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Data Produk</h5>
                <div class="bukngkus ">
                    @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin')

                    <button type="button" class=" btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#tambahStokGudang">
                        Tambah Stok Gudang
                    </button>

                    <div class="modal fade" id="tambahStokGudang" tabindex="-1" role="dialog"
                        aria-labelledby="tambahStokGudangTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahStokGudangTitle">Tambah stok gudang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('office/produk/tambahstokgudang') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select id="produk_id" name='produk_id'
                                                class="form-control @error('produk_id') is-invalid @enderror">
                                                <option value="">-Pilih Produk-</option>
                                                @foreach ($datas as $data)
                                                <option value="{{ $data->id }}"> {{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('produk_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input value="{{ old('qty') }}" name='qty' type="number"
                                                class="form-control @error('qty') is-invalid @enderror"
                                                placeholder="Jumlah produk ditambah">
                                            @error('qty')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <textarea name="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                id=" keterangan" cols="30" rows="5"
                                                placeholder="Keterangan">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Tambah stok ke gudang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if (auth('office')->user()->role == 'gudang' || auth('office')->user()->role == 'admin')
                    <button type="button" class=" btn btn-sm btn-warning" data-toggle="modal"
                        data-target="#transferstokproduk">
                        Transfer Stok Gudang
                    </button>

                    <div class="modal fade" id="transferstokproduk" tabindex="-1" role="dialog"
                        aria-labelledby="transferstokprodukTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="transferstokprodukTitle">Transfer stok gudang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('office/produk/transferstokproduk') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select required id="produk_id" name='produk_id'
                                                class="form-control @error('produk_id') is-invalid @enderror">
                                                <option value="">-Pilih Produk-</option>
                                                @foreach ($datas as $data)
                                                <option value="{{ $data->id }}"> {{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('produk_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select required id="posisi" name='posisi'
                                                class="form-control @error('posisi') is-invalid @enderror">
                                                <option value="">-Pilih Posisi awal stok yang ingin dipindahkan-
                                                </option>
                                                <option value="toko">Toko</option>
                                                <option value="gudang">Gudang</option>
                                            </select>
                                            @error('posisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required value="{{ old('qty') }}" name='qty' type="number"
                                                class="form-control @error('qty') is-invalid @enderror"
                                                placeholder="Jumlah produk dipindahkan">
                                            @error('qty')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select required id="isPindah" name='isPindah'
                                                class="form-control @error('isPindah') is-invalid @enderror">
                                                <option value="">-Pilih Tujuan Pindah-</option>
                                                <option value="ketoko">ke Toko</option>
                                                <option value="kegudang">ke Gudang</option>
                                            </select>
                                            @error('isPindah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <textarea name="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                id=" keterangan" cols="30" rows="5"
                                                placeholder="Keterangan">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Transfer stok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif



                    @if (auth('office')->user()->role == 'admin')
                    <button type="button" class=" btn btn-sm btn-danger" data-toggle="modal"
                        data-target="#sesuaikanstok">
                        Sesuaikan Stok akhir
                    </button>

                    <div class="modal fade" id="sesuaikanstok" tabindex="-1" role="dialog"
                        aria-labelledby="sesuaikanstokTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sesuaikanstokTitle">Sesuaikan stok stok</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="container">
                                    <span style="font-size: 14px; color: red">*Penyusaian stok tidak akan dicatat dalam
                                        riwayat
                                        stok</span>
                                    <br>
                                    <span style="font-size: 14px; color: red">*Gunakanlah dengan bijak</span>
                                    <br>
                                    <span style="font-size: 14px; color: red">*Jika tidak ingin mengubah stok salah
                                        satunya, kosongkan saja salah satunya</span>
                                </div>
                                <form action="{{ url('office/produk/sesuaikanstok') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select required id="produk_id" name='produk_id'
                                                class="form-control @error('produk_id') is-invalid @enderror">
                                                <option value="">-Pilih Produk-</option>
                                                @foreach ($datas as $data)
                                                <option value="{{ $data->id }}"> {{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('produk_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input value="{{ old('stok_gudang') }}" name='stok_gudang' type="number"
                                                class="form-control @error('stok_gudang') is-invalid @enderror"
                                                placeholder="Jumlah akhir stok gudang">
                                            @error('stok_gudang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input value="{{ old('stok_toko') }}" name='stok_toko' type="number"
                                                class="form-control @error('stok_toko') is-invalid @enderror"
                                                placeholder="Jumlah akhir stok toko">
                                            @error('stok_toko')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>




                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Sesuaikan stok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (auth('office')->user()->role == 'produksi' || auth('office')->user()->role == 'admin')
                    <a href="{{ url('office/produk/create') }}" class="my-1 btn btn-sm btn-success text-white">
                        Tambah Produk baru
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
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Brand</th>
                            <th>Harga pokok</th>
                            <th>harga jual</th>
                            <th>Stok gudang</th>
                            <th>Stok toko/jual</th>
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
                            <td><img src="{{ $data->img_url != null ? Storage::url($data->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png' }}"
                                    alt="" width="50" height="50"></td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kategori == null ? '' : $data->kategori->nama }}</td>
                            <td>{{ $data->brand == null ? '' : $data->brand->nama }}</td>
                            <td>@uang($data->harga_pokok)</td>
                            <td>@uang($data->harga_jual)</td>
                            <td>{{ $data->stok_gudang }}</td>
                            <td>{{ $data->stok_toko }}</td>
                            @if (auth('office')->user()->role != 'gudang')
                            <td class="d-flex">
                                @if (auth('office')->user()->role == 'admin' || auth('office')->user()->role ==
                                'produksi')
                                <a href="{{ url('office/produk/edit', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Ubah</a>
                                @endif

                                @if (auth('office')->user()->role == 'admin')
                                <form onsubmit="return confirm('Apakah Anda Yakin ? ');" method="post"
                                    action="{{ url('office/produk/delete', $data->id) }}">
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
