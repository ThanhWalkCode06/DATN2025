@extends('layouts.client')

@section('title')
    Liên hệ
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Liên hệ</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Liên hệ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Phần hộp liên hệ bắt đầu -->
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    {{-- <img src="../assets/images/inner-page/contact-us.png"
                                        class="img-fluid blur-up lazyloaded" alt=""> --}}
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Liên hệ với chúng tôi</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Điện thoại</h4>
                                                </div>
                                                <div class="contact-detail-contain">
                                                    <p>0987654321</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>
                                                <div class="contact-detail-contain">
                                                    <p>starsseven.2025@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Liên hệ</h2>
                    </div>
                    <div class="right-sidebar-box">
                        <!-- Form gửi liên hệ -->
                        <form action="{{ route('send.contact') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="first_name" class="form-label">Họ</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nhập họ" required>
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="last_name" class="form-label">Tên</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nhập tên" required>
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="email" class="form-label">Địa chỉ Email</label>
                                        <div class="custom-input">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <div class="custom-input">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" maxlength="10" required>
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="message" class="form-label">Tin nhắn</label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="message" name="message" placeholder="Nhập tin nhắn của bạn" rows="6" required></textarea>
                                            <i class="fa-solid fa-message"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-animation btn-md fw-bold ms-auto">Gửi tin nhắn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Phần hộp liên hệ kết thúc -->
@endsection

@section('js')
@endsection
