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
                        <tbody>
                            @foreach($phieuGiamGias as $phieuGiamGia)
                            <tr>
                                <td>{{ $phieuGiamGia->ten_phieu }}</td>
                                <td>{{ $phieuGiamGia->ma_phieu }}</td>
                                <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_bat_dau)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_ket_thuc)) }}</td>
                                <td class="theme-color">{{ $phieuGiamGia->gia_tri }}%</td>
                                <td class="menu-status">
                                    @if($phieuGiamGia->trang_thai == 1)
                                    <span class="badge bg-success">Kích hoạt</span>
                                    @else
                                    <span class="badge bg-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li>
                                            <a href="{{ route('phieugiamgias.edit', $phieuGiamGia->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="confirmDelete(event, '{{ $phieuGiamGia->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>

                                            <form id="delete-form-{{ $phieuGiamGia->id }}" action="{{ route('phieugiamgias.destroy', $phieuGiamGia->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $phieuGiamGias->links("pagination::bootstrap-5") }}
            </div>


        </div>
    </div>
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