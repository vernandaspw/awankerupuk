@extends('layouts.offices')

@section('content')


<div class="card shadow m-4">
    <div class="card-header">
        <h1 class="h3 mb-2 text-gray-800">Pesan bahan baku</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('office/pesanbahan/store') }}" enctype="multipart/form-data">
            @method('POST')
            @csrf


            <div class="form-group">
                <select required id="supplier_id" name='supplier_id'
                    class="form-control @error('supplier_id') is-invalid @enderror">
                    <option value="">-Pilih Supplier-</option>
                    @foreach ($supp as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value="{{ old('no_telp') }}" name='no_telp' type="number"
                    class="form-control @error('no_telp') is-invalid @enderror" placeholder="No telp ">

                @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <input value="{{ old('alamat') }}" name='alamat' type="text"
                    class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat ">

                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" id=" catatan"
                    cols="30" rows="5" placeholder="catatan">{{ old('catatan') }}</textarea>
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
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input required type="text" name="addmore[0][name]" placeholder="Enter bahan baku"
                            class="form-control" />
                    </td>
                    <td><input type="number" required name="addmore[0][qty]" placeholder="Enter your Qty"
                            class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                </tr>
            </table>

            {{-- buat detail --}}





            <br>
            <a href="{{ url('office/bahan') }}" class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-success text-white">Pesan</button>

        </form>
    </div>
</div>
@endsection

@push('script')
<script>
    var i = 0;

       $("#add").click(function(){

           ++i;

           $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
       });

       $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
       });

</script>
@endpush
