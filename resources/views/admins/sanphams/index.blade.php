@extends('layouts.admin')

@section('title')
    Sản phẩm
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

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
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Danh sách sản phẩm</h5>
                    <div class="right-options">
                        <ul>

                            <li>
                                <a class="btn btn-solid" href="{{ route('sanphams.create') }}">Thêm Mới</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Hình ảnh</th>
                                    <th>Khuyến mãi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            @foreach ($sanPhams as $index => $sanpham)
                                <tbody>

                                    <tr>

                                        <td>{{ $sanpham->ten_san_pham }}</td>

                                        <td>{{ $sanpham->ma_san_pham }}</td>

                                        <td>{{ $sanpham->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</td>

                                        <td>
                                            <div class="table-image">
                                                <img src="{{ asset('storage/' . $sanpham->hinh_anh) }}" class="img-thumbnail" alt="Hình ảnh" width="100px">
                                            </div>
                                        </td>

                                        <td>{{ $sanpham->khuyen_mai }}</td>

                                        {{-- <td class="">{{ $sanpham->ngay_nhap->format('d/m/Y') }}</td> --}}

                                        <td>  
                                            @if ($sanpham->trang_thai == 1)  
                                                <span class="badge bg-success-subtle text-success fs-6">Còn hàng</span>  
                                            @else  
                                                <span class="badge bg-danger-subtle text-danger fs-6">Hết hàng</span>  
                                            @endif  
                                        </td>

                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{route('sanphams.show', $sanpham->id)}}">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('sanphams.edit', $sanpham->id) }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sanpham->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                
                                                    <div class="modal fade" id="deleteModal{{ $sanpham->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">Bạn muốn xóa sản phẩm {{ $sanpham->ten_san_pham }} đúng không ?</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                    <form action="{{ route('sanphams.destroy', $sanpham->id) }}" method="POST">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>

                                    </tr>


                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
