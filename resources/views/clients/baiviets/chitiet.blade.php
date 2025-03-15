@extends('layouts.client')

@section('content')
<section class="blog-detail section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                <div class="blog-box">
                    <div class="blog-image">
                        <img src="{{ asset('storage/' . $baiViet->hinh_anh) }}" class="img-fluid blur-up lazyload" alt="{{ $baiViet->tieu_de }}">
                    </div>
                    <div class="blog-detail-contain">
                        <h2>{{ $baiViet->tieu_de }}</h2>
                        <p>{{ $baiViet->noi_dung }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            @include('clients.baiviets.sidebar')
        </div>
    </div>
</section>
@endsection
