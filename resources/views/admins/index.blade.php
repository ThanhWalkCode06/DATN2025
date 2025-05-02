@extends('layouts.admin')

@section('title')
    Seven Stars
@endsection

@section('css')
    <!-- Themify icon css-->
@endsection

@section('content')
    <!-- chart caard section start -->
    <form method="GET" action="{{ route('index') }}" class="mb-4" style="margin-left: 20px;">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                    value="{{ request('start_date', now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" class="form-control"
                    value="{{ request('end_date', now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>







    <!-- Hiển thị các thống kê -->
    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 border-0 card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Tổng doanh thu</span>
                        <h4 class="mb-0 counter">
                            {{ number_format($tongDoanhThu, 0, ',', '.') }} ₫
                            <span class="badge badge-light-primary grow">
                                <i class="fas fa-money-bill-wave"></i>
                                {{-- @if ($phanTramTangGiamDoanhThu > 0)
                                    <span class="text-success">+{{ number_format($phanTramTangGiamDoanhThu) }}%</span>
                                @elseif ($phanTramTangGiamDoanhThu < 0)
                                    <span class="text-danger">{{ number_format($phanTramTangGiamDoanhThu) }}%</span>
                                @else
                                    <span class="text-muted">0%</span>
                                @endif --}}
                            </span>
                        </h4>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Các phần thống kê khác -->
    <div class="col-sm-6 col-xxl-3 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-2-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Số lượng đơn hàng</span>
                        <h4 class="mb-0 counter">
                            {{ $tongDonHang }}
                            {{-- <span
                                class="badge {{ $phanTramThayDoiDonHang >= 0 ? 'badge-light-success' : 'badge-light-danger' }} grow">
                                <i data-feather="{{ $phanTramThayDoiDonHang >= 0 ? 'trending-up' : 'trending-down' }}"></i>
                                {{ number_format($phanTramThayDoiDonHang) }}%
                            </span> --}}
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
                            <a href="{{ route('sanphams.create') }}" class="badge badge-light-secondary grow">
                                ADD NEW
                            </a>
                        </h4>
                    </div>

                    <div class="align-self-center text-center">
                        <i class="ri-t-shirt-line"></i>
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
                            {{-- <span
                                class="badge {{ $phanTramThayDoiKhachHang >= 0 ? 'badge-light-success' : 'badge-light-danger' }} grow">
                                <i
                                    data-feather="{{ $phanTramThayDoiKhachHang >= 0 ? 'trending-up' : 'trending-down' }}"></i>
                                {{ number_format($phanTramThayDoiKhachHang) }}%
                            </span> --}}
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
                <h4>Doanh thu </h4>
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
            <div class="card-header-top card-header--2 px-0 pt-0">
                <div class="row">

                    <!-- Top 5 Sản phẩm bán chạy -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover h-100 d-flex flex-column">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 Sản phẩm bán chạy</h4>
                                </div>
                            </div>
                            <div class="card-body p-0 flex-grow-1">
                                <div class="table-responsive h-100">
                                    <table class="best-selling-table w-image table border-0 mb-0">
                                        <tbody>
                                            @if ($topBanChay->isEmpty())
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

                    <!-- Top 5 Sản phẩm doanh thu cao -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover h-100 d-flex flex-column">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 Sản phẩm doanh thu cao</h4>
                                </div>
                            </div>
                            <div class="card-body p-0 flex-grow-1">
                                <div class="table-responsive h-100">
                                    <table class="best-selling-table w-image table border-0 mb-0">
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
                                                                <h5>{{ number_format($sp->tong_doanh_thu, 0, ',', '.') }} ₫
                                                                </h5>
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

                    <!-- Top 5 Khách hàng thân thiết -->
                    <div class="col-xl-4 col-md-12">
                        <div class="card o-hidden card-hover h-100 d-flex flex-column">
                            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                                <div class="card-header-title text-center w-100">
                                    <h4>Top 5 khách hàng thân thiết</h4>
                                </div>
                            </div>
                            <div class="card-body p-0 flex-grow-1">
                                <div class="table-responsive h-100">
                                    <table class="best-selling-table w-image table border-0 mb-0">
                                        <tbody>
                                            @if ($topKhachHang->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        <span class="text-danger">Không có khách hàng trong thời gian
                                                            này.</span>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($topKhachHang as $khachHang)
                                                    <tr>
                                                        <td>
                                                            <div class="best-product-box">
                                                                <div class="product-image">
                                                                    <img src="{{ asset($khachHang->anh_dai_dien ? 'storage/' . $khachHang->anh_dai_dien : 'assets/images/user-default.png') }}"
                                                                        class="img-fluid"
                                                                        alt="{{ $khachHang->ten_nguoi_dung }}">
                                                                </div>
                                                                <div class="product-name">
                                                                    <h5>{{ $khachHang->ten_nguoi_dung }}</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-detail-box">
                                                                <h6>Số lượng đơn hàng</h6>
                                                                <h5>{{ $khachHang->so_luong_don_hang }}</h5>
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

                </div> <!-- /.row -->
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
                    <span>Sắp xếp theo:</span>
                    <div class="dropdown">
                        <button class="btn p-0 dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" data-bs-auto-close="true">
                            Trạng thái
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="#" data-trang-thai="chua_xac_nhan">Chưa xác nhận</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="dang_xu_ly">Đang xử lý</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="dang_giao">Đang giao</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="da_giao">Đã giao</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="hoan_thanh">Hoàn thành</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="da_huy">Đã hủy</a></li>
                            <li><a class="dropdown-item" href="#" data-trang-thai="tra_hang">Trả hàng</a></li>
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
                                @forelse ($donHangs as $donHang)
                                    <tr>
                                        <td>{{ $donHang->ma_don_hang }}</td>
                                        <td>{{ $donHang->ten_nguoi_nhan }}</td>
                                        <td>{{ number_format($donHang->tong_tien, 0, ',', '.') }} ₫</td>
                                        <td>
                                            @switch($donHang->trang_thai_don_hang)
                                                @case(-1)
                                                    <span class="text-danger">Đã hủy</span>
                                                @break
                                                @case(0)
                                                    <span class="text-danger">Chờ xác nhận</span>
                                                @break
                                                @case(1)
                                                    <span class="text-primary">Đang xử lý</span>
                                                @break
                                                @case(2)
                                                    <span class="text-primary">Đang giao</span>
                                                @break
                                                @case(3)
                                                    <span class="text-success">Đã giao</span>
                                                @break
                                                @case(4)
                                                    <span class="text-success">Hoàn thành</span>
                                                @break
                                                @case(5)
                                                    <span class="text-danger">Trả hàng</span>
                                                @break
                                                @default
                                                    <span>Trạng thái không hợp lệ</span>
                                            @endswitch
                                        </td>
                                        <td>{{ date('d/m/Y H:i', strtotime($donHang->created_at)) }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('donhangs.show', $donHang->id) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <span class="text-danger">Không có đơn hàng nào.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $donHangs->appends(request()->all())->links('pagination::bootstrap-5') }}
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
            var categoriesChart = {!! json_encode(array_values($categoriesChart)) !!};

        </script>

        <!-- Load file JS sau khi có dữ liệu -->
        <script src="{{ asset('assets/js/chart/apex-chart/chart-custom1.js') }}"></script>

        <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            window.onload = function() {
                const today = new Date();
                const day = String(today.getDate()).padStart(2, '0');
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const year = today.getFullYear();
                const currentDate = `${year}-${month}-${day}`;

                // Đặt ngày bắt đầu mặc định là hôm nay khi trang được tải nếu người dùng chưa chọn
                if (!document.getElementById('start_date').value) {
                    document.getElementById('start_date').value = currentDate;
                }
                if (!document.getElementById('end_date').value) {
                    document.getElementById('end_date').value = currentDate;
                }

                // Thiết lập thuộc tính "max" cho cả hai ô nhập ngày để ngăn người dùng chọn ngày trong tương lai
                document.getElementById('start_date').setAttribute('max', currentDate);
                document.getElementById('end_date').setAttribute('max', currentDate);

                const startDate = document.getElementById('start_date');
                const endDate = document.getElementById('end_date');

                // Đảm bảo ngày bắt đầu không lớn hơn ngày kết thúc
                startDate.addEventListener('change', function() {
                    if (startDate.value > endDate.value) {
                        endDate.value = startDate.value; // Điều chỉnh ngày kết thúc nếu ngày bắt đầu lớn hơn
                    }
                });

                // Đảm bảo ngày kết thúc không nhỏ hơn ngày bắt đầu
                endDate.addEventListener('change', function() {
                    if (endDate.value < startDate.value) {
                        startDate.value = endDate.value; // Điều chỉnh ngày bắt đầu nếu ngày kết thúc nhỏ hơn
                    }
                });
            }
        </script>


        <script>
            // Khi người dùng chọn một trạng thái, giữ lại các tham số filter khác (start_date, end_date)
            document.querySelectorAll('.dropdown-item').forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault(); // Ngừng hành động mặc định của liên kết

                    const trangThai = this.getAttribute('data-trang-thai');
                    const startDate = document.getElementById('start_date').value;
                    const endDate = document.getElementById('end_date').value;
                    const page = new URLSearchParams(window.location.search).get('page') ||
                        1; // Giữ lại trang hiện tại

                    // Tạo URL mới với tất cả các tham số (start_date, end_date, trang_thai, page)
                    let url = new URL(window.location.href);

                    // Thêm tham số lọc và số trang
                    url.searchParams.set('trang_thai', trangThai);
                    if (startDate) url.searchParams.set('start_date', startDate); // Kiểm tra start_date
                    if (endDate) url.searchParams.set('end_date', endDate); // Kiểm tra end_date
                    url.searchParams.set('page', page); // Thêm tham số phân trang

                    // Điều hướng tới URL mới
                    window.location.href = url;
                });
            });
        </script>

    
    @endsection
