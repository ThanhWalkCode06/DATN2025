@extends('layouts.admin')

@section('title', 'Chi Tiết Bình Luận')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white text-center">
                <h3 class="mb-0">💬 Chi Tiết Bình Luận</h3>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    {{-- Thông tin chi tiết --}}
                    <div class="col-md-6">
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
                            <span class="badge text-white px-3 py-2 fw-bold"
                                style="background-color: {{ $binhLuan->trang_thai ? '#28a745' : '#dc3545' }}">
                                {{ $binhLuan->trang_thai ? 'Hiển thị' : 'Đã ẩn' }}
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

                    {{-- Phản hồi & Form --}}
                    <div class="col-md-6">
                        {{-- Danh sách phản hồi --}}
                        <div class="mb-4">
                            <h5 class="mb-3"><i class="ri-reply-line"></i> Phản Hồi:</h5>
                            @if ($binhLuan->replies && $binhLuan->replies->count())
                                <ul class="list-group">
                                    @foreach ($binhLuan->replies as $reply)
                                        <li class="list-group-item">
                                            <strong>{{ $reply->user->ten_nguoi_dung }}:</strong> {{ $reply->noi_dung }}
                                            <br>
                                            <small class="text-muted">{{ $reply->created_at->format('d-m-Y H:i') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Không có phản hồi nào.</p>
                            @endif
                        </div>

                        {{-- Form trả lời --}}
                        <div>
                            <h5 class="text-success"><i class="ri-chat-new-line"></i> Trả lời Bình luận</h5>
                            <form action="{{ route('admins.binhluan.store', $binhLuan->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="content" class="form-label">Nội dung phản hồi</label>
                                    <textarea name="content" id="content" class="form-control" rows="4"></textarea>
                                </div>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-success">Gửi phản hồi</button>
                            </form>
                        </div>
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
