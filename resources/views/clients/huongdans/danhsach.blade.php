@extends('layouts.client')

@section('title')
Hướng Dẫn Sử Dụng
@endsection

@section('breadcrumb')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Hướng Dẫn Sử Dụng</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Hướng Dẫn</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="blog-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="blog-box blog-list wow fadeInUp">
                            <div class="blog-image">
                                <img src="../assets/images/guides/shopping-guide.jpg" class="blur-up lazyload" alt="Mẹo mua sắm quần áo thể thao">
                            </div>
                            <div class="blog-contain blog-contain-2">
                                <div class="blog-label">
                                    <span class="time"><i data-feather="clock"></i> <span>10 Mar, 2025</span></span>
                                    <span class="super"><i data-feather="user"></i> <span>Admin</span></span>
                                </div>
                                <a href="{{ route('huongdans.chitiet', 1) }}">
                                    <h3>Cách chọn quần áo thể thao phù hợp cho từng bộ môn</h3>
                                </a>
                                <p>Hướng dẫn chọn quần áo thể thao dựa trên chất liệu, kích thước và tính năng phù hợp với từng môn thể thao khác nhau.</p>
                                <button onclick="location.href = '{{ route('huongdans.chitiet', 1) }}';" class="blog-button">Đọc thêm <i class="fa-solid fa-right-long"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="blog-box blog-list wow fadeInUp">
                            <div class="blog-image">
                                <img src="../assets/images/guides/clothing-care.jpg" class="blur-up lazyload" alt="Bảo quản quần áo thể thao">
                            </div>
                            <div class="blog-contain blog-contain-2">
                                <div class="blog-label">
                                    <span class="time"><i data-feather="clock"></i> <span>15 Mar, 2025</span></span>
                                    <span class="super"><i data-feather="user"></i> <span>Admin</span></span>
                                </div>
                                <a href="{{ route('huongdans.chitiet', 2) }}">
                                    <h3>Mẹo bảo quản và giặt quần áo thể thao đúng cách</h3>
                                </a>
                                <p>Hướng dẫn chi tiết cách giặt, phơi và bảo quản quần áo thể thao để kéo dài tuổi thọ và giữ hiệu suất tối đa.</p>
                                <button onclick="location.href = '{{ route('huongdans.chitiet', 2) }}';" class="blog-button">Đọc thêm <i class="fa-solid fa-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                @include('clients.huongdans.sidebar')
            </div>
        </div>
    </div>
</section>
@endsection