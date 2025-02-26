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
    Danh mục sản phẩm
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Quản lý danh mục bài viết</h5>
                    <a href="{{ route('baiviets.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="table-responsive category-table">
                    <div>
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên tài khoản</th>
                                    <th>Tiêu Đề</th>
                                    <th>Tên danh mục</th>
                                    <th>Ảnh Bìa</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($baiViets as $index => $baiViet)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $baiViet->user->name }}</td>
                                        <td>{{ $baiViet->tieu_de }}</td>
                                        <td>{{ $baiViet->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $baiViet->anh_bia) }}" alt="Ảnh bài viết" width="100" >
                                        </td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('baiviets.show', $baiViet->id) }}">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('baiviets.edit', $baiViet->id) }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('baiviets.destroy', $baiViet->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border: none; background: none;">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
