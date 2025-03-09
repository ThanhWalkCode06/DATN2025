@section('js')
@endsection
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

<!-- Dropzon css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

<!-- Feather icon css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

<!-- remixicon css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

<!-- Select2 css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

<!-- Plugins css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">

<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

<!-- Bootstrap-tag input css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

<!-- App css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

<!-- App css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/load.css') }}">

<title>Quên mật khẩu</title>

<body>

    <div class="fullpage-loader">
        <span></span>
        <span></span>
        {{-- <span></span>
        {{-- <span></span> --}}
        <span></span>
        <span></span>
    </div>

    <body>
        <!-- log in section start -->
        <section class="log-in-section background-image-2 section-b-space">
            <div class="container-fluid-lg w-100">
                <div class="row">
                    <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                        <div class="image-contain">
                            <img src="{{ asset('assets/images/3275432.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>Seven Stars</h3>
                                <h4>Quên mật khẩu</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{ route('pass.sendLinkForgetPass') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input name="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Email Address">
                                            <label for="email">Email</label>
                                        </div>

                                    </div>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="col-12">
                                        <div class="forgot-box">
                                            <label for=""></label>
                                            <a style="float: right" href="{{ route('login') }}"
                                                class="forgot-password">Quay lại</a>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100 justify-content-center"
                                            type="submit">Gửi</button>
                                    </div>
                                </form>
                            </div>

                            {{-- <div class="sign-up-box">
                            <h4>Don't have an account?</h4>
                            <a href="sign-up.html">Sign Up</a>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <script>
        window.addEventListener('load', function () {
            let loader = document.querySelector('.fullpage-loader');
            console.log(loader)
            if (loader) { // Kiểm tra loader có tồn tại không
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500); // Ẩn hẳn sau 0.5 giây
            }
        });
    </script>
</body>
    </html>


@section('js')


    <script src="{{ asset('assets/js/config.js') }}"></script>


        <!-- bootstrap tag-input js -->
        <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

        <!-- customizer js -->
        <script src="{{ asset('assets/js/customizer.js') }}"></script>

        <!-- Dropzon js -->
        <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
        <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

        <!-- ck editor js -->
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/ckeditor-custom.js') }}"></script>

        <!-- select2 js -->
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
    @endsection
