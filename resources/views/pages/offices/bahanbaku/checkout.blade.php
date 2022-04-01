@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cart</h1>

    <br>

    <!-- DataTales Example -->
    @if ($datas != null)
    <div class="card shadow mb-4">
        <div class="card-body">
            @foreach ($datas->cartsupps as $supps)
            <div class="card mb-2">
                <div class="card-header">
                    {{ $supps->supplier->name }}
                </div>
                <form action="{{ url('office/bahans/cart/checkout/save', $supps->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @foreach ($supps->cartdetails as $item)
                        <div class="mb-1">
                            <div>
                                Nama Bahan baku : {{ $item->bahan->nama }}
                            </div>
                            <div>
                                Jumlah : {{ $item->qty }}
                            </div>
                        </div>
                        @endforeach

                        <div>
                            <select required name="metode" class="form-control" id="metode">
                                <option value="">-Pilih metode pembayaran-</option>
                                <option value="tunai" @if ($supps->metode == 'tunai')
                                    selected
                                    @endif>Tunai</option>
                                <option value="cod" @if ($supps->metode == 'cod')
                                    selected
                                    @endif>cod</option>
                                <option value="transfer" @if ($supps->metode == 'transfer')
                                    selected
                                    @endif>transfer</option>
                            </select>
                            <textarea class="form-control mt-2" name="catatan" id="catatan" cols="30" rows="2"
                                placeholder="Catatan">{{ $supps->catatan }}</textarea>
                            <button type="submit" class="btn btn-warning mt-2 form-control">ubah</button>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
            <br>
            <a href="{{ url('office/bahans/buatpesanan') }}" class="btn btn-success">Buat pesanan</a>
            <a href="{{ url('office/bahans') }}" class="btn btn-secondary mr-2">Kembali</a>
        </div>
    </div>
    @else
    <p>Tidak ada data</p>
    @endif

</div>
@endsection
