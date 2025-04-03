@extends('layouts.admin')

@section('title')
    Đánh giá
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
                <div class="title-header option-title">
                    <h5>Đánh giá sản phẩm</h5>
                </div>
                
                <!-- Form lọc theo sản phẩm -->
                <form method="GET" action="{{ route('danhgias.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="san_pham_id" class="form-control">
                                <option value="">Tất cả sản phẩm</option>
                                @foreach ($sanPhams as $sanPham)
                                    <option value="{{ $sanPham->id }}"
                                        {{ request('san_pham_id') == $sanPham->id ? 'selected' : '' }}>
                                        {{ $sanPham->ten_san_pham }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>
                
                <div>
                    <div class="table-responsive">
                        <table class="user-table ticket-table review-table theme-table table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đánh giá</th>
                                    <th>Nhận xét</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhGias as $danhGia)
                                    <tr>
                                        <td>{{ $danhGia->ten_nguoi_dung }}</td>
                                        <td>{{ $danhGia->ten_san_pham }}</td>
                                        <td>
                                            <ul class="rating">
                                                @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star theme-color"></i>
                                                    </li>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                                    <li>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </td>
                                        <td class="text-wrap">{{ $danhGia->nhan_xet }}</td>

                                        <td class="status-icon">
                                            @if ($danhGia->trang_thai == 1)
                                                <i class="ri-checkbox-circle-line text-success"></i> {{-- ✔️ màu xanh --}}
                                            @else
                                                <i class="ri-close-circle-line text-danger"></i> {{-- ❌ màu đỏ --}}
                                            @endif
                                        </td>
                                        <td>
                                            <button
                                                class="toggleStatus btn btn-sm {{ $danhGia->trang_thai == 1 ? 'btn-danger' : 'btn-primary' }}"
                                                data-id="{{ $danhGia->id }}">
                                                {{ $danhGia->trang_thai == 1 ? 'Ẩn' : 'Hiện' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Phân trang -->
                <div class="pagination-wrapper">
                    {{ $danhGias->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- Table End -->
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".toggleStatus").click(function() {
                let button = $(this);
                let danhGiaId = button.data("id");

                $.ajax({
                    url: "{{ route('danhgias.trangthaidanhgia') }}",
                    type: "POST",
                    data: {
                        id: danhGiaId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            let statusCell = button.closest("tr").find(".status-icon");

                            if (response.status == 1) {
                                button.removeClass('btn-primary').addClass('btn-danger').text(
                                    'Ẩn');
                                statusCell.html(
                                    '<i class="ri-checkbox-circle-line text-success"></i>');
                            } else {
                                button.removeClass('btn-danger').addClass('btn-primary').text(
                                    'Hiện');
                                statusCell.html(
                                    '<i class="ri-close-circle-line text-danger"></i>');
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert("Lỗi khi cập nhật trạng thái.");
                    }
                });
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
@endsection
