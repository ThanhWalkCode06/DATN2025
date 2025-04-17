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
<style>
        form.d-flex input {
            max-width: 350px;
        }

        form.d-flex button {
            white-space: nowrap;
        }

        /* Thêm CSS để căn giữa modal */
        #hideReasonModal .modal-dialog {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 60px); /* Đảm bảo căn giữa theo chiều dọc */
            margin: 0 auto; /* Căn giữa theo chiều ngang */
        }
    </style>
@section('content')
    <div class="col-sm-12">
        <div class="card card-table">   
            <!-- Table Start -->
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Đánh giá sản phẩm</h5>
                </div>
                
                <!-- Form lọc theo sản phẩm -->
                <form method="GET" action="{{ route('danhgias.index') }}" class="d-flex gap-2 mb-3">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tìm theo tên người đặt hoặc sản phẩm">
                    <button type="submit" class="btn btn-success">Tìm Kiếm</button>
                </form>
                
                <div class="modal fade" id="hideReasonModal" tabindex="-1" aria-labelledby="hideReasonModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hideReasonModalLabel">Chọn lý do ẩn đánh giá</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="hideReasonForm">
                                    <div class="mb-3">
                                        <label class="form-label">Vui lòng chọn ít nhất một lý do:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Nội dung không phù hợp">
                                            <label class="form-check-label">Nội dung không phù hợp</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Ngôn ngữ xúc phạm">
                                            <label class="form-check-label">Ngôn ngữ xúc phạm</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Thông tin sai lệch">
                                            <label class="form-check-label">Thông tin sai lệch</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Đánh giá không liên quan đến sản phẩm">
                                            <label class="form-check-label">Đánh giá không liên quan đến sản phẩm</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Nghi ngờ đánh giá giả mạo">
                                            <label class="form-check-label">Nghi ngờ đánh giá giả mạo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Vi phạm chính sách cộng đồng">
                                            <label class="form-check-label">Vi phạm chính sách cộng đồng</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]" value="Khác" id="otherReasonCheckbox">
                                            <label class="form-check-label">Khác</label>
                                        </div>
                                        <div id="otherReasonContainer" style="display: none;">
                                            <textarea id="otherReasonText" class="form-control mt-2" placeholder="Vui lòng nhập lý do cụ thể (tối đa 150 ký tự)" maxlength="150" rows="3"></textarea>
                                            <small class="text-muted">Còn lại <span id="charCount">150</span> ký tự</small>
                                        </div>
                                    </div>
                                    <div id="reasonError" class="text-danger" style="display: none;">Vui lòng chọn ít nhất một lý do!</div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-primary" id="confirmHideBtn">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th>Lý do ẩn</th> <!-- Thêm cột mới -->
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
                                                <i class="ri-checkbox-circle-line text-success"></i>
                                            @else
                                                <i class="ri-close-circle-line text-danger"></i>
                                            @endif
                                        </td>
                                        <td>{{ $danhGia->ly_do_an ?? 'Không có' }}</td> <!-- Hiển thị lý do ẩn -->
                                        <td>
                                            <button
                                                class="toggleStatus btn btn-sm d-block mx-auto {{ $danhGia->trang_thai == 1 ? 'btn-danger' : 'btn-primary' }}"
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
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            let currentDanhGiaId = null;

            // Hàm reset trạng thái modal
            function resetModal() {
                // Xóa trạng thái chọn của tất cả checkbox
                $('#hideReasonForm input[name="reasons[]"]').prop('checked', false);
                // Ẩn và xóa nội dung textarea "Khác"
                $('#otherReasonContainer').hide();
                $('#otherReasonText').val('');
                $('#charCount').text(150); // Reset bộ đếm ký tự về 150
                // Ẩn thông báo lỗi nếu có
                $('#reasonError').hide();
            }

            // Hiển thị/ẩn textarea khi checkbox "Khác" được chọn
            $('#otherReasonCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#otherReasonContainer').show();
                } else {
                    $('#otherReasonContainer').hide();
                    $('#otherReasonText').val(''); // Xóa nội dung textarea khi bỏ chọn
                    $('#charCount').text(150); // Reset bộ đếm ký tự về 150
                }
            });

            // Đếm ký tự trong textarea
            $('#otherReasonText').on('input', function() {
                let maxLength = 150; // Giới hạn mới là 150
                let currentLength = $(this).val().length;
                let remaining = maxLength - currentLength;
                $('#charCount').text(remaining);
                if (remaining < 0) {
                    $(this).val($(this).val().substring(0, maxLength));
                    $('#charCount').text(0);
                }
            });

            // Khi click nút Ẩn hoặc Hiện
            $(".toggleStatus").click(function() {
                let button = $(this);
                currentDanhGiaId = button.data("id");
                let isHideAction = button.hasClass('btn-danger'); // Nút "Ẩn" có class btn-danger

                if (isHideAction) {
                    // Reset trạng thái modal trước khi hiển thị
                    resetModal();
                    // Hiển thị modal chọn lý do
                    $('#hideReasonModal').modal('show');
                } else {
                    // Nếu là nút "Hiện", thực hiện ngay
                    toggleDanhGiaStatus(button, currentDanhGiaId, []);
                }
            });

            // Khi click nút Xác nhận trong modal
            $('#confirmHideBtn').click(function() {
                let reasons = [];
                $('#hideReasonForm input[name="reasons[]"]:checked').each(function() {
                    let reason = $(this).val();
                    if (reason === 'Khác') {
                        let otherReason = $('#otherReasonText').val().trim();
                        if (otherReason) {
                            reasons.push('Khác: ' + otherReason);
                        } else {
                            reasons.push('Khác');
                        }
                    } else {
                        reasons.push(reason);
                    }
                });

                if (reasons.length === 0) {
                    $('#reasonError').show();
                    return;
                }

                $('#reasonError').hide();
                $('#hideReasonModal').modal('hide');

                // Gửi yêu cầu ẩn đánh giá cùng với lý do
                let button = $(`.toggleStatus[data-id="${currentDanhGiaId}"]`);
                toggleDanhGiaStatus(button, currentDanhGiaId, reasons);
            });

            // Hàm gửi yêu cầu thay đổi trạng thái
            function toggleDanhGiaStatus(button, danhGiaId, reasons = []) {
                $.ajax({
                    url: "{{ route('danhgias.trangthaidanhgia') }}",
                    type: "POST",
                    data: {
                        id: danhGiaId,
                        reasons: reasons, // Gửi danh sách lý do
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            let statusCell = button.closest("tr").find(".status-icon");
                            let lyDoAnCell = button.closest("tr").find("td:nth-child(6)"); // Cột lý do ẩn

                            if (response.status == 1) {
                                button.removeClass('btn-primary').addClass('btn-danger').text('Ẩn');
                                statusCell.html('<i class="ri-checkbox-circle-line text-success"></i>');
                                lyDoAnCell.text('Không có'); // Xóa lý do khi hiện
                            } else {
                                button.removeClass('btn-danger').addClass('btn-primary').text('Hiện');
                                statusCell.html('<i class="ri-close-circle-line text-danger"></i>');
                                lyDoAnCell.text(reasons.join(', ')); // Hiển thị lý do khi ẩn
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert("Lỗi khi cập nhật trạng thái.");
                    }
                });
            }
        });
    </script>

    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection