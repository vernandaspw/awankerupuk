@extends('layouts.offices')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kelola data akun Customer</h1>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary"> Data</h5>

                <div class="bukngkus">

                </div>

            </div>
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NoHP</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @forelse ($datas as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->nohp }}</td>
                            <td>{{ $data->email }}</td>
                            <td><a href="{{ url('/office/akuncustomer', $data->id) }}"
                                    class="btn btn-sm btn-info text-white">Lihat</a>
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
