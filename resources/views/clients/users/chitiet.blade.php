@extends('layouts.client')

@section('title')
    Tài khoản
@endsection

@section('css')
    <style>
        .user-dashboard-section .dashboard-right-sidebar .dashboard-bg-box+.dashboard-bg-box {
            margin-top: 0px;
        }
    </style>
@endsection

@section('breadcrumb')
@endsection

@section('content')
    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="{{ Storage::url($user->anh_dai_dien ?? 'images/logo.jpg') }}"
                                            class="blur-up lazyload update_img" alt="">
                                        {{-- <div class="cover-icon">
                                            <i class="fa-solid fa-pen">
                                                <input type="file" onchange="readURL(this,0)">
                                            </i>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{ Auth::user()->username }}</h3>
                                    <h6 class="text-content">{{ Auth::user()->email }}</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                                    Bảng Điều Khiển</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button"><i data-feather="shopping-bag"></i> Đơn
                                    Hàng</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"><i
                                        data-feather="user"></i>
                                    Hồ Sơ</button>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div style="padding-left: 0px;" class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>Bảng Điều Khiển Của Tôi</h2>
                                        <span class="title-leaf">
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Xin chào, <b
                                                class="text-title">{{ $user->username ?? '' }}</b></h6>
                                        <p class="text-content">Từ bảng điều khiển tài khoản của tôi, bạn có thể xem nhanh
                                            hoạt động gần đây của tài khoản và cập nhật thông tin của mình. Chọn một liên
                                            kết bên dưới để xem hoặc chỉnh sửa thông tin.</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Đơn Hàng</h5>
                                                        <h3>{{ $user->donHangs->count() }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Đơn Hàng </h5>
                                                        <h5>Chờ Xử Lý</h5>
                                                        <h3>{{ $i ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Tổng Danh Sách </h5>
                                                        <h5>Yêu Thích</h5>
                                                        <h3>{{ $user->sanPhamYeuThichs->count() ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-order" role="tabpanel">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Lịch Sử Đơn Hàng Của Tôi</h2>
                                        <span class="title-leaf title-leaf-gray">
                                        </span>
                                    </div>


                                    <div style="width: 115%;" class="order-contain">
                                        @php
                                            $orderStatus = [
                                                -1 => 'Đã hủy',
                                                0 => 'Chờ xác nhận',
                                                1 => 'Đang xử lý',
                                                2 => 'Đang giao',
                                                3 => 'Đã giao',
                                                4 => 'Hoàn thành',
                                                5 => 'Trả hàng',
                                            ];
                                        @endphp
                                        @if ($donHangsPaginate->isNotEmpty())
                                        <div class="row mt-4">
                                        @foreach($donHangsPaginate->chunk(ceil(count($donHangsPaginate) / 2)) as $chunk)
                                        <div class="col-md-6">
                                            @foreach ($chunk as $item)
                                                <div class="order-box dashboard-bg-box">
                                                    <a href="{{ route('order-tracking.client', $item->id) }}">
                                                        <div class="order-container">
                                                            <div class="order-icon">
                                                                <i data-feather="box"></i>
                                                            </div>

                                                            <div style="max-width: 450px" class="order-detail">
                                                                {{-- {{ dd($item->trang_thai) }} --}}
                                                                <div style="position: relative; display:flex; justify-content: space-between">
                                                                    <h4>Đơn Hàng <span
                                                                            class="{{ in_array($item->trang_thai_don_hang, [-1, 0]) ? '' : 'success-bg' }}">{{ $orderStatus[$item->trang_thai_don_hang] }}</span>

                                                                    </h4>
                                                                    <span
                                                                            style="border:none; background: none; color:#4a5568; margin-left: 35px">Ngày
                                                                            đặt: {{ $item->created_at }}</span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="text-content mt-2">Mã đơn hàng:
                                                                        {{ $item->ma_don_hang }}
                                                                </div>
                                                                <div style="position: relative;display: flex; justify-content: space-between">
                                                                    <h6 class="text-content mt-2">Trạng thái thanh toán:
                                                                        @if ($item->trang_thai_thanh_toan == 0)
                                                                            <span
                                                                                style="float: right; padding-top: 0px; padding-bottom: 0px; padding-left: 5px; padding-right: 0px; left: 0 "
                                                                                class="btn bg-danger-subtle text-danger">
                                                                                Chưa thanh toán
                                                                            </span>
                                                                        @elseif ($item->trang_thai_thanh_toan == 1)
                                                                            <span
                                                                                style="float: right; padding-top: 0px; padding-bottom: 0px; padding-left: 5px; padding-right: 0px "
                                                                                class="btn bg-danger-subtle text-success">
                                                                                Đã thanh toán
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                style="float: right; padding-top: 0px; padding-bottom: 0px; padding-left: 5px; padding-right: 0px "
                                                                                class="btn bg-danger-subtle text-success">
                                                                                Đã hoàn tiền
                                                                            </span>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                                <h6 class="text-content mt-2">Địa chỉ nhận:
                                                                    {{ $item->dia_chi_nguoi_nhan }}
                                                                </h6>
                                                                <h6 class="text-content mt-2">Tổng tiền: <strong
                                                                        style="font-weight: bold" class="text-success">
                                                                        {{ number_format($item->tong_tien, 0, '.', '.') }}
                                                                        đ</strong>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                        </div>

                                        @else
                                            <center>
                                                <h2 style="color: #ccc">Bạn không có đơn hàng nào</h2>
                                                <img style="width: 200px;color: #ccc"
                                                    src="{{ asset('assets/images/inner-page/not-found.png') }}"
                                                    alt="">
                                            </center>
                                        @endif

                                    </div>

                                </div>
                                {{ $donHangsPaginate->links('pagination::bootstrap-5') }}
                            </div>

                            <div class="tab-pane fade" id="pills-address" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Sổ Địa Chỉ Của Tôi</h2>
                                            <span class="title-leaf">
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address">
                                            <i data-feather="plus" class="me-2"></i> Thêm Địa Chỉ Mới
                                        </button>
                                    </div>


                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault2" checked>
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Jack Jennas</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>8424 James Lane, South San Francisco, CA 94080
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+380</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 812-710-3798</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault3">
                                                    </div>

                                                    <div class="label">
                                                        <label>Văn phòng</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Terry S. Sutton</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2280 Rose Avenue Kenner, LA 70062</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+25</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 504-228-0969</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault4">
                                                    </div>

                                                    <div class="label">
                                                        <label>Hàng xóm</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Juan M. McKeon</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>1703 Carson Street Lexington, KY 40593</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+78</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 859-257-0509</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault5">
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà 2</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Gary M. Bailey</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2135 Burning Memory Lane Philadelphia, PA
                                                                            19135</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+26</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 215-335-9916</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jack"
                                                            id="flexRadioDefault1">
                                                    </div>

                                                    <div class="label">
                                                        <label>Nhà 2</label>
                                                    </div>

                                                    <div class="table-responsive address-table">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2">Gary M. Bailey</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Địa chỉ :</td>
                                                                    <td>
                                                                        <p>2135 Burning Memory Lane Philadelphia, PA
                                                                            19135</p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mã bưu điện :</td>
                                                                    <td>+26</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Điện thoại :</td>
                                                                    <td>+ 215-335-9916</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="button-group">
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile"><i data-feather="edit"></i>
                                                        Chỉnh sửa</button>
                                                    <button class="btn btn-sm add-button w-100" data-bs-toggle="modal"
                                                        data-bs-target="#removeProfile"><i data-feather="trash-2"></i>
                                                        Xóa</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>Hồ Sơ Của Tôi</h2>
                                        <span class="title-leaf">
                                        </span>
                                    </div>


                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="dashboard-title">
                                            <h3>Tên Hồ Sơ</h3>
                                        </div>
                                        <div class="profile-name-detail">
                                            <div class="d-sm-flex align-items-center d-block">
                                                <h3>Họ và tên: {{ $user->ten_nguoi_dung ?? '' }}</h3>
                                            </div>
                                        </div>

                                        <div class="location-profile">
                                            <ul>
                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="map-pin"></i>
                                                        <h6>{{ Auth::user()->dia_chi ?? 'Trống' }}</h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="mail"></i>
                                                        <h6>{{ Auth::user()->email ?? 'Trống' }}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="profile-description">
                                            <p>Các thông tin cơ bản ở dưới bạn có thể thay đổi hay chỉnh sửa theo nhu cầu.
                                            </p>
                                        </div>
                                    </div>


                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="col-xxl-7">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Giới thiệu Hồ Sơ</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Giới tính:</td>
                                                                <td>{{ Auth::user()->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ngày sinh:</td>
                                                                <td>{{ Auth::user()->ngay_sinh ?? 'Trống' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số điện thoại:</td>
                                                                <td>
                                                                    <a
                                                                        href="javascript:void(0)">+{{ Auth::user()->so_dien_thoai ?? 'Trống' }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Địa chỉ:</td>
                                                                <td>{{ Auth::user()->dia_chi ?? 'Trống' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <span style="margin: 0px" data-bs-toggle="modal"
                                                                            data-bs-target="#editProfile">Chỉnh sửa</span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="dashboard-title mb-3">
                                                    <h3>Thông Tin Đăng Nhập</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Password:</td>
                                                                <td>
                                                                    <a href="{{ route('pass.edit.client') }}">*******
                                                                        <span data-bs-toggle="modal">Chỉnh sửa</span></a>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-xxl-5">
                                                <div class="profile-image">
                                                    <img src="../assets/images/inner-page/dashboard-profile.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-security" role="tabpanel">
                                <div class="dashboard-privacy">
                                    <div class="dashboard-bg-box">
                                        <div class="dashboard-title mb-4">
                                            <h3>Quyền riêng tư</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Cho phép người khác xem hồ sơ của tôi</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio">
                                                    <label class="form-check-label" for="redio"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Tất cả mọi người sẽ có thể xem hồ sơ của tôi</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Chỉ những người đã lưu hồ sơ này mới có thể xem hồ sơ của tôi</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio2">
                                                    <label class="form-check-label" for="redio2"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Tất cả mọi người sẽ không thể xem hồ sơ của tôi</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Lưu thay
                                            đổi</button>
                                    </div>

                                    <div class="dashboard-bg-box mt-4">
                                        <div class="dashboard-title mb-4">
                                            <h3>Cài đặt tài khoản</h3>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Xóa tài khoản của bạn sẽ vĩnh viễn</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio3">
                                                    <label class="form-check-label" for="redio3"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Sau khi tài khoản của bạn bị xóa, bạn sẽ bị đăng xuất
                                                và không thể đăng nhập lại.</p>
                                        </div>

                                        <div class="privacy-box">
                                            <div class="d-flex align-items-start">
                                                <h6>Xóa tài khoản của bạn sẽ tạm thời</h6>
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="redio4">
                                                    <label class="form-check-label" for="redio4"></label>
                                                </div>
                                            </div>
                                            <p class="text-content">Sau khi tài khoản của bạn bị xóa, bạn sẽ bị đăng xuất
                                                và có thể tạo tài khoản mới.</p>
                                        </div>

                                        <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">Xóa tài khoản của
                                            tôi</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let activeTab = localStorage.getItem("activeTab");

        if (activeTab) {
            let tab = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (tab) {
                new bootstrap.Tab(tab).show();
            }
        }

        document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener("click", function() {
                localStorage.setItem("activeTab", this.getAttribute("data-bs-target"));
            });
        });
    });
</script>
