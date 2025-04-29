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
        max-width: 400px;
    }

    form.d-flex button {
        white-space: nowrap;
    }

    #hideReasonModal .modal-dialog {
        display: flex;
        align-items: center;
        min-height: calc(100vh - 60px);
        margin: 0 auto;
    }

    .user-table td:nth-child(6) {
        white-space: normal;
        word-wrap: break-word;
        line-height: 1.5;
    }

    /* CSS cho modal và media */
    #mediaModal .modal-dialog {
        max-width: 600px;
        /* Tăng từ 500px lên 600px để đủ chỗ cho album */
    }

    #mediaModal .modal-body {
        padding: 20px;
        /* Đảm bảo padding đồng đều */
    }

    #mediaModal .album-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }

    #mediaModal .album-container img {
        width: 100px;
        /* Giữ nguyên kích thước thumbnail */
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border 0.3s;
    }

    #mediaModal .album-container img:hover,
    #mediaModal .album-container img.selected {
        border: 2px solid #007bff;
    }

    #mediaModal .large-image-container {
        text-align: center;
        margin-bottom: 20px;
    }

    #mediaModal .large-image-container img {
        max-width: 250px;
        /* Giữ kích thước ảnh lớn */
        height: auto;
        border-radius: 8px;
    }

    #mediaModal .video-container {
        text-align: center;
    }

    #mediaModal video {
        width: 250px;
        /* Giữ kích thước video */
        height: auto;
        border-radius: 8px;
    }

    .eye-icon {
        cursor: pointer;
        font-size: 20px;
        color: #007bff;
    }

    .eye-icon:hover {
        color: #0056b3;
    }

    .user-table {
        width: 100%;
        table-layout: fixed;
        /* Đảm bảo các cột có chiều rộng cố định */
    }

    .user-table th,
    .user-table td {
        padding: 6px;
        /* Giảm padding để tiết kiệm không gian */
        vertical-align: top;
        /* Căn chỉnh nội dung ở đầu ô */
        text-align: left;
        font-size: 14px;
        /* Giảm kích thước chữ để tiết kiệm không gian */
        word-wrap: break-word;
        /* Cho phép nội dung wrap */
        white-space: normal;
        /* Cho phép xuống dòng */
    }

    /* Đặt chiều rộng cụ thể cho từng cột */
    .user-table th:nth-child(1),
    .user-table td:nth-child(1) {
        /* Tên khách hàng */
        width: 12%;
    }

    .user-table th:nth-child(2),
    .user-table td:nth-child(2) {
        /* Tên sản phẩm */
        width: 15%;
    }

    .user-table th:nth-child(3),
    .user-table td:nth-child(3) {
        /* ID đơn hàng */
        width: 10%;
    }

    .user-table th:nth-child(4),
    .user-table td:nth-child(4) {
        /* Đánh giá */
        width: 12%;
    }

    .user-table th:nth-child(5),
    .user-table td:nth-child(5) {
        /* Nhận xét */
        width: 20%;
    }

    .user-table th:nth-child(6),
    .user-table td:nth-child(6) {
        /* Trạng thái (ẩn) */
        width: 0;
        display: none;
    }

    .user-table th:nth-child(7),
    .user-table td:nth-child(7) {
        /* Lý do ẩn */
        width: 15%;
    }

    .user-table th:nth-child(8),
    .user-table td:nth-child(8) {
        /* Hình ảnh/Video */
        width: 10%;
    }

    .user-table th:nth-child(9),
    .user-table td:nth-child(9) {
        /* Hành động */
        width: 10%;
    }

    /* Tăng chiều cao hàng để chứa nội dung wrap */
    .user-table tr {
        min-height: 60px;
        /* Đảm bảo đủ không gian cho nội dung wrap */
    }

    /* Đảm bảo bảng không cuộn ngang */
    .table-responsive {
        overflow-x: hidden;
        /* Ẩn thanh cuộn ngang */
    }

    /* Tùy chỉnh cho màn hình nhỏ hơn (mobile) */
    @media (max-width: 768px) {

        .user-table th,
        .user-table td {
            font-size: 12px;
            /* Giảm font size trên mobile */
            padding: 4px;
        }
    }

    .user-table td:nth-child(5),
    .user-table td:nth-child(7) {
        max-height: 80px;
        /* Giới hạn chiều cao */
        overflow-y: auto;
        /* Cho phép cuộn dọc trong ô */
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

                <!-- Form lọc theo sản phẩm, ngày và don_hang_id -->
                <form method="GET" action="{{ route('danhgias.index') }}" class="d-flex gap-2 mb-3 align-items-end">
                    <div class="form-group">
                        <label for="san_pham_id">Sản phẩm</label>
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
                    <div class="form-group">
                        <label for="start_date">Từ ngày</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Đến ngày</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                    <!-- Thêm trường tìm kiếm don_hang_id -->
                    <div class="form-group">
                        <label for="don_hang_id">ID đơn hàng</label>
                        <input type="text" name="don_hang_id" value="{{ request('don_hang_id') }}" class="form-control"
                            placeholder="Nhập id đơn hàng">
                    </div>
                    <!-- Kết thúc phần thêm -->
                    <button type="submit" class="btn btn-success">Lọc</button>
                    <a href="{{ route('danhgias.index') }}" class="btn btn-secondary" id="resetButton">Làm mới</a>
                </form>

                <!-- Modal chọn lý do ẩn -->
                <div class="modal fade" id="hideReasonModal" tabindex="-1" aria-labelledby="hideReasonModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hideReasonModalLabel">Chọn lý do ẩn đánh giá</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="hideReasonForm">
                                    <div class="mb-3">
                                        <label class="form-label">Vui lòng chọn ít nhất một lý do:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Nội dung không phù hợp">
                                            <label class="form-check-label">Nội dung không phù hợp</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Ngôn ngữ xúc phạm">
                                            <label class="form-check-label">Ngôn ngữ xúc phạm</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Thông tin sai lệch">
                                            <label class="form-check-label">Thông tin sai lệch</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Đánh giá không liên quan đến sản phẩm">
                                            <label class="form-check-label">Đánh giá không liên quan đến sản phẩm</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Nghi ngờ đánh giá giả mạo">
                                            <label class="form-check-label">Ảnh hoặc video không hợp lệ</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Vi phạm chính sách cộng đồng">
                                            <label class="form-check-label">Vi phạm chính sách cộng đồng</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reasons[]"
                                                value="Khác" id="otherReasonCheckbox">
                                            <label class="form-check-label">Khác</label>
                                        </div>
                                        <div id="otherReasonContainer" style="display: none;">
                                            <textarea id="otherReasonText" class="form-control mt-2" placeholder="Vui lòng nhập lý do cụ thể (tối đa 150 ký tự)"
                                                maxlength="150" rows="3"></textarea>
                                            <small class="text-muted">Còn lại <span id="charCount">150</span> ký
                                                tự</small>
                                        </div>
                                    </div>
                                    <div id="reasonError" class="text-danger" style="display: none;">Vui lòng chọn ít
                                        nhất một lý do!</div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-primary" id="confirmHideBtn">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal hiển thị hình ảnh và video -->
                <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediaModalLabel">Ảnh/Video</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Album ảnh dạng grid -->
                                <div class="album-container" id="albumImages">
                                    <!-- Thumbnail ảnh sẽ được thêm động bằng JS -->
                                </div>
                                <!-- Ảnh lớn khi bấm vào thumbnail -->
                                <div class="large-image-container" id="largeImageContainer">
                                    <p class="text-center">Chọn một ảnh để xem lớn</p>
                                </div>
                                <!-- Video -->
                                <div class="video-container" id="videoContainer">
                                    <!-- Video sẽ được thêm động bằng JS -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                                    <th>ID đơn hàng</th>
                                    <th>Đánh giá</th>
                                    <th>Nhận xét</th>
                                    <th style="display:none;">Trạng thái</th>
                                    <th>Lý do ẩn</th>
                                    <th>Ảnh/Video</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($danhGias->isEmpty() && !is_null($message))
                                    <tr>
                                        <td colspan="9" class="text-center" style="color: red;">{{ $message }}
                                        </td> <!-- Cập nhật colspan từ 8 thành 9 -->
                                    </tr>
                                @else
                                    @foreach ($danhGias as $danhGia)
                                        <tr>
                                            <td>{{ $danhGia->ten_nguoi_dung }}</td>
                                            <td>{{ $danhGia->ten_san_pham }}</td>
                                            <td>{{ $danhGia->don_hang_id ?? 'Không có' }}</td> <!-- Thêm cột này -->
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
                                            <td class="status-icon" style="display: none;">
                                                @if ($danhGia->trang_thai == 1)
                                                    <i class="ri-checkbox-circle-line text-success"></i>
                                                @else
                                                    <i class="ri-close-circle-line text-danger"></i>
                                                @endif
                                            </td>
                                            <td>{{ $danhGia->ly_do_an ?? 'Không có' }}</td>
                                            <td>
                                                <!-- Biểu tượng con mắt -->
                                                @php
                                                    $images = $danhGia->hinh_anh_danh_gia;
                                                    if (is_string($images)) {
                                                        $images = json_decode($images, true);
                                                    }
                                                    $images = !empty($images) && is_array($images) ? $images : [];
                                                    $video = $danhGia->video;
                                                @endphp
                                                @if (!empty($images) || !empty($video))
                                                    <i class="ri-eye-line eye-icon"
                                                        data-images='@json($images)'
                                                        data-video="{{ $video }}" data-bs-toggle="modal"
                                                        data-bs-target="#mediaModal"></i>
                                                @else
                                                    Không có
                                                @endif
                                            </td>
                                            <td>
                                                <button
                                                    class="toggleStatus btn btn-sm d-block mx-auto {{ $danhGia->trang_thai == 1 ? 'btn-danger' : 'btn-primary' }}"
                                                    data-id="{{ $danhGia->id }}">
                                                    {{ $danhGia->trang_thai == 1 ? 'Ẩn' : 'Hiện' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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

            // Xử lý trạng thái ẩn/hiện đánh giá
            function resetModal() {
                $('#hideReasonForm input[name="reasons[]"]').prop('checked', false);
                $('#otherReasonContainer').hide();
                $('#otherReasonText').val('');
                $('#charCount').text(150);
                $('#reasonError').hide();
            }

            $('#otherReasonCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#otherReasonContainer').show();
                } else {
                    $('#otherReasonContainer').hide();
                    $('#otherReasonText').val('');
                    $('#charCount').text(150);
                }
            });

            $('#otherReasonText').on('input', function() {
                let maxLength = 150;
                let currentLength = $(this).val().length;
                let remaining = maxLength - currentLength;
                $('#charCount').text(remaining);
                if (remaining < 0) {
                    $(this).val($(this).val().substring(0, maxLength));
                    $('#charCount').text(0);
                }
            });

            $(".toggleStatus").click(function() {
                let button = $(this);
                currentDanhGiaId = button.data("id");
                let isHideAction = button.hasClass('btn-danger');

                if (isHideAction) {
                    resetModal();
                    $('#hideReasonModal').modal('show');
                } else {
                    toggleDanhGiaStatus(button, currentDanhGiaId, []);
                }
            });

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

                let button = $(`.toggleStatus[data-id="${currentDanhGiaId}"]`);
                toggleDanhGiaStatus(button, currentDanhGiaId, reasons);
            });

            function toggleDanhGiaStatus(button, danhGiaId, reasons = []) {
                $.ajax({
                    url: "{{ route('danhgias.trangthaidanhgia') }}",
                    type: "POST",
                    data: {
                        id: danhGiaId,
                        reasons: reasons,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            let statusCell = button.closest("tr").find(".status-icon");
                            let lyDoAnCell = button.closest("tr").find("td:nth-child(7)");

                            if (response.status == 1) {
                                button.removeClass('btn-primary').addClass('btn-danger').text('Ẩn');
                                statusCell.html('<i class="ri-checkbox-circle-line text-success"></i>');
                                lyDoAnCell.html('Không có');
                            } else {
                                button.removeClass('btn-danger').addClass('btn-primary').text('Hiện');
                                statusCell.html('<i class="ri-close-circle-line text-danger"></i>');
                                let reasonsHtml = reasons.length > 0 ? reasons.map(reason =>
                                    `<div>${reason}</div>`).join('') : 'Không có';
                                lyDoAnCell.html(reasonsHtml);
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

            // Xử lý hiển thị hình ảnh và video trong modal
            $('.eye-icon').click(function() {
                const images = $(this).data('images') || [];
                const video = $(this).data('video') || '';

                // Xóa nội dung cũ trong modal
                $('#albumImages').empty();
                $('#largeImageContainer').empty();
                $('#videoContainer').empty();

                // Thêm hình ảnh vào album dạng grid
                if (images.length > 0) {
                    images.forEach((image, index) => {
                        const thumbnailHtml = `
                            <img src="{{ asset('storage') }}/${image}" alt="Hình ảnh ${index + 1}" data-index="${index}">
                        `;
                        $('#albumImages').append(thumbnailHtml);
                    });

                    // Xử lý bấm vào thumbnail để hiển thị ảnh lớn
                    $('#albumImages img').click(function() {
                        $('#albumImages img').removeClass('selected');
                        $(this).addClass('selected');
                        const src = $(this).attr('src');
                        const largeImageHtml = `
                            <img src="${src}" alt="Ảnh lớn">
                        `;
                        $('#largeImageContainer').html(largeImageHtml);
                    });

                    // Hiển thị ảnh đầu tiên mặc định
                    $('#albumImages img').first().click();
                } else {
                    $('#albumImages').html('<p class="text-center">Không có hình ảnh</p>');
                    $('#largeImageContainer').html('<p class="text-center">Chọn một ảnh để xem lớn</p>');
                }

                // Thêm video
                if (video) {
                    const extension = video.split('.').pop().toLowerCase();
                    if (['mp4', 'webm', 'ogg'].includes(extension)) {
                        const videoHtml = `
                            <video id="modalVideo" controls>
                                <source src="{{ asset('storage') }}/${video}" type="video/${extension}">
                                Trình duyệt của bạn không hỗ trợ video.
                            </video>
                        `;
                        $('#videoContainer').html(videoHtml);
                    } else {
                        $('#videoContainer').html(
                            '<p class="text-center">Không hỗ trợ định dạng video</p>');
                    }
                } else {
                    $('#videoContainer').html('<p class="text-center">Không có video</p>');
                }
            });
        });
    </script>
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
