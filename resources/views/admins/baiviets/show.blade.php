@extends('layouts.admin')

@section('title')
    Bài viết
@endsection

@section('page-title')
    Chi tiết bài viết
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
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card card-table">
            <!-- Table Start -->
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="mt-3">
                            <label class="form-label">ID:</label>
                            <span>01</span>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Tiêu Đề bài viết:</label>
                            <span>Tin tức mới nhất</span>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Hình ảnh:</label>
                            <div>
                                <img src="https://aothudong.com/upload/product/atd-422/bo-ao-khoac-gio-nam-lot-long-den.jpg"
                                    alt="Hình ảnh tài khoản" class="img-thumbnail" width="150">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Danh Mục bài viết:</label>
                            <span>Tin tức mới nhất</span>
                        </div>
                        <div class="mt-3">
                            <label for="description" class="form-label fw-bold">Nội dung:</label>
                            <textarea id="description" class="form-control" rows="10">Cách làm sạch áo phao lông vũ không cần giặtKhông khí lạnh đã tràn về và nhiệt độ giảm mạnh, đã đến lúc phải mang áo phao trong tủ ra mặc.Áo phao lông vũ rất dễ bị ố và có mùi hôi khi mặc, đặc biệt là vào mùa đông lạnh giá những vấn đề này càng lộ rõ. Nhiều người giặt trong nước hoặc tốn tiền cho đi tiệm giặt khô.Song giặt khô hay giặt nước thường xuyên đều có thể ảnh hưởng đến độ ấm và vẻ ngoài của áo.Vậy chúng ta nên làm gì khi áo khoác ngoài bị bẩn? Có một mẹo rất đơn giản bạn nên áp dụng.</textarea>
                        </div>
                        <a href="{{ route('baiviets.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
