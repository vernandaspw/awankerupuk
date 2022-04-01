<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TCA</title>

    <link href="{{ asset('vendor/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/front/css/responsive.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/awankerupuk.jpg') }}" type="image/x-icon">

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('vendor/front/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('vendor/front/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('vendor/front/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('vendor/front/images/ico/apple-touch-icon-57-precomposed.png') }}">
    @livewireStyles
</head>
<!--/head-->

<body>
    @include('sweetalert::alert')

    {{-- @include('includes.customers.header') --}}
    <livewire:customer-header />
    @yield('content')
    @include('includes.customers.footer')


    @livewireScripts

    <script src="{{ asset('vendor/front/js/jquery.js') }}"></script>
    <script src="{{ asset('vendor/front/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('vendor/front/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('vendor/front/js/price-range.js') }}"></script>
    <script src="{{ asset('vendor/front/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('vendor/front/js/main.js') }}"></script>


</body>

</html>
