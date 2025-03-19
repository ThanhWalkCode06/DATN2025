@extends('layouts.client')
@section('title')
    Quên mật khẩu
@endsection
@section('content')

    <body>
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>Quên mật khẩu</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('login.client') }}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Quên mật khẩu</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- log in section start -->
        <section class="log-in-section section-b-space forgot-section">
            <div class="container-fluid-lg w-100">
                <div class="row">
                    <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                        <div class="image-contain">
                            <img src="../assets/images/inner-page/forgot.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="log-in-box">
                                <div class="log-in-title">
                                    <h3>Chào mừng tới Seven Stars</h3>
                                    <h4>Quên mật khẩu</h4>
                                </div>

                                <div class="input-box">
                                    <form class="row g-4" method="POST"
                                        action="{{ route('pass.sendLinkForgetPass.client') }}">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating log-in-form">
                                                <input style="border: 1px solid #0e947a" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    placeholder="Email Address" name="email" value="{{ old('email') }}">
                                                <label for="email">Địa chỉ email</label>
                                            </div>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <a style="font-size: 16px" href="{{ route('login.client') }}" class="back">Trở lại
                                            đăng nhập</a>

                                        <div class="col-12">
                                            <button class="btn btn-animation w-100" type="submit">Quên mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->



    </body>

    </html>
@endsection
