@extends('layouts.customer')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Pesanan saya</li>
            </ol>
        </div>

        @if ($transaksis != null)
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" width='200'>Tanggal</td>
                        <td class="description">Total Pembayaran</td>
                        <td class="price">Metode Pembayaran</td>
                        <td class="quantity">Status bayar</td>
                        <td class="total">Status Transaksi</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                    <tr>
                        <td class="cart_product">
                            <p>{{ $transaksi->created_at }}</p>
                        </td>
                        <td class="cart_description">
                            <p>@uang($transaksi->total_pembayaran )</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ $transaksi->metode->metode }}</p>
                        </td>
                        <td class="cart_quantity">
                            <p @if ($transaksi->status_bayar == 'blmbayar')
                                style="color: red;
                                @elseif ($transaksi->status_bayar == 'proses')
                                style="color: orange;
                                @else
                                style="color: green;
                                @endif ">{{ $transaksi->status_bayar }}</p>
                        </td>
                        <td class="cart_total">
                            <p @if ($transaksi->status_transaksi == 'batal')
                                style="color: red"
                                @endif class="cart_total_price">{{ $transaksi->status_transaksi }}</p>
                        </td>

                        <td class="cart_delete">
                            <a class=" btn btn-sm" style="background-color: cyan" href=" {{ url('pesanan/lihat',
                                $transaksi->id) }}">
                                Lihat
                            </a>
                            @if ($transaksi->status_bayar == 'blmbayar' && $transaksi->status_transaksi == 'pembayaran')

                            <a style="background-color: blue" href="{{ url('pesanan/konfirm', $transaksi->id) }}"
                                class="btn btn-danger"> konfirmasi sudah bayar
                            </a>
                            <a style="background-color: red" href="{{ url('pesanan/batal', $transaksi->id) }}"
                                class="btn btn-danger"><i class="fa fa-times"> Batal</i>
                            </a>
                            @endif
                            @if ($transaksi->status_transaksi == 'dikirim')
                            <a style="background-color: green" href="{{ url('pesanan/terima', $transaksi->id) }}"
                                class="btn btn-danger"> Pesanan diterima
                            </a>
                            @endif

                            {{-- <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Tidak ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @else
        <h4>Belum ada transaksi</h4>
        @endif
    </div>
</section>

@endsection
