@extends('layouts.admin')

@section('title')
    Đánh giá
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css -->
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
            <!-- Table Start -->
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Đánh giá sản phẩm</h5>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="user-table ticket-table review-table theme-table table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đánh giá</th>
                                    <th>Nhận xét</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhGias as $danhGia)
                                    <tr>
                                        <td>{{ $danhGia->ten_nguoi_dung }}</td>
                                        <td>{{ $danhGia->ten_san_pham }}</td>
                                        <td>
                                            <ul class="rating">
                                                @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </td>
                                        <td class="text-wrap">{{ $danhGia->nhan_xet }}</td>

                                        @if ($danhGia->trang_thai == 1)
                                            <td class="td-check">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </td>
                                        @else
                                            <td class="td-cross">
                                                <i class="ri-close-circle-line"></i>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table End -->
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
