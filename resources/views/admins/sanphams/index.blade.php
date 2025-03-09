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
    <style>
        label {

            display: none;

        }

        .btn-primary {
            background-color: purple !important;
            border-color: purple !important;
        }
    </style>
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
                        <br>
                        <form action="{{ route('sanphams.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Tìm kiếm theo tên hoặc mã sản phẩm" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </form>

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
                                    <th>Trạng thái</th>
                                    <th>Biến thể</th>
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
                                                <img src="{{ Storage::url($sanpham->hinh_anh) }}"
                                                    class="img-thumbnail" alt="Hình ảnh" width="100px">
                                            </div>

                                        </td>
                                        {{-- <td class="">{{ $sanpham->ngay_nhap->format('d/m/Y') }}</td> --}}

                                        <td>
                                            @if ($sanpham->trang_thai == 1)
                                                <span class="badge bg-success-subtle text-success fs-6">Còn hàng</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger fs-6">Hết hàng</span>
                                            @endif
                                        </td>

                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#variant_{{ $sanpham->id }}">
                                                Xem biến thể
                                            </button>

                                            <!-- Modal hiển thị biến thể sản phẩm -->
                                            <div id="variant_{{ $sanpham->id }}" class="modal fade fadeInLeft" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 800px !important;">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-5">
                                                            <div class="mt-4">
                                                                <h4 class="mb-3">Thông tin biến thể của sản phẩm</h4>
                                                                <h5 class="mb-3">'{{ $sanpham->ten_san_pham }}'</h5>
                                                                <div class="hstack gap-2 justify-content-center">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <td>#</td>
                                                                                <td>Tên biến thể</td>
                                                                                <td>Hình ảnh</td>
                                                                                <td>Giá nhập</td>
                                                                                <td>Giá bán</td>
                                                                                <td>Số lượng</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            @if($sanpham->bienThes->isNotEmpty())
                                                                            @php
                                                                                // dd($sanpham->bienThes);
                                                                            @endphp
                                                                                @foreach($sanpham->bienThes as $key => $bienThe)
                                                                                    <tr>
                                                                                        <td>{{ $key + 1 }}</td>
                                                                                        <td>{{ $bienThe->ten_bien_the }}</td>
                                                                                        <td>
                                                                                            @if ($bienThe->anh_bien_the)
                                                                                            <img src="{{ Storage::url($bienThe->anh_bien_the) }}" class="img-thumbnail" width="80px">

                                                                                            @else
                                                                                                Không có ảnh
                                                                                            @endif
                                                                                        </td>

                                                                                        <td>{{ number_format($bienThe->gia_nhap, 0, ',', '.') }} VNĐ</td>
                                                                                        <td>{{ number_format($bienThe->gia_ban, 0, ',', '.') }} VNĐ</td>
                                                                                        <td>{{ $bienThe->so_luong }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @else
                                                                                <tr>
                                                                                    <td colspan="5" class="text-center">Không có biến thể nào</td>
                                                                                </tr>
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>


                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('sanphams.show', $sanpham->id) }}">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('sanphams.edit', $sanpham->id) }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $sanpham->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>

                                                    <div class="modal fade" id="deleteModal{{ $sanpham->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">Bạn muốn xóa sản phẩm
                                                                    {{ $sanpham->ten_san_pham }} đúng không ?</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Hủy</button>
                                                                    <form
                                                                        action="{{ route('sanphams.destroy', $sanpham->id) }}"
                                                                        method="POST">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Xóa</button>
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
            {{ $sanPhams->links('pagination::bootstrap-5') }}

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
