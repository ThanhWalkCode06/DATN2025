@extends('layouts.client')

@section('title')
    Giới thiệu
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Giới thiệu</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Giới thiệu</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Seven Stars Sportswear Section Start -->
    <section class="sportswear-section section-lg-space">
        <div class="container-fluid-lg">
            <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
                <!-- Hình ảnh sản phẩm thể thao -->
                <div class="col-xl-6 col-12">
                    <div class="row g-sm-4 g-2">
                        <div class="col-6">
                            <div class="sports-image">
                                <div>
                                    <img src="https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/April2024/24CMAW.AT011.1_91.jpg"
                                        class="bg-img blur-up lazyload" alt="Sportswear Collection">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="sports-image">
                                <div>
                                    <img src="https://donex.vn/upload/image/product/36950104_1.jpg"
                                        class="bg-img blur-up lazyload" alt="Latest Sportswear">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nội dung giới thiệu -->
                <div class="col-xl-6 col-12">
                    <div class="sportswear-contain p-center-left">
                        <div>
                            <div class="review-title">
                                <h4>About Seven Stars</h4>
                                <h2>Nâng cao hiệu suất của bạn với trang phục thể thao của chúng tôi</h2>
                            </div>

                            <div class="product-info">
                                <p class="text-content">
                                    Seven Stars là điểm đến cuối cùng của bạn cho trang phục thể thao cao cấp. Cho dù bạn
                                    đang đến
                                    phòng tập thể dục,
                                    chạy trên đường đua hay tham gia môn thể thao yêu thích của mình, trang phục hiệu suất
                                    cao của chúng tôi
                                    giúp bạn thoải mái và phong cách. Được thiết kế cho các vận động viên, bởi các vận động
                                    viên, bộ sưu tập của chúng tôi đảm bảo
                                    tính linh hoạt,
                                    độ bền và khả năng thoáng khí để nâng cao mọi chuyển động của bạn. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Seven Stars Sportswear Section End -->

    <!-- Client Section Start -->
    <section class="client-section section-lg-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-title text-center">
                        <h4>Về Chúng Tôi</h4>
                        <h2 class="center">Seven Stars - Niềm Tin Của Khách Hàng</h2>
                    </div>

                    <div class="slider-3_1 product-wrapper">
                        <div>
                            <div class="clint-contain">
                                <div class="client-icon">
                                    {{-- <img src="../assets/images/icons/experience.svg" class="blur-up lazyload"
                                        alt=""> --}}
                                </div>
                                <h2>10+</h2>
                                <h4>Năm Kinh Nghiệm</h4>
                                <p>Seven Stars tự hào với hơn 10 năm hoạt động trong ngành thời trang thể thao, mang đến
                                    những sản phẩm chất lượng cao cho khách hàng.</p>
                            </div>
                        </div>

                        <div>
                            <div class="clint-contain">
                                <div class="client-icon">
                                    {{-- <img src="../assets/images/icons/products.svg" class="blur-up lazyload" alt=""> --}}
                                </div>
                                <h2>100K+</h2>
                                <h4>Sản Phẩm Đã Bán</h4>
                                <p>Chúng tôi đã cung cấp hơn 100,000 sản phẩm đến tay khách hàng, khẳng định chất lượng và
                                    sự tin cậy trong ngành thời trang thể thao.</p>
                            </div>
                        </div>

                        <div>
                            <div class="clint-contain">
                                <div class="client-icon">
                                    {{-- <img src="../assets/images/icons/happy-customers.svg" class="blur-up lazyload"
                                        alt=""> --}}
                                </div>
                                <h2>95%</h2>
                                <h4>Khách Hàng Hài Lòng</h4>
                                <p>Với chất lượng sản phẩm và dịch vụ tận tâm, 95% khách hàng của chúng tôi đều hài lòng và
                                    quay lại mua sắm lần sau.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section End -->
    <!-- Team Section Start -->
    <section class="team-section section-lg-space">
        <div class="container-fluid-lg">
            <div class="about-us-title text-center">
                <h4 class="text-content">Đội ngũ sáng tạo</h4>
                <h2 class="center">Seven Stars</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-user product-wrapper">

                        <!-- Member 1 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/bach.jpg" class="img-fluid blur-up lazyload"
                                        alt="Lê Minh Bách">
                                </div> -->
                                <div class="team-name">
                                    <h3>Lê Minh Bách</h3>
                                    <h5>Leader</h5>
                                    <!-- <p>Leading Seven Stars towards innovation in sports fashion.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 2 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/duc.jpg" class="img-fluid blur-up lazyload"
                                        alt="Nguyễn Văn Đức">
                                </div> -->
                                <div class="team-name">
                                    <h3>Nguyễn Văn Đức</h3>
                                    <!-- <h5>Head of Design</h5>
                                    <p>Creating stylish and functional sportswear.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 3 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/liem.jpg" class="img-fluid blur-up lazyload"
                                        alt="Nguyễn Văn Liêm">
                                </div> -->
                                <div class="team-name">
                                    <h3>Nguyễn Văn Liêm</h3>
                                    <!-- <h5>Marketing Director</h5>
                                    <p>Spreading the Seven Stars brand worldwide.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 4 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/binh.jpg" class="img-fluid blur-up lazyload"
                                        alt="Phan Xuân Bình">
                                </div> -->
                                <div class="team-name">
                                    <h3>Phan Xuân Bình</h3>
                                    <!-- <h5>Operations Manager</h5>
                                    <p>Ensuring smooth production and delivery.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 5 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/nhat.jpg" class="img-fluid blur-up lazyload"
                                        alt=" Minh Nhật">
                                </div> -->
                                <div class="team-name">
                                    <h3> Trịnh Minh Nhật</h3>
                                    <!-- <h5>Lead Developer</h5>
                                    <p>Building the best online shopping experience.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 6 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/thanh.jpg" class="img-fluid blur-up lazyload"
                                        alt="nguyễn Trọng Thanh">
                                </div> -->
                                <div class="team-name">
                                    <h3>Nguyễn Trọng Thanh</h3>
                                    <!-- <h5>Customer Support</h5>
                                    <p>Ensuring the best service for our customers.</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Member 7 -->
                        <div>
                            <div class="team-box">
                                <!-- <div class="team-image">
                                    <img src="../assets/images/team/phuc.jpg" class="img-fluid blur-up lazyload"
                                        alt="Nguyễn Thọ Phúc">
                                </div> -->
                                <div class="team-name">
                                    <h3>Nguyễn Thọ Phúc</h3>
                                    <!-- <h5>Position</h5>
                                    <p>Expanding our team for better services.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Review Section Start -->
    <section class="review-section section-lg-space">
        <div class="container-fluid">
            <div class="about-us-title text-center">
                <h4 class="text-content">Đánh giá</h4>
                <h2 class="center">Nhận xét từ khách hàng</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="slider-4-half product-wrapper">
                        @forelse($danhGias as $danhGia)
                            @if ($danhGia->so_sao == 5)
                                <div>
                                    <div class="reviewer-box">
                                        <i class="fa-solid fa-quote-right"></i>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        <i data-feather="star"
                                                            class="{{ $i <= $danhGia->so_sao ? 'fill' : '' }}"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>

                                        <h3>{{ $danhGia->user->ten_nguoi_dung ?? 'Khách hàng đánh giá' }}</h3>

                                        <p>"{{ $danhGia->nhan_xet }}"</p>

                                        <div class="reviewer-profile">
                                            <div class="reviewer-image">
                                                <img src="{{ asset(Storage::url($danhGia->user->anh_dai_dien)) }}"
                                                    alt="Ảnh đại diện">
                                            </div>

                                            <div class="reviewer-name">
                                                <h4>{{ $danhGia->ten_nguoi_dung }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-center">Chưa có đánh giá 5 sao nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Review Section End -->


    <!-- Blog Section Start -->
    <section class="section-lg-space">
        <div class="container-fluid-lg">
            <div class="about-us-title text-center">
                <h4 class="text-content">Bài viết</h4>
                <h2 class="center">Blog mới nhất của chúng tôi</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-5 ratio_87">
                        @if (isset($baiViets) && $baiViets->count() > 0)
                            @foreach ($baiViets as $baiViet)
                                <div>
                                    <div class="blog-box">
                                        <div class="blog-box-image">
                                            <div class="blog-image">
                                                <a href="{{ route('baiviets.chitiet', $baiViet->id) }}" class="rounded-3">
                                                    <img src="{{ asset(Storage::url($baiViet->anh_bia)) }}"
                                                        class="bg-img blur-up lazyload" alt="{{ $baiViet->tieu_de }}">
                                                </a>
                                            </div>
                                        </div>

                                        <a href="{{ route('baiviets.chitiet', $baiViet->id) }}"
                                            class="blog-detail d-block">
                                            <h6>{{ $baiViet->danhMuc->ten_danh_muc ?? 'Chưa có danh mục' }}</h6>
                                            <h5>{{ $baiViet->tieu_de }}</h5>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Chưa có bài viết nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@section('js')
@endsection
