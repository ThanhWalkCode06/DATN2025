@extends('layouts.client')
@section('title')
    Theo dõi đơn hàng
@endsection

@section('css')
@endsection

@section('content')

    <body>


        <!-- mobile fix menu start -->
        <div class="mobile-menu d-md-none d-block mobile-cart">
            <ul>
                <li class="active">
                    <a href="index.html">
                        <i class="iconly-Home icli"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li class="mobile-category">
                    <a href="javascript:void(0)">
                        <i class="iconly-Category icli js-link"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li>
                    <a href="search.html" class="search-box">
                        <i class="iconly-Search icli"></i>
                        <span>Search</span>
                    </a>
                </li>

                <li>
                    <a href="wishlist.html" class="notifi-wishlist">
                        <i class="iconly-Heart icli"></i>
                        <span>My Wish</span>
                    </a>
                </li>

                <li>
                    <a href="cart.html">
                        <i class="iconly-Bag-2 icli fly-cate"></i>
                        <span>Cart</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- mobile fix menu end -->

        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>Theo dõi đơn hàng</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('users.chitiet') }}">
                                            <i class="fa-solid fa-house"></i>
                                    <li class="breadcrumb-item active">Xem đơn hàng khác</li>
                                    </a>
                                    </li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Order Detail Section Start -->
        <section class="order-detail">
            <div class="container-fluid-lg">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-3 col-xl-4 col-lg-6">
                        <div class="order-image">
                            <img src="{{ asset('assets/images/box.png') }}" class="img-fluid blur-up lazyload"
                                alt="">
                        </div>
                        <div style="display: flex">
                            @php $trangThai = $donHang->trang_thai_don_hang; @endphp

                            @if ($trangThai == 0 || $trangThai == 1)
                                <form style="margin-left: 10px" id="cancel-form-{{ $donHang->id }}"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST"
                                    onsubmit="return false;">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="-1">
                                    <button style="border: none" type="button" class="btn-danger btn-sm confirm-btn"
                                        data-form-id="cancel-form-{{ $donHang->id }}" data-title="Nhập lý do hủy đơn"
                                        data-trang-thai="-1" data-action="Hủy đơn">
                                        Hủy đơn
                                    </button>
                                </form>
                            @endif

                            {{-- TRẢ HÀNG --}}
                            @if ($trangThai == 3)
                                <form style="margin-left: 10px" id="return-form-{{ $donHang->id }}"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}" method="POST"
                                    onsubmit="return false;">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="5">
                                    <button style="border: none" type="button" class="btn-success btn-sm confirm-btn"
                                        data-form-id="return-form-{{ $donHang->id }}" data-title="Nhập lý do trả hàng"
                                        data-trang-thai="5" data-action="Trả hàng">
                                        Trả hàng
                                    </button>
                                </form>
                            @endif

                            @if ($trangThai == 3)
                                <form style="margin-left: 10px" action="{{ route('order.updateTrangThai', $donHang->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="4">
                                    <button type="submit" style="border: none" type="button" class="btn-primary btn-sm">
                                        Đã nhận hàng
                                    </button>
                                </form>
                            @endif
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="lyDoModal" tabindex="-1" aria-labelledby="lyDoModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form id="ly-do-form" method="POST"
                                    action="{{ route('order.updateTrangThai', $donHang->id) }}">
                                    @csrf
                                    <input type="hidden" name="trang_thai" id="modal-trang-thai">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="lyDoModalLabel">Nhập lý do</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea class="form-control" name="ly_do" id="modal-ly-do" rows="4" placeholder="Nhập lý do tại đây..."></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button style="border:none" type="button" class="btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button style="border:none" type="submit" class="btn-primary btn-sm">Xác
                                                nhận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-9 col-xl-8 col-lg-6">
                        <div class="row g-sm-4 g-3">
                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="package" class="text-content"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Mã đơn hàng</h5>
                                        <h2 class="theme-color">{{ $donHang->ma_don_hang }}</h2>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="credit-card"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Tổng tiền</h5>
                                        <h4 style="color: #0da487; font-weight: bold">
                                            {{ number_format($donHang->tong_tien, 0, '', '.') }} đ</h4>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="gift"></i>
                                    </div>

                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($bienThesList as $chiTietDonHang)
                                        @php
                                            $total += $chiTietDonHang['gia_ban'] * $chiTietDonHang['so_luong'];
                                        @endphp
                                    @endforeach
                                    @php
                                        $countPrice = 0;
                                        $countPrice = $total - $donHang->tong_tien + 10000;
                                    @endphp

                                    <div class="order-details-name">
                                        <h5 class="text-content">Phiếu giảm giá áp dụng</h5>
                                        <h5 style="color: #0da487; font-weight: bold">
                                            @if (!empty($checkVoucher))
                                                <span>Mã phiếu: {{ $checkVoucher->phieuGiamGia->ma_phieu ?? '' }}</span>
                                                <span>Giá trị:
                                                    {{ '-' . $checkVoucher->phieuGiamGia->gia_tri . '%' ?? '' }}</span>
                                                <br>
                                                <span>{{ $checkVoucher ? 'Đã giảm ' . number_format($countPrice, 0, '', '.') . ' đ' : '' }}</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="map-pin"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Địa chỉ nhận</h5>
                                        <h4 style="color: #0da487; font-weight: bold">{{ $donHang->dia_chi_nguoi_nhan }}
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="info"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Trạng thái thanh toán</h5>
                                        <h4
                                            style="color: {{ $donHang->trang_thai_thanh_toan == 1 ? '#0da487' : 'red' }}; font-weight: bold ">
                                            {{ $donHang->trang_thai_thanh_toan == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            @php
                                $statusText = match ($donHang->trang_thai_don_hang) {
                                    -1 => 'Hủy Đơn', // Trạng thái 0 -> Ẩn đơn hàng
                                    5 => 'Trả Hàng', // Trạng thái 1 -> Hoàn trả hàng
                                    default => '',
                                };
                            @endphp
                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="truck" class=""></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Trạng thái</h5>
                                        <h4 style="color: red; font-weight: bold">
                                            @if ($donHang->trang_thai_don_hang == -1)
                                                <span class="order-danger">Đã hủy</span>
                                            @elseif ($donHang->trang_thai_don_hang == 0)
                                                <span class="order-danger">Chờ xác nhận</span>
                                            @elseif ($donHang->trang_thai_don_hang == 1)
                                                <span class="order-primary">Đang xử lý</span>
                                            @elseif ($donHang->trang_thai_don_hang == 2)
                                                <span class="order-primary">Đang giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 3)
                                                <span class="order-success">Đã giao</span>
                                            @elseif ($donHang->trang_thai_don_hang == 4)
                                                <span class="order-success">Hoàn thành</span>
                                            @elseif ($donHang->trang_thai_don_hang == 5)
                                                <span class="order-danger">Trả hàng</span>
                                            @else
                                                <span>Trạng thái không hợp lệ</span>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="calendar"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Thời gian đặt</h5>
                                        <h4 style="color: #0da487; font-weight: bold">{{ $donHang->created_at }}</h4>
                                    </div>
                                </div>
                            </div>

                            @php
                                $statusChart = $donHang->trang_thai_don_hang;
                            @endphp
                            <div class="col-12 overflow-hidden">
                                <ol class="progtrckr">
                                    <li class="progtrckr-{{ $statusChart >= 0 ? 'done' : 'todo' }}">
                                        <h5>Chờ xác nhận</h5>
                                    </li>
                                    <li class="progtrckr-{{ $statusChart >= 1 ? 'done' : 'todo' }}">
                                        <h5>Đang xử lý</h5>
                                    </li>
                                    <li class="progtrckr-{{ $statusChart >= 2 ? 'done' : 'todo' }}">
                                        <h5>Đang giao</h5>
                                    </li>
                                    <li class="progtrckr-{{ $statusChart >= 3 ? 'done' : 'todo' }}">
                                        <h5>Đã giao</h5>
                                    </li>

                                    <li class="progtrckr-{{ $statusChart >= 4 && $statusChart != 5 ? 'done' : 'todo' }}">
                                        <h5>Đã nhận hàng</h5>
                                    </li>

                                    <!-- Trạng thái trả hàng -->
                                    @if ($statusChart == 5)
                                        <li class="progtrckr-done">
                                            <h5>Trả hàng</h5>
                                        </li>
                                    @endif



                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Order Detail Section End -->

        <!-- Order Table Section Start -->
        <section class="order-table-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table order-tab-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bienThesList as $index => $item)
                                        <tr>
                                            <td style="line-height: 126px">{{ $index++ }}</td>
                                            <td>
                                                <img style="width: 100px; height: 100px"
                                                    src="{{ Storage::url($item['anh_bien_the']) }}" alt="">
                                            </td>
                                            <td style="line-height: 126px">
                                                <a href="{{ route('sanphams.chitiet', $item['id_san_pham']) }}">
                                                    {{ $item['ten_bien_the'] }}
                                                </a>
                                            </td>
                                            <td style="color: #0da487;line-height: 126px">
                                                {{ number_format($item['gia_ban'], 0, '', '.') }} đ</td>
                                            <td style="line-height: 126px">{{ $item['so_luong'] }}</td>
                                            <td style="line-height: 126px">
                                                @if ($statusChart == 4)
                                                    <a style="width:100px;height:30px"
                                                        href="{{ route('sanphams.chitiet', $item['id_san_pham']) }}"
                                                        style="border: none" class="btn-primary btn-sm">
                                                        Đánh giá sản phẩm
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $bienThesPaginated->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Order Table Section End -->

    </body>
@endsection


@section('js')
@endsection
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".confirm-btn").forEach(button => {
            button.addEventListener("click", function () {
                let orderId = this.dataset.id;
                let actionText = this.dataset.action;
                Swal.fire({
                    title: `Bạn có chắc muốn ${actionText.toLowerCase()} không?`,
                    text: "Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, tiếp tục!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('order-form-' + orderId).submit();
                    }
                });
            });
        });
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentForm = null;

        document.querySelectorAll('.confirm-btn').forEach(button => {
            button.addEventListener('click', function() {
                const formId = this.dataset.formId;
                const title = this.dataset.title;
                const trangThai = this.dataset.trangThai;

                currentForm = document.getElementById(formId);
                document.getElementById('lyDoModalLabel').textContent = title;
                document.getElementById('modal-trang-thai').value = trangThai;
                document.getElementById('modal-ly-do').value = '';

                const modal = new bootstrap.Modal(document.getElementById('lyDoModal'));
                modal.show();
            });
        });

        document.getElementById('ly-do-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const lyDo = document.getElementById('modal-ly-do').value.trim();
            const trangThai = document.getElementById('modal-trang-thai').value;

            if (!lyDo) {
                Swal.fire("Lỗi", "Vui lòng nhập lý do!", "error");
                return;
            }

            // Cập nhật trạng thái nếu form có sẵn input hidden
            const trangThaiInput = currentForm.querySelector('input[name="trang_thai"]');
            if (trangThaiInput) {
                trangThaiInput.value = trangThai;
            }

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'ly_do';
            hiddenInput.value = lyDo;
            currentForm.appendChild(hiddenInput);

            currentForm.submit();
        });
    });
</script>
