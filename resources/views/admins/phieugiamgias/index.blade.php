@extends('layouts.admin')

@section('title')
    Phiếu giảm giá
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

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
                    <h5>Danh sách phiếu giảm giá</h5>
                    <div class="right-options">

                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table all-package coupon-list-table table-hover theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên phiếu</th>
                                    <th>Mã</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Giá trị</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($phieuGiamGias as $phieuGiamGia)
                                    <tr>
                                        <td>{{ $phieuGiamGia->ten_phieu }}</td>
                                        <td>{{ $phieuGiamGia->ma_phieu }}</td>
                                        <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_bat_dau)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_ket_thuc)) }}</td>
                                        <td class="theme-color">{{ $phieuGiamGia->gia_tri }}%</td>
                                        <td class="menu-status">
                                            <span class="success">Success</span>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('phieugiamgias.edit', $phieuGiamGia->id) }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $phieuGiamGia->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Modal xác nhận xóa -->
                                            <div class="modal fade" id="deleteModal{{ $phieuGiamGia->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Xác nhận xóa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa phiếu giảm giá
                                                            <strong>{{ $phieuGiamGia->ten_phieu }}</strong> không?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form
                                                                action="{{ route('phieugiamgias.destroy', $phieuGiamGia->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Hủy</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- Pagination End -->
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

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection