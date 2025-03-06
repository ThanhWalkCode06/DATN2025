@extends('layouts.admin')

@section('title')
    Trạng thái đơn hàng
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzone css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Trạng thái đơn hàng</h5>
                        </div>
                        <div class="row">
                            <div class="col-12 overflow-hidden">
                                <div class="order-left-image">
                                    <div class="order-image-contain">
                                        <div class="tracker-number">
                                            <p>Mã đơn hàng : <span>{{ $donHang->ma_don_hang }}</span></p>
                                            <p>Người đặt : <span>{{ $donHang->ten_nguoi_dung }}</span></p>
                                            <p>Ngày đặt : <span>{{ $donHang->created_at }}</span></p>
                                            <p>Phương thức thanh toán : <span>{{ $donHang->ten_phuong_thuc }}</span></p>
                                            <p>
                                                Trạng thái đơn hàng :
                                                @if ($donHang->trang_thai_don_hang == -1)
                                                    <span class="text-danger">Đã hủy</span>
                                                @elseif ($donHang->trang_thai_don_hang == 0)
                                                    <span class="text-danger">Chưa xác nhận</span>
                                                @elseif ($donHang->trang_thai_don_hang == 1)
                                                    <span class="text-success">Đã xác nhận</span>
                                                @elseif ($donHang->trang_thai_don_hang == 2)
                                                    <span class="text-primary">Chờ vận chuyển</span>
                                                @elseif ($donHang->trang_thai_don_hang == 3)
                                                    <span class="text-primary">Đang giao</span>
                                                @elseif ($donHang->trang_thai_don_hang == 4)
                                                    <span class="text-success">Đã giao</span>
                                                @elseif ($donHang->trang_thai_don_hang == 5)
                                                    <span class="text-danger">Trả hàng</span>
                                                @else
                                                    <span>Trạng thái không hợp lệ</span>
                                                @endif
                                            </p>
                                            <p>
                                                Trạng thái thanh toán :
                                                @if ($donHang->trang_thai_thanh_toan == 0)
                                                    <span class="text-danger">Chưa thanh toán</span>
                                                @else
                                                    <span class="text-success">Đã thanh toán</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ol class="progtrckr">
                                @if ($donHang->trang_thai_don_hang >= 1)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Xác nhận</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 2)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Chờ vận chuyển</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 3)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Đang giao</h5>
                                </li>

                                @if ($donHang->trang_thai_don_hang >= 4)
                                    <li class="progtrckr-done">
                                    @else
                                    <li class="progtrckr-todo">
                                @endif
                                <h5>Đã giao</h5>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <form action="{{ route('donhangs.update', $donHang->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                            @if ($donHang->trang_thai_don_hang != -1 && $donHang->trang_thai_don_hang != 5)
                                <select class="form-control me-3" name="trang_thai">
                                    <option @if ($donHang->trang_thai_don_hang == 0) selected @endif
                                        @if ($donHang->trang_thai_don_hang > 0) disabled @endif value="0">Chưa xác nhận
                                    </option>
                                    <option @if ($donHang->trang_thai_don_hang == 1) selected @endif
                                        @if ($donHang->trang_thai_don_hang > 1) disabled @endif value="1">Xác nhận</option>
                                    <option @if ($donHang->trang_thai_don_hang == 2) selected @endif
                                        @if ($donHang->trang_thai_don_hang > 2) disabled @endif value="2">Chờ vận chuyển
                                    </option>
                                    <option @if ($donHang->trang_thai_don_hang == 3) selected @endif
                                        @if ($donHang->trang_thai_don_hang > 3) disabled @endif value="3">Đang giao</option>
                                    <option @if ($donHang->trang_thai_don_hang == 4) selected @endif
                                        @if ($donHang->trang_thai_don_hang > 4) disabled @endif value="4">Đã giao</option>
                                    <option @if ($donHang->trang_thai_don_hang == 5) selected @endif
                                        @if ($donHang->trang_thai_don_hang != 4) disabled @endif value="5">Trả hàng</option>
                                </select>
                                <input class="btn btn-primary me-3" type="submit" name="doi_trang_thai"
                                    value="Đổi trạng thái">
                                @if ($donHang->trang_thai_thanh_toan == 0)
                                    <input class="btn btn-primary me-3" type="submit" name="xac_nhan_thanh_toan"
                                        value="Xác nhận thanh toán">
                                @endif
                                <input class="btn btn-danger me-3" type="submit" name="huy_don_hang" value="Hủy đơn hàng">
                            @endif
                            <a href="{{ route('donhangs.index') }}" class="btn btn-outline">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar menu js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
@endsection
