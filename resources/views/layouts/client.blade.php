<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="../assets/client/images/favicon/1.png" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/vendors/bootstrap.css') }}">

    <!-- Wow css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/animate.min.css') }}">

    <!-- Iconly css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/bulk-style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/style.css') }}">

    @yield('css')
</head>

<body class="bg-effect">

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    @include('clients.blocks.header')
    <!-- Header End -->

    @yield('breadcrumb')

    @yield('content')

    <!-- Footer Section Start -->
    @include('clients.blocks.footer')
    <!-- Footer Section End -->

    @include('clients.blocks.extra')

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Latest jQuery -->
    <script src="{{ asset('assets/client/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/client/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/client/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/bootstrap/popper.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/client/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload JS -->
    <script src="{{ asset('assets/client/js/lazysizes.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('assets/client/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/client/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height JS -->
    <script src="{{ asset('assets/client/js/auto-height.js') }}"></script>

    <!-- Price Range JS -->
    <script src="{{ asset('assets/client/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Sidebar Open JS -->
    <script src="{{ asset('assets/client/js/filter-sidebar.js') }}"></script>

    <!-- Quantity JS -->
    <script src="{{ asset('assets/client/js/quantity-2.js') }}"></script>

    <!-- Zoom JS -->
    <script src="{{ asset('assets/client/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/client/js/zoom-filter.js') }}"></script>

    <!-- Sticky Bar JS -->
    <script src="{{ asset('assets/client/js/sticky-cart-bottom.js') }}"></script>

    <!-- Timer JS -->
    <script src="{{ asset('assets/client/js/timer1.js') }}"></script>

    <!-- Fly Cart JS -->
    <script src="{{ asset('assets/client/js/fly-cart.js') }}"></script>

    <!-- Quantity JS -->
    <script src="{{ asset('assets/client/js/quantity-2.js') }}"></script>

    <!-- WOW JS -->
    <script src="{{ asset('assets/client/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/custom-wow.js') }}"></script>

    <!-- Script JS -->
    <script src="{{ asset('assets/client/js/script.js') }}"></script>

    <!-- Theme Setting JS -->
    <script src="{{ asset('assets/client/js/theme-setting.js') }}"></script>

    @yield('js')
</body>

</html>
