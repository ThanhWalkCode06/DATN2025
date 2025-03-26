<style>
   .blog-image {
    width: 300px;
    height: 180px;
    overflow: hidden;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 8px;
}


</style>
@extends('layouts.client')

@section('content')
<section class="blog-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                <div class="row g-4">

                    @foreach($baiViets as $baiViet)
                        <div class="col-12">
                            <div class="blog-box blog-list wow fadeInUp">
                                <!-- Hình ảnh bài viết -->
                                <div class="blog-image flex-shrink-0 me-3" style="width: 340px; height: 217px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $baiViet->anh_bia) }}" class="blog-image-full" alt="{{ $baiViet->tieu_de }}">
                                </div>


                                <div class="blog-contain blog-contain-2">
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="fa-regular fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($baiViet->created_at)->format('d M, Y') }}
                                        &nbsp; | &nbsp;
                                        <i class="fa-regular fa-user me-1"></i>
                                        {{ $baiViet->user->ten_nguoi_dung  }}
                                    </div>

                                    <a href="{{ route('baiviets.chitiet', $baiViet->id) }}">
                                        <h3 class="">{{ $baiViet->tieu_de }}</h3>
                                    </a>

                                    <p class="text-muted">{!! Str::limit(strip_tags($baiViet->noi_dung), 150) !!}</p>

                                    <button onclick="location.href = '{{ route('baiviets.chitiet', $baiViet->id) }}';"
                                        class="blog-button">Chi
                                        Tiết <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $baiViets->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Sidebar -->
            @include('clients.baiviets.sidebar')
        </div>
    </div>
</section>
@endsection
