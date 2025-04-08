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
                <h5>Quản lý danh mục</h5>
                <form class="d-inline-flex">
                    <a href="{{ route('danhmucsanphams.create', 1) }}" class="align-items-center btn btn-theme d-flex">
                        <i data-feather="plus"></i>Thêm mới
                    </a>
                </form>
            </div>

            <div class="table-responsive category-table">
                {{-- @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ session('success') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong> {{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
            <div>
                <table class="table all-package theme-table" id="table_id">
                    <thead>


                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Ảnh danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($danhMucs as $index => $danhMuc)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $danhMuc->ten_danh_muc }}</td>

                            <td>
                                <div class="table-image">
                                    <img src="{{ Storage::url('' . $danhMuc->anh_danh_muc) }}"
                                        class="img-thumbnail" alt="Hình ảnh" width="100px">
                                </div>
                            </td>

                            <td>
                                <ul>
                                    <li>
                                        <a href="{{ route('danhmucsanphams.edit', $danhMuc->id) }}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" onclick="confirmDelete(event, '{{ $danhMuc->id }}')">
                                            <i class="ri-delete-bin-line text-danger"></i>
                                        </a>

                                        <form id="delete-form-{{ $danhMuc->id }}"
                                            action="{{ route('danhmucsanphams.destroy', $danhMuc->id) }}"
                                            method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(event, id) {
        event.preventDefault();

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: 'Hành động này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Có, xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection