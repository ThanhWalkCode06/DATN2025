<header class="pb-md-4 pb-0">
    <style>
        .navbar-nav .nav-link::before {
            display: none !important;
        }

        .notification-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            width: 300px;
        }

        .notification-box {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            position: relative;
        }

        .notification-content h6 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .notification-content p {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }

        .notification-content small {
            font-size: 10px;
            color: #999;
        }

        .btn-link {
            font-size: 12px;
            padding: 0;
        }

        .badge {
            background-color: #ff4c3b;
            color: white;
            font-size: 12px;
            padding: 4px 8px;
        }

        .mark-all-read,
        .delete-all {
            display: inline-block;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .delete-button {
            position: absolute;
            top: -2px;
            /* Adjusted from 10px to 14px to move the "x" down */
            right: -3px;
            background: none;
            border: none;
            cursor: pointer;
            color: #ff4c3b;
            font-size: 14px;
        }
    </style>
    <div class="header-top">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 d-xxl-block d-none">
                    <div class="top-left-header">
                        <i class="fas fa-map-marker-alt text-white me-2"></i>
                        <a href="{{ $globalSetting->url_map ?? '' }}">
                            <span class="text-white">{{ $globalSetting->location ?? '' }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                    <div class="header-offer">
                        <div class="notification-slider">
                            <div>
                                <div class="timer-notification">
                                    <h6><strong class="me-1">Chào mừng tới
                                            {{ $globalSetting->name_website ?? 'Seven Stars' }}</strong>
                                    </h6>
                                </div>
                            </div>
                            @if (Auth::check())
                                <div>
                                    <div class="timer-notification">
                                        <h6>Mã giảm giá cho người mới:
                                            <strong class="me-1">COD1234567</strong>
                                        </h6>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <div class="timer-notification">
                                    <h6>Mua hàng ngay thôi nào!
                                        <a href="{{ route('sanphams.danhsach') }}" class="text-white">Mua ngay!</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <a href="{{ route('home') }}" class="web-logo nav-logo">
                            <img src="{{ Storage::url($globalSetting->client_logo ?? 'images/logo-green.png') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <div class="middle-box">
                            <div class="search-box">
                                <form action="{{ route('sanphams.danhsach') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" name="query" id="searchInput" class="form-control"
                                            placeholder="Tìm kiếm sản phẩm" value="{{ request('query') }}">
                                        <button class="btn" type="submit" id="button-addon2">
                                            <i data-feather="search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Tìm kiếm">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown">
                                        <a href="#" class="btn p-0 position-relative header-notification">
                                            <i data-feather="bell"></i>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge notification-count"
                                                style="display: none;">0
                                                <span class="visually-hidden">unread notifications</span>
                                            </span>
                                        </a>
                                        <div class="onhover-div">
                                            <button class="btn btn-sm btn-link mark-all-read"
                                                data-url="{{ route('thongbao.da_doc', 0) }}">Đánh dấu tất cả đã
                                                đọc</button>
                                            <button class="btn btn-sm btn-link delete-all"
                                                data-url="{{ route('thongbao.delete_all') }}">Xóa tất cả</button>
                                            <ul class="notification-list">
                                                {{-- @php
                                                    $thongBaos = Auth::check()
                                                        ? App\Models\ThongBao::with('danhGia.sanPham')
                                                            ->where('user_id', Auth::id())
                                                            ->where('trang_thai', 0)
                                                            ->orderBy('created_at', 'desc')
                                                            ->get()
                                                        : collect([]);
                                                @endphp --}}
                                                @php
                                                    $thongBaos = Auth::check()
                                                        ? App\Models\ThongBao::with('danhGia.sanPham')
                                                            ->where('user_id', Auth::id())
                                                            ->orderBy('created_at', 'desc')
                                                            ->get()
                                                        : collect([]);
                                                @endphp
                                                @if ($thongBaos->count() > 0)
                                                    @foreach ($thongBaos as $thongBao)
                                                        <li class="notification-box"
                                                            id="notification-{{ $thongBao->id }}">
                                                            <div class="notification-content">
                                                                <h6>{{ $thongBao->noi_dung }}</h6>
                                                                <p>Sản phẩm:
                                                                    {{ $thongBao->danhGia->sanPham->ten_san_pham ?? 'Không xác định' }}
                                                                </p>
                                                                @if ($thongBao->danhGia && $thongBao->danhGia->nhan_xet)
                                                                    <p>Nhận xét: {{ $thongBao->danhGia->nhan_xet }}</p>
                                                                @endif
                                                                @if ($thongBao->danhGia && $thongBao->danhGia->ly_do_an)
                                                                    <p>Lý do: {{ $thongBao->danhGia->ly_do_an }}</p>
                                                                @endif

                                                                {{-- <small>{{ $thongBao->created_at->diffForHumans() }}</small> --}}
                                                            </div>
                                                            <button class="delete-button" data-id="{{ $thongBao->id }}"
                                                                data-url="{{ route('thongbao.delete', $thongBao->id) }}">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="notification-box">
                                                        <p>Không có thông báo mới.</p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="{{ route('sanphams.sanphamyeuthich') }}"
                                        class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="shopping-cart"></i>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge">{{ $gioHang->count() ?? 0 }}
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </button>
                                        <div class="onhover-div">
                                            <ul style="width: 100%" class="cart-list">
                                                @foreach ($gioHang->take(4) as $item)
                                                    <li style="width: 100%" class=" raffle-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="{{ route('sanphams.chitiet', $item->bienThe->SanPham->id) }}"
                                                                class="drop-image">
                                                                <img src="{{ Storage::url($item->bienThe->anh_bien_the) }}"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>
                                                            <div class="dropcontain">
                                                                <a
                                                                    href="{{ route('sanphams.chitiet', $item->bienThe->SanPham->id) }}">
                                                                    <h5>{{ $item->bienThe->sanPham->ten_san_pham }}
                                                                    </h5>
                                                                    <h6>{{ $item->bienThe->ten_bien_the }}</h6>
                                                                </a>
                                                                <h6><span>{{ $item->so_luong }} x</span>
                                                                    {{ number_format($item->bienThe->gia_ban, 0, '', '.') }}
                                                                    đ
                                                                </h6>
                                                                <style>
                                                                    .hidden-delete {
                                                                        visibility: hidden;
                                                                    }
                                                                </style>
                                                                @if (!request()->is('giohang', 'thanhtoan'))
                                                                    <button
                                                                        class="close-button close_button delete-cart-item"
                                                                        data-id="{{ $item->id }}">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                @else
                                                                    <button
                                                                        class="close-button close_button delete-cart-item hidden-delete"
                                                                        data-id="{{ $item->id }}">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="price-box">
                                                <h5>Tổng tiền :</h5>
                                                <h4 class="theme-color fw-bold total-price">
                                                    {{ number_format($total, 0, '', '.') }} đ
                                                </h4>
                                            </div>
                                            <div class="button-group">
                                                <a href="{{ route('giohang') }}" class="btn btn-sm cart-button">Xem
                                                    giỏ hàng</a>
                                                <a href="{{ route('thanhtoans.thanhtoan') }}"
                                                    class="btn btn-sm cart-button theme-bg-color text-white">Thanh
                                                    toán</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>Xin chào,</h6>
                                            <h5>{{ Auth::user()->username ?? 'Guess' }}</h5>
                                        </div>
                                    </div>
                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                            @if (!Auth::user())
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{ route('login.client') }}">Đăng nhập</a>
                                                </li>
                                            @else
                                                <p>Xin chào <strong
                                                        style="color: #0da487">{{ Auth::user()->username }}</strong>
                                                </p>
                                                <li class="product-box-contain">
                                                    <a href="{{ route('users.chitiet') }}">Chi tiết tài khoản</a>
                                                </li>
                                                <li><a href="{{ route('vi') }}">Ví của tôi</a></li>
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a onclick="Logout(event)" href="#">Đăng xuất</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="header-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category">
                            <i data-feather="align-left"></i>
                            <span>Tất cả danh mục</span>
                        </button>
                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Danh mục sản phẩm</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <ul class="category-list">
                                @if (isset($danhMucsp))
                                    @foreach ($danhMucsp as $category)
                                        <li class="onhover-category-list">
                                            <a href="{{ route('sanphams.danhsach', ['danh_muc_id' => $category->id]) }}"
                                                class="category-name">
                                                <img src="{{ asset('storage/' . $category->anh_danh_muc) }}"
                                                    alt="{{ $category->ten_danh_muc }}">
                                                <h6>{{ $category->ten_danh_muc }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="header-nav-middle">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button"
                                        data-bs-dismiss="offcanvas"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('sanphams.danhsach') }}">Sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('baiviets.danhsach') }}">Bài viết</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('huongdans.danhsach') }}">Hướng
                                                dẫn</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('gioithieu.home') }}">Giới thiệu</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ route('lienhe.home') }}">Liên hệ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-nav-right">
                        <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                            <i data-feather="zap"></i>
                            <span>Top sản phẩm hôm nay</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thay phần JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm cập nhật số lượng thông báo chưa đọc
            function updateNotificationCount() {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/thong-bao/countUnread', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const badge = document.querySelector('.notification-count');
                        badge.textContent = data.count;
                        badge.style.display = data.count > 0 ? 'inline' : 'none';
                    })
                    .catch(error => console.error('Lỗi khi tải số lượng thông báo:', error));
            }

            // Xử lý nút "Đánh dấu tất cả đã đọc"
            const markAllReadButton = document.querySelector('.mark-all-read');
            if (markAllReadButton) {
                markAllReadButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                updateNotificationCount(); // Cập nhật badge
                                document.querySelectorAll('.notification-box').forEach(item => {
                                    item.classList.add('read');
                                });
                            } else {
                                console.error('Lỗi khi đánh dấu tất cả thông báo đã đọc:', data
                                .message);
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            }

            // Xử lý nút "Xóa tất cả"
            const deleteAllButton = document.querySelector('.delete-all');
            if (deleteAllButton) {
                deleteAllButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Hiển thị SweetAlert2 xác nhận
                    Swal.fire({
                        title: 'Xác nhận xóa tất cả thông báo',
                        text: 'Bạn có chắc chắn muốn xóa toàn bộ thông báo không?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0da487', // Màu nút "Có" (xanh)
                        cancelButtonColor: '#ff4c3b', // Màu nút "Không" (đỏ)
                        confirmButtonText: 'Có',
                        cancelButtonText: 'Không',
                        reverseButtons: false, // Nút "Có!" ở bên trái, "Không" ở bên phải
                        customClass: {
                            popup: 'sweetalert-custom-popup',
                            title: 'sweetalert-custom-title',
                            content: 'sweetalert-custom-content',
                            confirmButton: 'sweetalert-custom-button',
                            cancelButton: 'sweetalert-custom-button'
                        },
                        backdrop: `rgba(0,0,0,0.4)` // Lớp phủ mờ phía sau
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': token
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        const notificationList = document.querySelector(
                                            '.notification-list');
                                        notificationList.innerHTML =
                                            '<li class="notification-box"><p>Không có thông báo mới.</p></li>';
                                        updateNotificationCount(); // Cập nhật badge

                                        // Hiển thị thông báo thành công
                                        Swal.fire({
                                            title: 'Thành công!',
                                            text: 'Tất cả thông báo đã được xóa.',
                                            icon: 'success',
                                            confirmButtonColor: '#0da487',
                                            timer: 1500, // Tự động đóng sau 1.5 giây
                                            showConfirmButton: false
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Lỗi!',
                                            text: 'Không thể xóa tất cả thông báo: ' + (
                                                data.message || 'Lỗi không xác định'
                                                ),
                                            icon: 'error',
                                            confirmButtonColor: '#0da487'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Lỗi:', error);
                                    Swal.fire({
                                        title: 'Lỗi!',
                                        text: 'Đã xảy ra lỗi khi xóa tất cả thông báo.',
                                        icon: 'error',
                                        confirmButtonColor: '#0da487'
                                    });
                                });
                        }
                    });
                });
            }
            // const deleteAllButton = document.querySelector('.delete-all');
            // if (deleteAllButton) {
            //     deleteAllButton.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         const url = this.getAttribute('data-url');
            //         const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            //         fetch(url, {
            //                 method: 'DELETE',
            //                 headers: {
            //                     'Content-Type': 'application/json',
            //                     'X-CSRF-TOKEN': token
            //                 }
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.success) {
            //                     const notificationList = document.querySelector('.notification-list');
            //                     notificationList.innerHTML =
            //                         '<li class="notification-box"><p>Không có thông báo mới.</p></li>';
            //                     updateNotificationCount(); // Cập nhật badge
            //                 } else {
            //                     console.error('Lỗi khi xóa tất cả thông báo:', data.message);
            //                 }
            //             })
            //             .catch(error => console.error('Lỗi:', error));
            //     });
            // }

            // Xử lý nút xóa từng thông báo
            function attachDeleteButtonListeners() {
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const notificationId = this.getAttribute('data-id');
                        const url = this.getAttribute('data-url');
                        const token = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');

                        // Hiển thị SweetAlert2 xác nhận
                        Swal.fire({
                            title: 'Xác nhận xóa thông báo',
                            text: 'Bạn có chắc chắn muốn xóa thông báo này không?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#0da487', // Màu nút "Có" (phù hợp với theme xanh của bạn)
                            cancelButtonColor: '#ff4c3b', // Màu nút "Không" (phù hợp với theme đỏ)
                            confirmButtonText: 'Có',
                            cancelButtonText: 'Không',
                            reverseButtons: false, // Đặt nút "Có!" trước (bên trái) nút "Không"
                            customClass: {
                                popup: 'sweetalert-custom-popup',
                                title: 'sweetalert-custom-title',
                                content: 'sweetalert-custom-content',
                                confirmButton: 'sweetalert-custom-button',
                                cancelButton: 'sweetalert-custom-button'
                            },
                            backdrop: `rgba(0,0,0,0.4)` // Lớp phủ mờ phía sau
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(url, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Xóa thông báo khỏi DOM
                                            const notificationElement = document
                                                .getElementById('notification-' +
                                                    notificationId);
                                            if (notificationElement) {
                                                notificationElement.remove();
                                            }

                                            // Cập nhật số lượng thông báo chưa đọc
                                            updateNotificationCount();

                                            // Hiển thị thông báo mặc định nếu danh sách rỗng
                                            const notificationList = document
                                                .querySelector('.notification-list');
                                            if (notificationList.children.length ===
                                                0) {
                                                notificationList.innerHTML =
                                                    '<li class="notification-box"><p>Không có thông báo mới.</p></li>';
                                            }

                                            // Hiển thị thông báo thành công
                                            Swal.fire({
                                                title: 'Thành công!',
                                                text: 'Thông báo đã được xóa.',
                                                icon: 'success',
                                                confirmButtonColor: '#0da487',
                                                timer: 1500, // Tự động đóng sau 1.5 giây
                                                showConfirmButton: false
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Lỗi!',
                                                text: 'Không thể xóa thông báo: ' +
                                                    (data.message ||
                                                        'Lỗi không xác định'),
                                                icon: 'error',
                                                confirmButtonColor: '#0da487'
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Lỗi:', error);
                                        Swal.fire({
                                            title: 'Lỗi!',
                                            text: 'Đã xảy ra lỗi khi xóa thông báo.',
                                            icon: 'error',
                                            confirmButtonColor: '#0da487'
                                        });
                                    });
                            }
                        });
                    });
                });
            }
            // function attachDeleteButtonListeners() {
            //     document.querySelectorAll('.delete-button').forEach(button => {
            //         button.addEventListener('click', function(e) {
            //             e.preventDefault();
            //             const notificationId = this.getAttribute('data-id');
            //             const url = this.getAttribute('data-url');
            //             const token = document.querySelector('meta[name="csrf-token"]')
            //                 .getAttribute('content');

            //             fetch(url, {
            //                     method: 'DELETE',
            //                     headers: {
            //                         'Content-Type': 'application/json',
            //                         'X-CSRF-TOKEN': token
            //                     }
            //                 })
            //                 .then(response => response.json())
            //                 .then(data => {
            //                     if (data.success) {
            //                         // Xóa thông báo khỏi DOM
            //                         const notificationElement = document.getElementById(
            //                             'notification-' + notificationId);
            //                         if (notificationElement) {
            //                             notificationElement.remove();
            //                         }

            //                         // Cập nhật số lượng thông báo chưa đọc
            //                         updateNotificationCount();

            //                         // Hiển thị thông báo mặc định nếu danh sách rỗng
            //                         const notificationList = document.querySelector(
            //                             '.notification-list');
            //                         if (notificationList.children.length === 0) {
            //                             notificationList.innerHTML =
            //                                 '<li class="notification-box"><p>Không có thông báo mới.</p></li>';
            //                         }
            //                     } else {
            //                         console.error('Lỗi khi xóa thông báo:', data.message);
            //                     }
            //                 })
            //                 .catch(error => console.error('Lỗi:', error));
            //         });
            //     });
            // }

            // Gắn sự kiện cho các nút xóa ban đầu
            attachDeleteButtonListeners();

            // Cấu hình Pusher
            const pusher = new Pusher("0ca5e8c271c25e1264d2", {
                cluster: "ap1",
                encrypted: true
            });

            let userId = {{ Auth::id() ?? 'null' }};
            let channel = null;

            // Hàm khởi tạo Pusher channel
            function initializePusher(userId) {
                if (channel) {
                    pusher.unsubscribe('notifications-' + userId);
                }
                channel = pusher.subscribe('notifications-' + userId);

                channel.bind('new-notification', function(data) {
                    console.log('Nhận thông báo mới:', data);

                    // Cập nhật số lượng thông báo
                    updateNotificationCount();

                    // Thêm thông báo mới vào đầu danh sách
                    const notificationList = document.querySelector('.notification-list');
                    if (notificationList.querySelector('p')?.textContent === 'Không có thông báo mới.') {
                        notificationList.innerHTML = '';
                    }

                    const notificationItem = document.createElement('li');
                    notificationItem.classList.add('notification-box');
                    notificationItem.id = 'notification-' + data.id;
                    notificationItem.innerHTML = `
                <div class="notification-content">
                    <h6>${data.noi_dung}</h6>
                    <p>Sản phẩm: ${data.product_name}</p>
                    ${data.nhan_xet ? `<p>Nhận xét: ${data.nhan_xet}</p>` : ''}
                    ${data.ly_do_an ? `<p>Lý do: ${data.ly_do_an}</p>` : ''}
                    
                    <small class="d-block">${data.created_at_full}</small>
                </div>
                <button class="delete-button" data-id="${data.id}" data-url="/thongbao/${data.id}/delete">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
                    notificationList.prepend(notificationItem);

                    // Gắn sự kiện cho nút xóa mới
                    attachDeleteButtonListeners();
                });
            }

            // Hàm tải danh sách thông báo
            window.loadNotificationCount = function() {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/thong-bao/fetchAll', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => response.json())
                    .then(notifications => {
                        updateNotificationCount(); // Cập nhật badge

                        const notificationList = document.querySelector('.notification-list');
                        if (notifications.length > 0) {
                            notificationList.innerHTML = '';
                            notifications.sort((a, b) => new Date(b.created_at_full) - new Date(a
                                .created_at_full));
                            notifications.forEach(thongBao => {
                                const notificationItem = document.createElement('li');
                                notificationItem.classList.add('notification-box');
                                if (thongBao.trang_thai === 1) {
                                    notificationItem.classList.add('read');
                                }
                                notificationItem.id = 'notification-' + thongBao.id;
                                notificationItem.innerHTML = `
                            <div class="notification-content">
                                <h6>${thongBao.noi_dung}</h6>
                                <p>Sản phẩm: ${thongBao.danh_gia?.san_pham?.ten_san_pham ?? 'Không xác định'}</p>
                                ${thongBao.danh_gia?.ly_do_an ? `<p>Lý do: ${thongBao.danh_gia.ly_do_an}</p>` : ''}
                                ${thongBao.nhan_xet ? `<p>Nhận xét: ${thongBao.nhan_xet}</p>` : ''}
                                
                                <small class="d-block">${thongBao.created_at_full}</small>
                            </div>
                            <button class="delete-button" data-id="${thongBao.id}" data-url="/thongbao/${thongBao.id}/delete">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        `;
                                notificationList.appendChild(notificationItem);
                            });
                        } else {
                            notificationList.innerHTML =
                                '<li class="notification-box"><p>Không có thông báo mới.</p></li>';
                        }

                        attachDeleteButtonListeners();
                    })
                    .catch(error => console.error('Lỗi khi tải danh sách thông báo:', error));
            };

            // Khởi tạo Pusher và tải thông báo nếu đã đăng nhập
            if (userId !== 'null') {
                initializePusher(userId);
                window.loadNotificationCount();
            }
        });
    </script>
</header>
