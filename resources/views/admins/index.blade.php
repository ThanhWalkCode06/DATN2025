@extends('layouts.admin')

@section('title')
    Seven Stars
@endsection

@section('css')
    <!-- Themify icon css-->
@endsection

@section('content')
    <!-- chart caard section start -->
    <form method="GET" action="{{ route('index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" 
                    value="{{ request('start_date') ?? now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" 
                    value="{{ request('end_date') ?? now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>
    
  
    
    
    
    
    
    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Tổng doanh thu</span>
                        <h4 class="mb-0 counter">
                            {{ number_format($tongDoanhThu, 0, ',', '.') }}
                            <span class="badge badge-light-primary grow">
                                <i data-feather="dollar-sign"></i>
                            </span>
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
    <div class="col-xl-12">
        <div class="card o-hidden card-hover">
            <div class="card-header-title">
                <h4>Doanh thu hàng tháng</h4>
            </div>
            <div class="card-body p-0">
                <div id="report-chart"></div>
            </div>

        </div>
    </div>
    <!-- Earning chart  end-->


    <!-- Best Selling Product Start -->

    <div class="col-xl-12">
        <div class="card o-hidden card-hover">
            <div class=" card-header-top card-header--2 px-0 pt-0">
                <div class="row">
                





                    <!-- Top 5 Sản phẩm bán chạy -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 Sản phẩm bán chạy</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="best-selling-table w-image table border-0">
                                        <tbody>
                                            @if ($topBanChay)
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        <span class="text-danger">Không có sản phẩm trong thời gian
                                                            này.</span>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($topBanChay as $sp)
                                                    <tr>
                                                        <td>
                                                            <div class="best-product-box">
                                                                <div class="product-image">
                                                                    <img src="{{ asset($sp->hinh_anh ? 'storage/' . $sp->hinh_anh : 'assets/images/product/default.png') }}"
                                                                        class="img-fluid" alt="{{ $sp->ten_san_pham }}">
                                                                </div>
                                                                <div class="product-name">
                                                                    <h5>{{ $sp->ten_san_pham }}</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>Lượt mua</h6>
                                                                <h5>{{ $sp->tong_da_ban }}</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top 5 Sản phẩm doanh thu cao nhất -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 Sản phẩm doanh thu cao</h4>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="best-selling-table w-image table border-0">
                                        <tbody>
                                            @if ($topDoanhThu->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        <span class="text-danger">Không có sản phẩm trong thời gian
                                                            này.</span>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($topDoanhThu as $sp)
                                                    <tr>
                                                        <td>
                                                            <div class="best-product-box">
                                                                <div class="product-image">
                                                                    <img src="{{ asset($sp->hinh_anh ? 'storage/' . $sp->hinh_anh : 'assets/images/product/default.png') }}"
                                                                        class="img-fluid" alt="{{ $sp->ten_san_pham }}">
                                                                </div>
                                                                <div class="product-name">
                                                                    <h5>{{ $sp->ten_san_pham }}</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>Doanh thu</h6>
                                                                <h5>{{ number_format($sp->tong_doanh_thu, 0, ',', '.') }}
                                                                    VNĐ</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top 5 Sản phẩm lợi nhuận cao nhất -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 Sản phẩm lợi nhuận cao</h4>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="best-selling-table w-image table border-0">
                                        <tbody>
                                            @if ($topLoiNhuan->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        <span class="text-danger">Không có sản phẩm trong thời gian
                                                            này.</span>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($topLoiNhuan as $sp)
                                                    <tr>
                                                        <td>
                                                            <div class="best-product-box">
                                                                <div class="product-image">
                                                                    <img src="{{ asset($sp->hinh_anh ? 'storage/' . $sp->hinh_anh : 'assets/images/product/default.png') }}"
                                                                        class="img-fluid" alt="{{ $sp->ten_san_pham }}">
                                                                </div>
                                                                <div class="product-name">
                                                                    <h5>{{ $sp->ten_san_pham }}</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>Lợi nhuận</h6>
                                                                <h5>{{ number_format($sp->tong_loi_nhuan, 0, ',', '.') }}
                                                                    VNĐ</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                    <h4>Đơn hàng</h4>
                </div>

                <div class="best-selling-box d-sm-flex d-none">
                    <span>Lọc theo:</span>
                    <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" data-bs-auto-close="true">Trạng thái</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item"
                                    href="{{ route('index', ['trang_thai' => 'chua_xac_nhan']) }}">Chưa xác nhận</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'dang_xu_ly']) }}">Đang
                                    xử lý</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'dang_giao']) }}">Đang
                                    giao</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'da_giao']) }}">Đã
                                    giao</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'hoan_thanh']) }}">Hoàn
                                    thành</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'da_huy']) }}">Đã
                                    hủy</a></li>
                            <li><a class="dropdown-item" href="{{ route('index', ['trang_thai' => 'tra_hang']) }}">Trả
                                    hàng</a></li>
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
                                    <th class="d-flex justify-content-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($donHangs->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted ">
                                            <span class="text-danger">Không có đơn hàng nào.</span>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($donHangs as $donHang)
                                        <tr>
                                            <td>{{ $donHang->ma_don_hang }}</td>
                                            <td>{{ $donHang->ten_nguoi_nhan }}</td>
                                            <td>{{ number_format($donHang->tong_tien, 0, ',', '.') }} VNĐ</td>
                                            <td>
                                                @if ($donHang->trang_thai_don_hang == -1)
                                                    <span class="text-danger">Đã hủy</span>
                                                @elseif ($donHang->trang_thai_don_hang == 0)
                                                    <span class="text-danger">Chờ xác nhận</span>
                                                @elseif ($donHang->trang_thai_don_hang == 1)
                                                    <span class="text-primary">Đang xử lý</span>
                                                @elseif ($donHang->trang_thai_don_hang == 2)
                                                    <span class="text-primary">Đang giao</span>
                                                @elseif ($donHang->trang_thai_don_hang == 3)
                                                    <span class="text-success">Đã giao</span>
                                                @elseif ($donHang->trang_thai_don_hang == 4)
                                                    <span class="text-success">Hoàn thành</span>
                                                @elseif ($donHang->trang_thai_don_hang == 5)
                                                    <span class="text-danger">Trả hàng</span>
                                                @else
                                                    <span>Trạng thái không hợp lệ</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d/m/Y H:i', strtotime($donHang->created_at)) }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('donhangs.show', $donHang->id) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $donHangs->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Sidebar jquery -->
    <script>
        var dataChart = {!! json_encode(array_values($dataChart)) !!};
    </script>

    <!-- Load file JS sau khi có dữ liệu -->
    <script src="{{ asset('assets/js/chart/apex-chart/chart-custom1.js') }}"></script>

    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

      <script>
        // Function to update the start date input with current date
        function updateStartDate() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            const currentDate = `${year}-${month}-${day}`;
            
            document.getElementById('start_date').value = currentDate;
        }
    
        // Update start date every second to reflect real-time changes
        setInterval(updateStartDate, 1000); // Update every 1000ms (1 second)
    </script>
@endsection
