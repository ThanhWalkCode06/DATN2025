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
@section('css')
<style>
    .table-container {
        overflow-x: auto;
        /* Cho phép cuộn ngang nếu cần */
        max-width: 100%;
        /* Giữ bảng trong khung hình */
    }

    .table {
        table-layout: fixed;
        /* Cố định bố cục bảng */
        width: 100%;
        /* Đảm bảo bảng không vượt quá khung */
        border-collapse: collapse;
        /* Gộp viền để tiết kiệm không gian */
    }

    .table th,
    .table td {
        padding: 5px 10px;
        /* Giảm padding để bảng gọn hơn */
        font-size: 14px;
        /* Giảm kích thước chữ */
        white-space: nowrap;
        /* Tránh xuống dòng */
        overflow: hidden;
        /* Cắt nội dung dư thừa */
        text-overflow: ellipsis;
        /* Hiển thị "..." nếu nội dung quá dài */
    }

    .table th {
        font-weight: 600;
        /* Làm nổi bật tiêu đề */
    }

</style>
@endsection


@section('content')
<div class="col-sm-12">
    <div class="card card-table">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Danh sách phiếu giảm giá</h5>
                <div class="right-options"></div>
                <form class="d-inline-flex">
                    <a href="{{route('phieugiamgias.create')}}" class="align-items-center btn btn-theme d-flex">
                        <i data-feather="plus-square"></i>Thêm mới
                    </a>
                </form>
            </div>
            <div class="table-responsive table-product">
                <form id="searchForm" class="row g-3 align-items-center" method="get" action="{{ route('phieugiamgias-search') }}">
                    <!-- Phần tìm kiếm cơ bản -->
                    <div class="col-md-5">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Tìm kiếm tên phiếu" name="ten_phieu" value="">
                            <button type="submit" class="btn btn-theme btn-sm"><i data-feather="search"></i></button>
                            <button class="btn btn-primary btn-sm ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                                Tìm kiếm nâng cao
                            </button>
                        </div>
                    </div>

                    <!-- Phần bộ lọc nâng cao -->
                    <div class="col-12">
                        <div class="collapse" id="filterPanel">
                            <div class="card card-body mt-2">
                                <div class="row">

                                    @include('admins.filter.name',[
                                        'key1' => 'gia_tri_from',
                                        'key2' => 'gia_tri_to',
                                        'label1' => 'Giá trị từ',
                                        'label2' => 'Giá trị đến',
                                    ])

                                    @include('admins.filter.date',[
                                        'key1' => 'ngay_bat_dau_from',
                                        'label1' => 'Ngày bắt đầu từ',
                                    ])

                                    @include('admins.filter.date',[
                                        'key1' => 'ngay_ket_thuc_from',
                                        'label1' => 'Ngày kết thúc từ',
                                    ])

                                    @include('admins.filter.status',[
                                        'key' => 'trang_thai',
                                        'label' => 'Trạng thái',
                                        'options' =>
                                            [
                                                '' => '-- Tất cả --',
                                                1 => 'Kích hoạt',
                                                0 => 'Không Kích hoạt',
                                            ]
                                        ])
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <!-- Nút Reset Filter (chỉ reset các input filter) -->
                                        <button type="button" id="resetFilter" class="btn btn-primary btn-sm">
                                            <i data-feather="refresh-ccw"></i> Làm mới
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if(session('error-key'))
                    <p class="text-danger">{{ session('error-key') }}</p>
                @endif

            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Tên phiếu</th>
                                <th style="width: 10%;">Mã</th>
                                <th style="width: 15%;">Ngày bắt đầu</th>
                                <th style="width: 15%;">Ngày kết thúc</th>
                                <th style="width: 10%;">Giá trị</th>
                                <th style="width: 10%;">Trạng thái</th>
                                <th style="width: 15%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="voucher-list-body">
                            @include('admins.phieugiamgias.partials.list_rows', ['lists' => $phieuGiamGias])

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3 pagination-wrapper">
    {{ $phieuGiamGias->links("pagination::bootstrap-5") }}
</div>
@endsection

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@section('js')
<script>
    function confirmDelete(event, id) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: 'Hành động này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Có, xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit(); // Gửi form ẩn để xóa
            }
        });
    }
</script>

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
<script>
$(document).ready(function() {
    // Hàm tải dữ liệu
    function loadData(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#voucher-list-body').html(response.html);
                $('.pagination-wrapper').html(response.pagination);
                window.scrollTo({
                    top: 0,
                    behavior: 'instant'
                });
                // Cập nhật URL trình duyệt không reload
                history.pushState(null, null, url);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

    // Submit form lọc
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        let url = $(this).attr('action') + '?' + $(this).serialize();
        loadData(url);
    });

    // Xử lý click phân trang
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        loadData($(this).attr('href'));
    });

    // Reset filter
    $('#resetFilter').click(function() {
        $('#filterPanel input').val('');
        $('#filterPanel select').val('').trigger('change');
        $('#filterPanel input[type="date"]').val('').trigger('change');
        $('#searchForm').submit();
    });
});
</script>
