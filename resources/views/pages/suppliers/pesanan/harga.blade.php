@extends('layouts.supplier')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Pesan bahan baku</h1>
    </div>

    <div class="card-body">

        <div class="form-group">
            <label for="Perusahaan">Perusahaan</label>
            <input type="text" class="form-control" disabled value="{{ $datas->setting->nama_perusahaan }}">
        </div>

        <div class="form-group">
            <label for="catatan pesanan">Catatan pesanan</label>
            <textarea disabled name="catatan" class="form-control @error('catatan') is-invalid @enderror" id=" catatan"
                cols="30" rows="5" placeholder="catatan">{{ old('catatan', $datas->catatan) }}</textarea>
            @error('catatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>



        <table class="table table-bordered" id="dynamicTable">
            <tr>
                <th>Bahan baku</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total harga</th>
                <th>Aksi</th>
            </tr>
            @foreach ($datas->pesan_details as $detail)

            <form method="POST" action="{{ url('supplier/pesanan/beriharga/proses', $detail->id) }}">
                @method('put')
                @csrf
                <tr>
                    <td><input disabled value="{{ $detail->bahan->nama }}" required type="text" name="addmore[0][name]"
                            placeholder="Enter bahan baku" class="form-control" />
                    </td>
                    <td><input disabled value="{{ $detail->qty }}" type="number" required name="addmore[0][qty]"
                            placeholder="Enter your Qty" class="form-control" />
                    </td>
                    <td><input value="{{ old('harga', $detail->harga) }}" type="number" required name="harga"
                            placeholder="blm ada" class="form-control" />
                    </td>
                    <td>@uang($detail->total_harga)
                    </td>
                    <td> <button type="submit" class="btn btn-info text-white">Beri harga</button></td>
                </tr>
            </form>
            @endforeach
        </table>
        <form method="POST" action="{{ url('supplier/pesanan/biayaantar', $datas->id) }}">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="">Biaya antar</label>
                <input required type="text" class="form-control" name="biaya_antar"
                    value="{{ old('biaya_antar', $datas->biaya_antar) }}">
            </div>
            <button type="submit" class="form-control btn btn-sm btn-info">Ubah biaya antar</button>
        </form>
        <br>

        <div class="form-group">
            <label for="">Total Pembayaran</label>
            <input type="text" class="form-control" disabled value="@uang($datas->total_pembayaran)">
            <a href="{{ url('supplier/pesanan/perbarui', $datas->id) }}" class="btn btn-sm btn-secondary" type="button"
                data-dismiss="modal">perbarui total</a>
        </div>



        <br>
        <a href="{{ url('supplier/pesanan/tagih', $datas->id) }}" class="btn btn-success" type="button"
            data-dismiss="modal">Tagih
            Pembayaran</a>
        <a href="{{ url('supplier/pesanan') }}" class="btn btn-white" type="button" data-dismiss="modal">Kembali</a>


    </div>
</div>
@endsection

@push('script')

@endpush
