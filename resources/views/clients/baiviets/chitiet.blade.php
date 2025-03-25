@extends('layouts.client')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .blog-image-contain {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 80%;
            color: #333;
        }

        .blog-category h2 {
            font-size: 14px;
            font-weight: 400;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .blog-detail-title {
            font-size: 32px;
            font-weight: 600;
            color: #222;
        }

        .contain-comment-list {
            margin-top: 8px;
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
            font-size: 14px;
            color: #666;
        }

        .contain-comment-list i {
            margin-right: 5px;
            color: #666;
        }

        .user-list {
            display: flex;
            align-items: center;
        }

        .first-letter::first-letter {
            text-transform: uppercase;
            font-size: 2em;
            font-weight: bold;
        }
    </style>

    <section class="blog-detail section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="ratio_50 position-relative">
                        <div class="blog-detail-image rounded-3 overflow-hidden position-relative">
                            <img src="{{ asset('storage/' . $baiViet->anh_bia) }}"
                                class="bg-img blur-up lazyload w-100 h-100 object-fit-cover" alt="{{ $baiViet->tieu_de }}">

                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.6));">
                            </div>

                            <div class="blog-image-contain">
                                @if ($baiViet->danhMuc)
                                    <div class="blog-category mb-2">
                                        <h2>{{ $baiViet->danhMuc->ten_danh_muc }}</h2>
                                    </div>
                                @endif

                                <h1 class="blog-detail-title">{{ $baiViet->tieu_de }}</h1>
                                <ul class="contain-comment-list">
                                    <li>
                                        <div class="user-list">
                                            <i data-feather="user"></i>
                                            <span>{{ $baiViet->tac_gia ?? 'Admin' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="user-list">
                                            <i data-feather="calendar"></i>
                                            <span>{{ date('F d, Y', strtotime($baiViet->created_at)) }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="blog-detail-contain mt-4">
                        <p class="first-letter">{!! $baiViet->noi_dung !!}</p>
                    </div>

                </div>

                @include('clients.baiviets.sidebar')
            </div>
        </div>
    </section>
@endsection
