@extends('layouts.admin')

@section('title')
    Sản phẩm
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
    <style>
        label {

            display: none;

        }

        /* .table-product td:nth-child(6) {
            display: flex;
            justify-content: center;
            align-items: center;
        } */

        .btn-primary {
            background-color: purple !important;
            border-color: purple !important;
        }
        .all-package thead tr th {
            min-width: 50px;

        }
    </style>
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title d-sm-flex d-block">
                    <h5>Danh sách sản phẩm</h5>
                    <div class="right-options">
                        <ul>

                            <li>
                                <a class="btn btn-solid" href="{{ route('sanphams.create') }}">Thêm Mới</a>
                            </li>
                        </ul>
                        <br>
                        {{-- <form action="{{ route('sanphams.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Tìm kiếm theo tên hoặc mã sản phẩm" value="{{ request('search') }}">
                                <button class="btn btn-solid btn-sm" type="submit">Tìm kiếm</button>
                            </div>
                        </form> --}}

                    </div>
                </div>
                <div class="table-responsive table-product">
                    <form id="searchForm" class="row g-3 align-items-center" method="get"
                        action="{{ route('sanphams-search') }}">
                        <!-- Phần tìm kiếm cơ bản -->
                        <div class="col-md-5">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Tìm kiếm tên sản phẩm"
                                    name="ten_san_pham" value="">
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
                                        @include('admins.filter.relationship', [
                                            'key' => 'danh_muc_id',
                                            'label' => 'Danh mục',
                                            'modelClass' => App\Models\SanPham::class,
                                            'relation' => 'danhMuc',
                                            'column' => 'ten_danh_muc',
                                        ])

                                        @include('admins.filter.status', [
                                            'key' => 'trang_thai',
                                            // 'label' => 'Trạng thái',
                                            'options' => [
                                                '' => '-- Tất cả --',
                                                1 => 'Còn hàng',
                                                0 => 'Hết hàng',
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
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table all-package theme-table table-product" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    {{-- <th>Biến thể</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="products-list-body">
                                @include('admins.sanphams.partials.list_rows', ['lists' => $sanPhams])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 pagination-wrapper">
            {{ $sanPhams->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
<script>
    $(document).ready(function() {
        // Hàm tải dữ liệu
        function loadData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#products-list-body').html(response.html);
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
