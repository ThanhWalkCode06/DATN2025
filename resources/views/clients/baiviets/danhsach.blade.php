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
                                <div class="blog-image">
                                    <a href="{{ route('baiviets.chitiet', $baiViet->id) }}">
                                        <img src="{{ asset('storage/' . $baiViet->hinh_anh) }}" class="blur-up lazyload" alt="{{ $baiViet->tieu_de }}">
                                    </a>
                                </div>
                                <div class="blog-contain blog-contain-2">
                                    <a href="{{ route('baiviets.chitiet', $baiViet->id) }}">
                                        <h3>{{ $baiViet->tieu_de }}</h3>
                                    </a>
                                    <p>{{ Str::limit($baiViet->noi_dung, 150) }}</p>
                                    <a href="{{ route('baiviets.chitiet', $baiViet->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
