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
                        <p class="first-letter">{!! nl2br(e($baiViet->noi_dung)) !!}</p>
                    </div>

                </div>
                <div class="comment-box overflow-hidden">
                    <div class="leave-title">
                        <p><span class="fw-bold" style="font-size: 16px ">Bình luận : </span>{{ $countComment }} lượt</p>
                    </div>

                    @foreach ($comments as $comment)
                        <div class="card mb-4 shadow-sm p-3 border-0">
                            <div class="d-flex">
                                {{-- Avatar người bình luận --}}
                                @if ($comment->user && $comment->user->avatar)
                                    <img src="{{ env('VIEW_IMG') }}/{{ $comment->user->avatar }}"
                                        class="rounded-circle me-3 border"
                                        style="width: 60px; height: 60px; object-fit: cover;" alt="Avatar">
                                @else
                                    <img src="{{ env('APP_URL') }}/clients/img/avatar-default.jpg"
                                        class="rounded-circle me-2 border"
                                        style="width: 50px; height: 50px; object-fit: cover;" alt="Avatar">
                                @endif


                                <div class="flex-grow-1">
                                    {{-- Tên người bình luận và thời gian --}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1 text-primary">{{ $comment->user->name ?? 'Unknown' }}</h5>
                                        <small class="text-muted">
                                            {{ $comment->updated_at->format('d-m-Y') }} lúc
                                            {{ $comment->updated_at->format('H:i') }}
                                            @if ($comment->created_at != $comment->updated_at)
                                                <span class="text-info">(Chỉnh sửa)</span>
                                            @endif
                                        </small>
                                    </div>

                                    {{-- Nội dung bình luận --}}
                                    <div class="mt-2">
                                        <strong class="text-secondary">Nội dung:</strong>
                                        <p class="mb-1">{{ $comment->content }}</p>
                                    </div>


                                    {{-- Hiển thị các trả lời --}}
                                    @php
                                        $replies = $product
                                            ->comments()
                                            ->where('parent_user_id', $comment->user_id)
                                            ->get();
                                        // @dd($comment->id);
                                    @endphp

                                    @if ($replies->count() > 0)
                                        <div class="mt-3 ps-3 border-start">
                                            <h6 class="fw-bold text-secondary">Phản hồi:</h6>
                                            @foreach ($replies as $rep)
                                                <div class="d-flex mt-3 bg-light p-2 rounded-3 shadow-sm">
                                                    {{-- Avatar người trả lời --}}
                                                    @if ($rep->user && $rep->user->avatar)
                                                        <img src="{{ env('VIEW_IMG') }}/{{ $rep->user->avatar }}"
                                                            class="rounded-circle me-2 border"
                                                            style="width: 50px; height: 50px; object-fit: cover;"
                                                            alt="Avatar">
                                                    @else
                                                        <img src="{{ env('APP_URL') }}/clients/img/avatar-default.jpg"
                                                            class="rounded-circle me-2 border"
                                                            style="width: 50px; height: 50px; object-fit: cover;"
                                                            alt="Avatar">
                                                    @endif

                                                    <div class="flex-grow-1">
                                                        {{-- Tên người trả lời --}}
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-1 text-dark">
                                                                {{ $rep->user->name ?? 'No name' }}
                                                                <span class="badge bg-success">Admin</span>
                                                            </h6>
                                                            <small class="text-muted">
                                                                {{ $rep->updated_at->format('d-m-Y') }} lúc
                                                                {{ $rep->updated_at->format('H:i') }}
                                                                @if ($rep->created_at != $rep->updated_at)
                                                                    <span class="text-info">(Chỉnh sửa)</span>
                                                                @endif
                                                            </small>
                                                        </div>

                                                        {{-- Nội dung trả lời --}}
                                                        <div class="mt-1">
                                                            <strong class="text-secondary">Nội dung:</strong>
                                                            <p class="mb-1">{{ $rep->content }}</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            @include('clients.baiviets.sidebar')
        </div>
        </div>

    </section>
@endsection
