@extends('layouts.admin')

@section('title', 'Chi Tiết Bình Luận')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white text-center">
                <h3 class="mb-0">💬 Chi Tiết Bình Luận</h3>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h5><i class="ri-user-line"></i> Người Bình Luận:</h5>
                            <p class="text-muted">{{ $binhLuan->user->ten_nguoi_dung }}
                                ({{ $binhLuan->user->email ?? 'Không rõ' }})</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-book-2-line"></i> Bài Viết:</h5>
                            <p class="fw-bold">{{ $binhLuan->baiViet->tieu_de ?? 'Không xác định' }}</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-message-line"></i> Nội Dung:</h5>
                            <p class="text-muted">{{ $binhLuan->noi_dung }}</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-eye-line"></i> Trạng Thái:</h5>
                            <span
                                class="badge
                                @if ($binhLuan->trang_thai === true) bg-success
                                @else bg-secondary @endif">
                                @if ($binhLuan->trang_thai === true)
                                    Hiển thị
                                @else
                                    Đã ẩn
                                @endif
                            </span>

                        </div>

                        <div class="mb-3">
                            <h5><i class="ri-time-line"></i> Ngày Tạo:</h5>
                            <p>{{ $binhLuan->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <h5><i class="ri-history-line"></i> Cập Nhật:</h5>
                            <p>{{ $binhLuan->updated_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        @if ($binhLuan->replies && $binhLuan->replies->count())
                            <h5 class="mb-3"><i class="ri-reply-line"></i> Phản Hồi:</h5>
                            <ul class="list-group">
                                @foreach ($binhLuan->replies as $reply)
                                    <li class="list-group-item">
                                        <strong>{{ $reply->user->name ?? 'Ẩn danh' }}:</strong> {{ $reply->noi_dung }}
                                        <br>
                                        <small class="text-muted">{{ $reply->created_at->format('d-m-Y H:i') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Không có phản hồi nào.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.binhluans.index') }}" class="btn btn-outline-info">
                    <i class="ri-arrow-go-back-line"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
@endsection
