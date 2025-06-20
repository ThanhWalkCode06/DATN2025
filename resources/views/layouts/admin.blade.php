<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <title>@yield('title')</title>
    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/linearicon.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ratio.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vector-map.css') }}">

    <!-- Slick Slider Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/slick.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/load.css') }}">
    <style>
        label{
            font-size: 14px !important;
        }
    </style>


</head>

<body>
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        {{-- <span></span>
        {{-- <span></span> --}}
        <span></span>
        <span></span>
    </div>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('admins.blocks.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('admins.blocks.sidebar')
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- footer start-->
                {{-- @include('admins.blocks.footer') --}}
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Đăng xuất</h5>
                    <p>Bạn có chắc chắn muốn đăng xuất tài khoản?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">Không</button>
                        <a href="{{ route('logout') }}"><button type="button"
                                class="btn  btn--yes btn-primary">Có</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const icon = document.querySelector(".mode i");
            const body = document.body;

            // Kiểm tra trạng thái trong localStorage để áp dụng ngay khi trang load
            if (localStorage.getItem("darkMode") === "enabled") {
                body.classList.add("dark-only");
                icon.classList.add("fa-moon-o", "fa-lightbulb-o");
                setTimeout(() => {
                    const thElements = document.querySelectorAll(".sorting_disabled");
                    const checkbox = document.querySelector(".checkbox_animated");
                    console.log(checkbox); // Kiểm tra lại
                    if (thElements) {
                        // checkbox.style.background-color = "#0da487";
                        thElements.forEach(th => {
                            th.style.color = "#0da487"; // Áp dụng màu cho từng phần tử
                        });
                    }
                }, 100);
            }

            icon.addEventListener("click", function() {

                if (body.classList.contains("dark-only")) {
                    localStorage.removeItem("darkMode");
                } else {
                    localStorage.setItem("darkMode", "enabled");
                }
            });
        });
    </script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.js') }}"></script> --}}
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('assets/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>

    <!-- Plugins JS -->
    {{-- <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script> --}}
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>

    <!-- Apexchar js -->
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/chart-custom1.js') }}"></script>


    <!-- slick slider js -->
    {{-- <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-slick.js') }}"></script> --}}

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!--Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>

    <!-- ratio js -->
    <script src="{{ asset('assets/js/ratio.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('load', function() {
            let loader = document.querySelector('.fullpage-loader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500); // Ẩn hẳn sau 0.5 giây
        });
    </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("0ca5e8c271c25e1264d2", {
            cluster: "ap1"
        });

        var channel = pusher.subscribe("don-hang");
        channel.bind("dat-hang-thanh-cong", function(data) {
            // alert("Có đơn hàng mới! Tổng tiền: " + data.donHang.tong_tien + " VNĐ");
            // console.log(data.donHang)
            // console.log(data.donHang.tong_tien)

            $(window).ready(function() {
                $.notify({
                    title: "Có đơn hàng mới",
                    message: "Mã đơn hàng: " + data.donHang.ma_don_hang
                }, {
                    type: "primary",
                    delay: 5000
                });
            })
        });
    </script>

    @if (session('success'))
        <script>
            $(window).ready(function() {
                $.notify({
                    title: "Thực hiện thao tác thành công!",
                    message: "{{ session('success') }}"
                }, {
                    type: "primary",
                    delay: 5000
                });
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            $(window).ready(function() {
                $.notify({
                    title: "Thao tác thất bại!!",
                    message: "{{ session('error') }}"
                }, {
                    type: "secondary",
                    delay: 5000
                });
            })
        </script>
    @endif

    <script>
        function loadNotifications() {
            $.ajax({
                url: "{{ route('thongbao.fetch') }}",
                type: "GET",
                success: function(data) {
                    let html =
                        '<li><i class="ri-notification-line"></i><h6 class="f-18 mb-0">Thông báo</h6></li>';
                    if (data.length > 0) {
                        data.forEach(function(item) {
                            html += `<li>
                        <a href="/admin/donhangs/${item.id_dinh_kem}" class="d-flex" style="font-size:12px">
                            <span class="col-8">${item.noi_dung}</span>
                            <span class="col-4">
                                <div class="float-end">${new Date(item.created_at).toLocaleTimeString()}</div>
                            </span>
                        </a>
                    </li>`;
                        });
                    } else {
                        html += '<li><a href="#">Không có thông báo mới</a></li>';
                    }

                    html += '<li><a class="btn btn-primary" href="/admin/donhangs">Xem toàn bộ</a></li>';

                    $('.notification-dropdown').html(html);
                    if (data.length > 0) {
                        $('.notification-box .badge').text(data.length);
                    }
                }
            });
        }

        $(document).ready(function() {
            loadNotifications();
            setInterval(loadNotifications, 5000);
        });
    </script>

    <script src="{{ asset('assets/js/alert/confirmalert.js') }}"></script>
    @yield('js')
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/select2-custom.js') }}"></script>
<script>
    $(function() {
        $('.super-select2').select2({
            width: '50%',
            placeholder: "-- Chọn --",
            allowClear: true
        });
    });
</script>
