@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@extends('layouts.admin')

@section('title')
    Quản lý bình luận
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card card-table">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Quản lý bình luận</h5>
                <div class="right-options">
                    <form action="{{ route('binhluans.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm nội dung..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive category-table">
                <table class="table all-package theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bài viết</th>
                            <th>Người dùng</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($binhLuans as $index => $bl)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bl->baiViet->tieu_de ?? 'Không xác định' }}</td>
                                <td>{{ $bl->user->ten_nguoi_dung }}</td>
                                <td>{{ Str::limit($bl->noi_dung, 80) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('binhluans.toggle', $bl->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm {{ $bl->trang_thai ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $bl->trang_thai ? 'Hiển thị' : 'Đã ẩn' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $bl->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('binhluans.show', $bl->id) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <form action="{{ route('binhluans.destroy', $bl->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: none;">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </li> --}}
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $binhLuans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
