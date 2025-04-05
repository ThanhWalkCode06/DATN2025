<footer class="section-t-space">
    <div class="container-fluid-lg">
        <div class="service-section">
            <div class="row g-3">
                <div class="col-12">
                    <div class="service-contain">
                        <div class="service-box">
                            <div class="service-image">
                                <i class="fa-solid fa-shirt custom-icon"></i> <!-- Icon áo -->
                            </div>
                            <div class="service-detail">
                                <h5>Mẫu "hot trend" mỗi ngày</h5>
                            </div>
                        </div>
                        <style>
                            .custom-icon {
                                font-size: 28px;
                                /* Điều chỉnh kích thước icon */
                                color: #babac4;
                                /* Màu xám nhạt giống icon cũ */
                            }
                        </style>

                        <div class="service-box">
                            <div class="service-image">
                                <i class="fa-solid fa-truck custom-icon"></i>
                            </div>

                            <div class="service-detail">
                                <h5>Giao hàng nhanh chóng</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <i class="fa-solid fa-percent custom-icon"></i>
                            </div>

                            <div class="service-detail">
                                <h5>Giảm giá mỗi ngày</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <i class="fa-solid fa-money-check-dollar custom-icon"></i>
                            </div>

                            <div class="service-detail">
                                <h5>Giá tốt nhất trên thị trường</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-footer section-b-space section-t-space">
            <div class="row g-md-4 g-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-logo">
                        <div class="theme-logo">
                            <a href="{{ route('home') }}">
                                <img style="width: 200px"
                                    src="{{ Storage::url($globalSetting->client_logo ?? '/images/logo-green.png') }}"
                                    class="blur-up lazyload" alt="">
                        </div>

                        <div class="footer-logo-contain">
                            <p>Chúng tôi chuyên cung cấp quần áo thể thao chất lượng cao, giúp bạn tự tin và thoải mái
                                trong mọi hoạt động.</p>
                            <ul class="address">
                                <li>
                                    <i data-feather="home"></i>
                                    <a
                                        href="{{ $globalSetting->url_map ?? '' }}">
                                        {{ $globalSetting->location ?? '' }}.</a>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Danh mục sản phẩm</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            @if (isset($danhMucsp) && $danhMucsp->count() > 0)
                                @foreach ($danhMucsp as $danhMuc)
                                    <li>
                                        <a href="{{ route('sanphams.danhsach', ['danh_muc_id' => $danhMuc->id]) }}"
                                            class="text-content">
                                            {{ $danhMuc->ten_danh_muc }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>Không có danh mục nào.</li>
                            @endif
                        </ul>
                    </div>
                </div>



                <div class="col-xl col-lg-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Mục khác</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}" class="text-content">Trang chủ</a>
                            </li>
                            <li>
                                <a href="{{ route('sanphams.danhsach') }}" class="text-content">Cửa hàng</a>
                            </li>
                            <li>
                                <a href="{{ route('gioithieu') }}" class="text-content">Về chúng tôi</a>
                            </li>
                            <li>
                                <a href="{{ route('baiviets.danhsach') }}" class="text-content">Tin tức</a>
                            </li>
                            <li>
                                <a href="{{ route('lienhe.home') }}" class="text-content">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-xl-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Hỗ trợ</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            @foreach ($baivietSupport as $item)
                            <li>
                                <a href="{{ route('baiviets.chitiet',$item->id) }}" class="text-content">{{ $item->tieu_de }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Liên hệ với chúng tôi</h4>
                    </div>

                    <div class="footer-contact">
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <i data-feather="phone"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5>{{ $globalSetting->phone ?? 'Chưa cập nhật' }}</h5>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="footer-number">
                                    <i data-feather="mail"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Địa chỉ email :</h6>
                                        <h5>{{ $globalSetting->email_owner ?? 'Chưa cập nhật' }}</h5>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="reserve">
                <h6 class="text-content">©2025 {{ $globalSetting->name_website ?? 'Tên website chưa cập nhật' }}</h6>
            </div>

            <div class="payment">
                <img src="../assets/client/images/payment/1.png" class="blur-up lazyload" alt="">
            </div>

            <div class="social-link">
                <h6 class="text-content">Kết nối với chúng tôi:</h6>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</footer>
