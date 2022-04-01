@auth('office')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Office TCA</title>
    <link rel="shortcut icon" href="{{  asset('assets/awankerupuk.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('vendor/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('vendor/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


    @livewireStyles()
</head>

<body id="page-top">
    @include('sweetalert::alert')
    <div id="wrapper">
        {{-- @include('includes.offices.sidebar') --}}
        <livewire:office-sidebar />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('includes.offices.topbar')
                @yield('content')
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script>
        function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id)
                        .attr('src', e.target.result)
                        .width(200)
                        .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
     }
    </script>
    <script src="{{ asset('vendor/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('vendor/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/sbadmin/vendor/chart.js/Chart.min.js')  }}"></script>
    <script src="{{asset('vendor/sbadmin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('vendor/sbadmin/js/demo/chart-pie-demo.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('vendor/sbadmin/js/demo/datatables-demo.js') }}"></script>
    @stack('script')
</body>

</html>





@else





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Office TCA</title>
    <link rel="shortcut icon" href="{{  asset('assets/awankerupuk.jpg') }}" type="image/x-icon">
    <link href="{{ asset('vendor/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('vendor/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @livewireStyles
</head>


<body class="bg-gradient-danger">
    @include('sweetalert::alert')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block"><img
                                    src="{{ asset('assets/awankerupuk.jpg') }}" alt=""></div> --}}
                            <div class="col-lg-12">

                                <div class="p-5 m-4">
                                    <div class="text-center">

                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back To Office TCA!</h1>
                                        <h3 class="h4 text-gray-900 mb-4">Office Masuk</h3>

                                    </div>
                                    <form class="user" method="POST" action="{{url('office/login')}}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input name='email' type="email"
                                                class="form-control form-control-user  @error('email') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input name='password' type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password? silahkan hubungi
                                            admin</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @livewireScripts
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('vendor/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>

@endauth
