@extends('layouts.customer')
@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Detail Transaksi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if ($transaksi != null)
                <div class="row">
                    <div class="col-sm-6">
                        {{ $transaksi->created_at }}
                        <br>
                        <br>
                        {{ $transaksi->customer->name }}
                        <br>
                        {{ $transaksi->customer->nohp }}
                        <br>
                        {{ $transaksi->customer->provinsi }}
                        <br>
                        {{ $transaksi->customer->kota }}
                        <br>{{ $transaksi->customer->kecamatan }}
                        <br>{{ $transaksi->customer->alamat }}
                    </div>
                    <div class="col-sm-6">
                        Metode Transaksi : {{ $transaksi->metode->metode }}
                        <br>
                        Status bayar : {{ $transaksi->status_bayar }}
                        <br>
                        Status Transaksi : {{ $transaksi->status_transaksi }}
                        <br>
                        Total Pembayaran : {{ $transaksi->total_pembayaran }}
                        <br>
                        <br>
                        @if ($transaksi->metode->metode == 'transfer')
                        <b>Silakhan Transfer Ke</b>
                        <br>
                        {{ $transaksi->metode->keterangan }}
                        <br>
                        No Rekening : {{ $transaksi->metode->norek }}
                        <br>
                        AN : {{ $transaksi->metode->an }}
                        <br>
                        <br>
                        @if ($transaksi->status_bayar == 'blmbayar' && $transaksi->status_transaksi == 'pembayaran')

                        <a style="background-color: blue" href="{{ url('pesanan/konfirm', $transaksi->id) }}"
                            class="btn btn-danger"> konfirmasi sudah bayar
                        </a>

                        @endif
                        @else

                        @endif

                    </div>
                </div>

                <br>
                <br>
                <h4>Barang</h4>

                <div class="row">
                    @foreach ($item as $val)
                    <div class="col-sm-3">
                        <br>
                        <p><b>{{ $val->produk->nama }}</b></p>
                        <img src="{{ $val->produk->img_url != null ? Storage::url($val->produk->img_url) : 'http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png'}}"
                            alt="">
                        <p>{{ $val->qty }}</p>
                        <p>{{ $val->subharga }}</p>
                    </div>
                    @endforeach
                </div>
                <br>



                @else
                tidak ada data
                @endif
            </div>
        </div>
        <div class="row">
            <br>

            <br>
            <br>
            <br>
            <br>
            <br>

            <br>
        </div>
    </div>
</div>
<!--/#contact-page-->

@endsection
