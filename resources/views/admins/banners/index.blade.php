@extends('layouts.admin')

@section('title')
    Quản lý Banner
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <style>
        .all-package thead tr th {
    white-space: nowrap;
    font-size: calc(13px + (16 - 13) * ((100vw - 320px) / (1920 - 320)));
    background-color: #f9f9f6;
    text-align: center;
    min-width: 0px !important;
    padding: 15px !important;
}
    </style>
@endsection

@section('content')

    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Danh sách Banner </h5>
                    <div class="row">
                        <div class="col-6">
                            <button class="action-btn " data-bs-toggle="modal" data-bs-target="#actionModal">
                                Hành động<i class="ri-arrow-down-s-line"></i>
                            </button>
                        </div>
                        <div class="col-6">
                            <a href="{{route('bannerAdmin.create')}}" class="align-items-center btn btn-theme d-flex">
                                <i data-feather="plus-square"></i>Thêm mới
                            </a>
                        </div>
                        
                    </div>
                </div>
                @include('admins.filter.modalActions', [
                    'fields' => [
                        [
                            'key' => 'status',
                            'label' => 'Trạng thái',
                            'options' => [
                                '' => '-- Tất cả --',
                                1 => 'Hoạt động',
                                0 => 'Ẩn',
                            ]
                        ]
                    ],
                    'dropdownParent' => '#actionModal'
                ])
                <div class="table-responsive table-product">

                    <div class="table-responsive table-product">
                    <form id="searchForm" class="row g-3 align-items-center" method="get"
                        action="{{ route('banners-search') }}">
                        <!-- Phần tìm kiếm cơ bản -->
                        <div class="col-md-5">
                            <div class="input-group">
                                {{-- <input class="form-control" type="text" placeholder="Tìm kiếm tên banner"
                                    name="ten_san_pham" value=""> --}}
                                <button type="submit" class="btn btn-theme btn-sm"><i data-feather="search"></i></button>
                                <button class="btn btn-theme btn-sm ms-2" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#filterPanel">
                                    Tìm kiếm nâng cao
                                </button>
                            </div>
                        </div>

                        <!-- Phần bộ lọc nâng cao -->
                        <div class="col-12">
                            <div class="collapse" id="filterPanel">
                                <div class="card card-body mt-2">
                                    <div class="row">
                                        @include('admins.filter.date', [
                                            'key1' => 'created_at_from',
                                            'key2' => 'created_at_to',
                                            'label1' => 'Tạo từ ngày',
                                            'label2' => 'Đến ngày',
                                        ])

                                        @include('admins.filter.status', [
                                            'key' => 'status',
                                            'options' => [
                                                '' => '-- Tất cả --',
                                                1 => 'Hoạt động',
                                                0 => 'Ẩn',
                                            ],
                                        ])
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-end">
                                            <!-- Nút Reset Filter (chỉ reset các input filter) -->
                                            <button type="button" id="resetFilter" class="btn btn-theme btn-sm">
                                                <i data-feather="refresh-ccw"></i> Làm mới
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (session('error-key'))
                        <p class="text-danger">{{ session('error-key') }}</p>
                    @endif

                </div>


                    <table class="table all-package theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th >
                                    <div class="check-box-contain">
                                        <span class="form-check user-checkbox">
                                            <input class="checkbox_animated checkall"
                                                type="checkbox" value="">
                                        </span>
                                        <span>STT</span>
                                    </div>
                                </th>
                                {{-- <th>Tên banner</th> --}}
                                <th>Vị trị hiển thị</th>
                                <th>Độ ưu tiên</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody id="banners-list-body">
                        @include('admins.banners.partials.list_rows')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 pagination-wrapper">
            {{ $lists->links('pagination::bootstrap-5') }}
    </div>
@endsection

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

      $(document).ready(function() {
        // Hàm tải dữ liệu
        function loadData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#banners-list-body').html(response.html);
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
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
