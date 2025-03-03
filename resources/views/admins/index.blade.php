@extends('layouts.admin')

@section('title')
    Seven Stars
@endsection

@section('css')
    <!-- Themify icon css-->

@endsection

@section('content')
    <!-- chart caard section start -->
    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Tổng doanh thu</span>
                        <h4 class="mb-0 counter">$6659
                            <span class="badge badge-light-primary grow">
                                <i data-feather="trending-up"></i>8.5%</span>
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-database-2-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-2-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Số lượng đơn hàng</span>
                        <h4 class="mb-0 counter">
                            {{ $tongDonHang }}
                            <span class="badge badge-light-danger grow">
                                <i data-feather="trending-down"></i>8.5%
                            </span>
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0  card o-hidden">
            <div class="custome-3-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Số lượng sản phẩm</span>
                        <h4 class="mb-0 counter">
                            {{ $tongSanPhamConHang }}
                            <a href="" class="badge badge-light-secondary grow">
                                ADD NEW
                            </a>
                        </h4>
                    </div>

                    <div class="align-self-center text-center">
                        <i class="ri-chat-3-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-4-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Tổng số lượng khách hàng</span>
                        <h4 class="mb-0 counter">
                            {{ $tongKhachHangHoatDong }}
                            <span class="badge badge-light-success grow">
                                <i data-feather="trending-down"></i>8.5%
                            </span>
                        </h4>
                    </div>
                    

                    <div class="align-self-center text-center">
                        <i class="ri-user-add-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Earning chart star-->
    <div class="col-xl-6">
        <div class="card o-hidden card-hover">
            <div class="card-header border-0 pb-1">
                <div class="card-header-title">
                    <h4>Doanh thu hàng tháng</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="report-chart"></div>
            </div>
        </div>
    </div>
    <!-- Earning chart  end-->


    <!-- Best Selling Product Start -->
    <div class="col-xl-6 col-md-12">
        <div class="card o-hidden card-hover">
            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                <div class="card-header-title">
                    <h4>Sản phẩm bán chạy</h4>
                </div>

                <div class="best-selling-box d-sm-flex d-none">
                    <span>Sắp xếp:</span>
                    <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" data-bs-auto-close="true">Giá</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Giá</a></li>
                            <li><a class="dropdown-item" href="#">Lượt mua</a></li>
                            <li><a class="dropdown-item" href="#">Tổng</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div>
                    <div class="table-responsive">
                        <table
                            class="best-selling-table w-image
                    w-image
                    w-image table border-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="best-product-box">
                                            <div class="product-image">
                                                <img src="assets/images/product/1.png" class="img-fluid" alt="Product">
                                            </div>
                                            <div class="product-name">
                                                <h5>Aata Buscuit</h5>
                                                {{-- <h6>26-08-2022</h6> --}}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6>Giá</h6>
                                            <h5>$29.00</h5>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6>Lượt mua</h6>
                                            <h5>62</h5>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="product-detail-box">
                                            <h6>Tổng</h6>
                                            <h5>$1,798</h5>
                                        </div>
                                    </td>
                                </tr>

                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Selling Product End -->


    <!-- Recent orders start-->
    <div class="col-xl-12">
        <div class="card o-hidden card-hover">
            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                <div class="card-header-title">
                    <h4>Đơn hàng gần đây</h4>
                </div>

                <div class="best-selling-box d-sm-flex d-none">
                    <span>Sắp xếp:</span>
                    <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" data-bs-auto-close="true">Ngày đặt</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="#">Ngày đặt</a></li>
                            <li><a class="dropdown-item" href="#">Tổng tiền</a></li>
                            <li><a class="dropdown-item" href="#">Trạng thái đơn hàng</a></li>
                            <li><a class="dropdown-item" href="#">Trạng thái thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donHangs as $donHang)
                                <tr>
                                    <td>{{ $donHang->ma_don_hang }}</td>
                                    <td>{{ $donHang->ten_nguoi_nhan }}</td>
                                    <td>{{ number_format($donHang->tong_tien, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @if ($donHang->trang_thai_don_hang == 0)
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
                                    </td>
                                    <td>{{ date('d/m/Y H:i', strtotime($donHang->created_at)) }}</td>
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
    <!-- Sidebar jquery -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endsection
