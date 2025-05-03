@extends('layouts.admin')

@section('title')
    Đơn hàng
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

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
                    <h5>Danh sách đơn hàng</h5>
                    {{-- <a href="#" class="btn btn-solid">Download all orders</a> --}}
                </div>
                <div class="w-100">
                    <div class="table-responsive">
                        <div class="d-flex mb-3 col-12">
                            <div class="col-4">
                                <div id="bulk-action-wrapper" style="display: none;">
                                    <label>Trạng thái đơn hàng</label>
                                    <div class="d-flex">
                                        <select id="bulkStatus" class="form-control col-8"
                                            style="width: auto; display: inline-block;">
                                            <option value="">-- Chọn trạng thái mới --</option>
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Đang giao</option>
                                            <option value="3">Đã giao</option>
                                        </select>
                                        <button id="bulkUpdateBtn" class="btn btn-primary col-4 mx-2">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 d-flex flex-row-reverse">
                                <div class="col-3">
                                    <label for="trang_thai_don_hang">Trạng thái đơn hàng</label>
                                    <select id="trang_thai_don_hang" class="form-control">
                                        <option value="">Tất cả</option>
                                        <option value="0">Chờ xác nhận</option>
                                        <option value="1">Đang xử lý</option>
                                        <option value="2">Đang giao</option>
                                        <option value="3">Đã giao</option>
                                        <option value="4">Hoàn thành</option>
                                        <option value="5">Trả hàng</option>
                                        <option value="-1">Đã hủy</option>
                                    </select>
                                </div>
                                <div class="col-3 mx-2">
                                    <label for="trang_thai_thanh_toan">Trạng thái thanh toán</label>
                                    <select id="trang_thai_thanh_toan" class="form-control">
                                        <option value="">Tất cả</option>
                                        <option value="0">Chưa thanh toán</option>
                                        <option value="1">Đã thanh toán</option>
                                        <option value="2">Đã hoàn tiền</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="searchDonHang">Tìm kiếm</label>
                                    <input type="text" id="searchDonHang" class="form-control"
                                        placeholder="Tìm theo mã đơn, người đặt...">
                                </div>
                            </div>

                        </div>
                        <div id="orderTableContainer">
                            @include('admins.donhangs.donhang-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchOrders(url = null) {
            let trangThaiDonHang = $('#trang_thai_don_hang').val();
            let trangThaiThanhToan = $('#trang_thai_thanh_toan').val();
            let keyword = $('#searchDonHang').val();

            url = url || "{{ route('donhangs.index') }}";

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    trang_thai_don_hang: trangThaiDonHang,
                    trang_thai_thanh_toan: trangThaiThanhToan,
                    keyword: keyword
                },
                beforeSend: function() {
                    $('#orderTableContainer').html('<p>Đang tải...</p>');
                },
                success: function(data) {
                    $('#orderTableContainer').html(data);

                    if (trangThaiDonHang === '0' || trangThaiDonHang === '1' || trangThaiDonHang === '2') {
                        $('.checkbox-wrapper').show();
                    } else {
                        $('.checkbox-wrapper').hide();
                    }
                },
                error: function() {
                    alert('Không thể tải dữ liệu. Vui lòng thử lại!');
                }
            });
        }

        // Xử lý hiển thị nút bulk update khi checkbox được bật
        $(document).on('change', '.donhang-checkbox, #checkAll', function() {
            let anyChecked = $('.donhang-checkbox:checked').length > 0;
            $('#bulk-action-wrapper').toggle(anyChecked);
        });

        // Bắt sự kiện click nút cập nhật hàng loạt
        $(document).on('click', '#bulkUpdateBtn', function() {
            let selectedIds = $('.donhang-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            let newStatus = $('#bulkStatus').val();

            if (selectedIds.length === 0) {
                Swal.fire('Chú ý', 'Vui lòng chọn ít nhất một đơn hàng.', 'warning');
                return;
            }

            if (!newStatus) {
                Swal.fire('Chú ý', 'Vui lòng chọn trạng thái mới.', 'warning');
                return;
            }

            // Xác nhận trước khi gửi AJAX
            Swal.fire({
                title: 'Xác nhận cập nhật',
                text: `Bạn có chắc chắn muốn cập nhật ${selectedIds.length} đơn hàng này?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('donhangs.bulkUpdate') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: selectedIds,
                            trang_thai_don_hang: newStatus
                        },
                        success: function(res) {
                            Swal.fire({
                                title: "Cập nhật thành công",
                                text: res.message,
                                icon: "success"
                            });

                            fetchOrders(); // Tải lại danh sách
                            $('#checkAll').prop('checked', false);
                            $('#bulk-action-wrapper').hide();
                        },
                        error: function() {
                            Swal.fire('Lỗi', 'Đã xảy ra lỗi. Vui lòng thử lại.', 'error');
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            // Lọc theo trạng thái hoặc tìm kiếm
            $('#trang_thai_don_hang, #trang_thai_thanh_toan').on('change', function() {
                // Reset bulk update UI
                $('#bulk-action-wrapper').hide();
                $('#checkAll').prop('checked', false);

                fetchOrders();
            });

            $('#searchDonHang').on('input', function() {
                fetchOrders();
            });

            // Phân trang
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr('href');
                fetchOrders(pageUrl);
            });
        });

        function updateBulkStatusOptions() {
            const selectedStatus = $('#trang_thai_don_hang').val();
            const $bulkSelect = $('#bulkStatus');

            // Kích hoạt lại tất cả options trước
            $bulkSelect.find('option').prop('disabled', false);

            if (selectedStatus === '0') { // Chờ xác nhận
                $bulkSelect.find('option:not([value="1"]):not([value=""])').prop('disabled', true);
            } else if (selectedStatus === '1') { // Đang xử lý
                $bulkSelect.find('option:not([value="2"]):not([value=""])').prop('disabled', true);
            } else if (selectedStatus === '2') { // Đang giao
                $bulkSelect.find('option:not([value="3"]):not([value=""])').prop('disabled', true);
            } else {
                // Nếu chọn các trạng thái khác (hoặc không chọn gì), disable tất cả (trừ placeholder)
                $bulkSelect.find('option:not([value=""])').prop('disabled', true);
            }

            // Reset lại selection về placeholder
            $bulkSelect.val('');
        }

        // Gọi khi thay đổi trạng thái lọc
        $('#trang_thai_don_hang').on('change', function() {
            updateBulkStatusOptions();

            // Ẩn khu vực bulk nếu đang chọn checkbox
            $('#bulk-action-wrapper').hide();
            $('#checkAll').prop('checked', false);

            fetchOrders();
        });

        // Gọi một lần khi trang tải (để khớp trạng thái nếu có preset sẵn)
        $(document).ready(function() {
            updateBulkStatusOptions();
        });
    </script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
