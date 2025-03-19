@extends('layouts.client')

@section('title')
Cách chọn quần áo thể thao phù hợp
@endsection

@section('css')
@endsection

@section('breadcrumb')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Cách chọn quần áo thể thao phù hợp</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Hướng dẫn</li>
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
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-3 col-xl-4 col-lg-5 d-lg-block d-none">
                @include('clients.huongdans.sidebar')
            </div>

            <div class="col-xxl-9 col-xl-8 col-lg-7 ratio_50">
                <div class="blog-detail-image rounded-3 mb-4">
                    <img src="../assets/images/sportswear/cover.jpg" class="bg-img blur-up lazyload" alt="Cách chọn quần áo thể thao">
                    <div class="blog-image-contain">
                        <h2>Cách chọn quần áo thể thao phù hợp cho từng bộ môn</h2>
                    </div>
                </div>

                <div class="blog-detail-contain">
                    <h3>1. Chạy bộ</h3>
                    <p>Quần áo chạy bộ cần thoáng khí, co giãn tốt và thấm hút mồ hôi nhanh. Chất liệu polyester hoặc vải dri-fit là lựa chọn lý tưởng.</p>
                    <img src="../assets/images/sportswear/running.jpg" class="img-fluid rounded" alt="Quần áo chạy bộ">

                    <h3>2. Tập gym</h3>
                    <p>Trang phục tập gym nên có độ co giãn tốt, ôm sát nhưng không quá chật để dễ dàng vận động. Áo tank top và quần legging là lựa chọn phổ biến.</p>
                    <img src="../assets/images/sportswear/gym.jpg" class="img-fluid rounded" alt="Quần áo tập gym">

                    <h3>3. Yoga</h3>
                    <p>Quần áo yoga cần mềm mại, co giãn tốt và ôm sát để giúp thực hiện các động tác linh hoạt. Chất liệu cotton pha spandex là lựa chọn phù hợp.</p>
                    <img src="../assets/images/sportswear/yoga.jpg" class="img-fluid rounded" alt="Quần áo yoga">

                    <h3>4. Bơi lội</h3>
                    <p>Đồ bơi cần có chất liệu chống thấm nước, co giãn tốt và ôm sát cơ thể để giảm lực cản khi bơi.</p>
                    <img src="../assets/images/sportswear/swimming.jpg" class="img-fluid rounded" alt="Đồ bơi">

                    <h3>5. Đạp xe</h3>
                    <p>Quần áo đạp xe thường có thiết kế bó sát, chất liệu thoáng khí và có đệm ở quần để tạo sự thoải mái khi đạp xe đường dài.</p>
                    <img src="../assets/images/sportswear/cycling.jpg" class="img-fluid rounded" alt="Quần áo đạp xe">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection