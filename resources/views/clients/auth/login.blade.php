@extends('layouts.client')
<style>
    input {
        border: 1px solid #0da487 !important;
    }
</style>
@section('css')
@endsection
@section('title')
    Đăng nhập
@endsection

@section('content')

    <body>
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2 class="mb-2">Đăng nhập</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Đăng nhập</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Đăng nhập section start -->
        <section class="log-in-section section-b-space">
            <div class="container-fluid-lg w-100">
                <div class="row">
                    <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                        <div class="image-contain">
                            <img src="{{ asset('assets/images/inner-page/log-in.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>Chào mừng tới Seven Stars</h3>
                                <h4>Đăng nhập tài khoản của bạn</h4>
                            </div>
                            <div class="input-box">
                                <form class="row g-4" action="{{ route('login.store.client') }}" method="POST">
                                    @csrf
                                    <div class="col-12 ">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input name="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="fullname"
                                                placeholder="Tên tài khoản" value="{{ old('username') }}">
                                            <label for="username error-username">Tên tài khoản</label>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="form-floating theme-form-floating log-in-form">
                                                <input name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" placeholder="Password" value="{{ old('password') }}">
                                                <label for="password">Mật khẩu</label>
                                            </div>
                                            @error('password')
                                                <p class="text-danger" id="error-username">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="forgot-box">
                                                <div class="form-check ps-0 m-0 remember-box">
                                                    <input class="checkbox_animated check-box" type="checkbox"
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">Nhớ mật
                                                        khẩu</label>
                                                </div>
                                                <a href="{{ route('pass.forget.client') }}" class="forgot-password">Quên mật
                                                    khẩu?</a>
                                            </div>
                                        </div>
                                        @error('error')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="col-12 mt-3">
                                            <button class="btn btn-animation w-100 justify-content-center"
                                                type="submit">Đăng
                                                nhập</button>
                                        </div>
                                </form>
                            </div>


                            <div class="other-log-in">
                                <h6></h6>
                            </div>

                            <div class="sign-up-box">
                                <h4>Bạn không có tài khoản?</h4>
                                <a href="{{ route('register.client') }}">Đăng ký ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </html>
@endsection
@section('js')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
