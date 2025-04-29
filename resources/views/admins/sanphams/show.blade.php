@extends('layouts.admin')

@section('title', 'Chi Tiết Sản Phẩm')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Thêm CSS của Slick Slider -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        .product-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-custom {
            border-radius: 15px;
            padding: 20px;
        }

        .product-info h3 {
            font-size: 26px;
            font-weight: 700;
        }

        .product-info p {
            font-size: 18px;
            font-weight: 600;
        }

        .table thead {
            background-color: #f8f9fa;
            color: black;
            font-weight: bold;
        }

        .table tbody tr {
            background-color: #ffffff;
            color: black;
            font-weight: 600;
        }

        h2.text-primary {
            font-weight: 800;
        }

        h4.text-success {
            font-weight: 700;
        }

        .variant-container,
        .review-container {
            cursor: pointer;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .variant-container:hover,
        .review-container:hover {
            background-color: #e9ecef;
        }

        .variant-table,
        .review-table {
            display: none;
        }

        /* CSS cho bảng đánh giá */
        .review-table {
            width: 100%;
            table-layout: fixed;
        }

        .review-table th,
        .review-table td {
            padding: 6px;
            vertical-align: top;
            text-align: left;
            font-size: 14px;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Đặt chiều rộng cụ thể cho từng cột */
        .review-table th:nth-child(1),
        .review-table td:nth-child(1) {
            /* Người dùng */
            width: 12%;
        }

        .review-table th:nth-child(2),
        .review-table td:nth-child(2) {
            /* ID đơn hàng */
            width: 10%;
        }

        .review-table th:nth-child(3),
        .review-table td:nth-child(3) {
            /* Số sao */
            width: 15%;
        }

        .review-table th:nth-child(4),
        .review-table td:nth-child(4) {
            /* Nhận xét */
            width: 18%;
        }

        .review-table th:nth-child(5),
        .review-table td:nth-child(5) {
            /* Biến thể */
            width: 10%;
        }

        .review-table th:nth-child(6),
        .review-table td:nth-child(6) {
            /* Trạng thái (ẩn) */
            width: 0;
            display: none;
        }

        .review-table th:nth-child(7),
        .review-table td:nth-child(7) {
            /* Lý do ẩn */
            width: 15%;
        }

        .review-table th:nth-child(8),
        .review-table td:nth-child(8) {
            /* Ảnh/Video */
            width: 7%;
        }

        .review-table th:nth-child(9),
        .review-table td:nth-child(9) {
            /* Hành động */
            width: 15%;
        }
        
        
        /* Giới hạn chiều cao và thêm cuộn dọc cho cột nhận xét và lý do ẩn */
        .review-table td:nth-child(4),
        .review-table td:nth-child(7) {
            max-height: 80px;
            overflow-y: auto;
        }

        /* Tăng chiều cao hàng */
        .review-table tr {
            min-height: 60px;
        }

        /* Đảm bảo bảng không cuộn ngang */
        .table-responsive {
            overflow-x: hidden;
        }

        .review-table th,
        .review-table td {
            text-align: center;
        }

        /* Căn giữa nội dung cho tất cả các cột trong bảng biến thể */
        .variant-table th,
        .variant-table td {
            text-align: center;
        }

        .review-table td {
            vertical-align: middle;
            text-align: center;
            /* Nếu bạn cũng muốn căn giữa ngang */
        }

        /* Căn giữa nội dung theo chiều dọc và ngang trong các ô td của bảng biến thể */
        .variant-table td {
            vertical-align: middle;
            text-align: center;
            /* Nếu bạn cũng muốn căn giữa ngang */
        }


        .review-table td:nth-child(4),
        .review-table td:nth-child(7) {
            text-align: left;
        }

        /* Tùy chỉnh cho màn hình nhỏ hơn (mobile) */
        @media (max-width: 768px) {

            .review-table th,
            .review-table td {
                font-size: 12px;
                padding: 4px;
            }
        }

        .text-secondary {
            color: black !important;
        }

        /* CSS cho slider */
        .album-slider {
            margin-top: 20px;
        }

        .album-slider .album-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
        }

        .slick-prev:before,
        .slick-next:before {
            color: #000;
        }

        .album-slider .slick-slide {
            margin: 0 5px;
        }

        .album-slider .slick-list {
            margin: 0 -5px;
        }

        #hideReasonModal .modal-dialog {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 60px);
            /* Đảm bảo căn giữa theo chiều dọc */
            margin: 0 auto;
            /* Căn giữa theo chiều ngang */
        }

        #mediaModal .modal-dialog {
            max-width: 600px;
        }

        #mediaModal .modal-body {
            padding: 20px;
        }

        #mediaModal .album-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        #mediaModal .album-container img {
            width: 100px;
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
            height: auto;
            border-radius: 8px;
        }

        #mediaModal .video-container {
            text-align: center;
        }

        #mediaModal video {
            width: 250px;
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
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center text-success mb-4">Chi Tiết Sản Phẩm</h2>
        <div class="card card-custom shadow-lg border-0">
            <div class="row g-4 align-items-center">
                <div class="col-md-5 text-center">
                    <img id="main-product-image" src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="product-image"
                        alt="{{ $sanPham->ten_san_pham }}">
                    <div class="album-slider mt-4">
                        <!-- Thêm ảnh chính vào slider -->
                        <div>
                            <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="album-img"
                                data-image="{{ asset('storage/' . $sanPham->hinh_anh) }}" alt="Ảnh chính">
                        </div>
                        <!-- Các ảnh phụ -->
                        @if ($sanPham->anhSP->isNotEmpty())
                            @foreach ($sanPham->anhSP as $anh)
                                <div>
                                    <img src="{{ asset('storage/' . $anh->link_anh_san_pham) }}" class="album-img"
                                        data-image="{{ asset('storage/' . $anh->link_anh_san_pham) }}" alt="Ảnh phụ">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-7 product-info">
                    <p class="text-secondary">Tên sản phẩm: {{ $sanPham->ten_san_pham }}
                    <p>
                    <p class="text-secondary">Giá: {{ number_format($sanPham->gia_cu) }} đ</p>
                    <p class="text-secondary">Mô tả: {!! nl2br($sanPham->mo_ta) !!}</p>
                </div>
            </div>
        </div>

        <div class="card card-custom mt-4 shadow-lg border-0">
            <div class="variant-container" onclick="toggleVariantTable()">
                <h4 class="text-success mb-0">Biến thể ▼</h4>
            </div>
            @if ($sanPham->bienThes->isNotEmpty())
                <div class="table-responsive variant-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên biến thể</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sanPham->bienThes as $bienThe)
                                <tr>
                                    <td class="text-center">
                                        @if ($bienThe->anh_bien_the)
                                            <img src="{{ asset('storage/' . $bienThe->anh_bien_the) }}"
                                                alt="{{ $bienThe->ten_bien_the }}" class="img-thumbnail" width="80">
                                        @else
                                            <span class="text-muted">Không có ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $bienThe->ten_bien_the }}</td>
                                    <td>{{ number_format($bienThe->gia_ban) }} VNĐ</td>
                                    <td>{{ $bienThe->so_luong }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Không có biến thể nào cho sản phẩm này.</p>
            @endif
        </div>

        <div class="card card-custom mt-4 shadow-lg border-0">
            <div class="review-container" onclick="toggleReviewTable()">
                <h4 class="text-success mb-0">Đánh giá ▼</h4>
            </div>

            <div class="px-3 py-2">
                <h4 class="text-success mb-3">Tìm kiếm đánh giá</h4>
                <div class="row g-3">
                    <!-- Lọc theo tên người dùng -->
                    <div class="col-md-4">
                        <label for="filter-user" class="form-label fw-bold">Tên người dùng:</label>
                        <input type="text" id="filter-user" class="form-control" placeholder="Nhập tên người dùng"
                            onkeyup="filterReviews()">
                    </div>
                    <!-- Lọc theo thời gian -->
                    <div class="col-md-4">
                        <label for="filter-date" class="form-label fw-bold">Thời gian:</label>
                        <input type="date" id="filter-date" class="form-control" onchange="filterReviews()">
                    </div>
                    <!-- Lọc theo ID đơn hàng -->
                    <div class="col-md-4">
                        <label for="filter-order-id" class="form-label fw-bold">ID đơn hàng:</label>
                        <input type="text" id="filter-order-id" class="form-control" placeholder="Nhập ID đơn hàng"
                            onkeyup="filterReviews()">
                    </div>
                    <!-- Lọc theo số sao (đã có sẵn) -->
                    <div class="col-md-4">
                        <label for="filter-sao" class="form-label fw-bold">Số sao:</label>
                        <select id="filter-sao" class="form-select" onchange="filterReviews()">
                            <option value="all">Tất cả</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} sao</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
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
                                        <label class="form-check-label">Nghi ngờ đánh giá giả mạo</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="reasons[]"
                                            value="Vi phạm chính sách cộng đồng">
                                        <label class="form-check-label">Vi phạm chính sách cộng đồng</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="reasons[]" value="Khác"
                                            id="otherReasonCheckbox">
                                        <label class="form-check-label">Khác</label>
                                    </div>
                                    <div id="otherReasonContainer" style="display: none;">
                                        <textarea id="otherReasonText" class="form-control mt-2" placeholder="Vui lòng nhập lý do cụ thể (tối đa 150 ký tự)"
                                            maxlength="150" rows="3"></textarea>
                                        <small class="text-muted">Còn lại <span id="charCount">150</span> ký tự</small>
                                    </div>
                                </div>
                                <div id="reasonError" class="text-danger" style="display: none;">Vui lòng chọn ít nhất
                                    một lý do!</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" id="confirmHideBtn">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
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
            @if ($sanPham->danhGias->isNotEmpty())
                <div class="table-responsive review-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Người dùng</th>
                                <th>ID đơn hàng</th>
                                <th>Số sao</th>
                                <th>Nhận xét</th>
                                <th>Biến thể</th>
                                <th style="display: none">Trạng thái</th>
                                <th>Lý do ẩn</th>
                                <th>Ảnh/video</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="review-table-body">
                            @include('admins.sanphams.partials.review_rows', [
                                'danhGias' => $sanPham->danhGias,
                            ])
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted px-3">Chưa có đánh giá nào cho sản phẩm này.</p>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // Khởi tạo Slick Carousel
            $('.album-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                dots: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            // Xử lý sự kiện thay đổi ảnh trong slider
            $('.album-slider').on('afterChange', function(event, slick, currentSlide) {
                var currentImage = $(slick.$slides[currentSlide]).find('img').attr('data-image');
                $('#main-product-image').attr('src', currentImage);
            });

            $('.album-slider .album-img').on('click', function() {
                var imageSrc = $(this).attr('data-image');
                $('#main-product-image').attr('src', imageSrc);
            });

            // Logic xử lý ẩn/hiện đánh giá với modal
            let currentDanhGiaId = null;

            // Hàm reset trạng thái modal
            function resetModal() {
                $('#hideReasonForm input[name="reasons[]"]').prop('checked', false);
                $('#otherReasonContainer').hide();
                $('#otherReasonText').val('');
                $('#charCount').text(150);
                $('#reasonError').hide();
            }

            // Hiển thị/ẩn textarea khi checkbox "Khác" được chọn
            $('#otherReasonCheckbox').change(function() {
                if ($(this).is(':checked')) {
                    $('#otherReasonContainer').show();
                } else {
                    $('#otherReasonContainer').hide();
                    $('#otherReasonText').val('');
                    $('#charCount').text(150);
                }
            });

            // Đếm ký tự trong textarea
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

            // Khi click nút Ẩn hoặc Hiện
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
                                lyDoAnCell.text('Không có');
                            } else {
                                button.removeClass('btn-danger').addClass('btn-primary').text('Hiện');
                                statusCell.html('<i class="ri-close-circle-line text-danger"></i>');
                                lyDoAnCell.html(reasons.join(
                                    '<br>')); // Hiển thị mỗi lý do trên một dòng
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

            // Xử lý thông báo Pusher cho ẩn và hiển thị bình luận
            var pusher = new Pusher("0ca5e8c271c25e1264d2", {
                cluster: "ap1",
                encrypted: true
            });

            var userId = {{ Auth::id() ?? 'null' }};
            if (userId !== 'null') {
                var channel = pusher.subscribe("comment-hidden-" + userId);

                // Hàm viết hoa chữ cái đầu
                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }

                // Xử lý sự kiện hide-comment (ẩn bình luận)
                channel.bind("hide-comment", function(data) {
                    const productName = data.product_name ? capitalizeFirstLetter(data.product_name) : '';
                    const productText = productName ? `<strong>Sản phẩm: ${productName}</strong>` : '';
                    const reasonText = data.reasons ? `<br><strong>Lý do:</strong> ${data.reasons}` : '';

                    $.notify({
                        title: "<strong>Thông báo từ hệ thống:</strong><br>",
                        message: `Bình luận ở ${productText} của bạn đã bị ẩn bởi quản trị viên.${reasonText}`
                    }, {
                        element: "body",
                        type: "danger",
                        allow_dismiss: true,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        delay: 5000,
                        z_index: 9999,
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp"
                        },
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert notify-alert-custom" role="alert">' +
                            '    <span data-notify="title">{1}</span>' +
                            '    <span data-notify="message">{2}</span>' +
                            '</div>'
                    });
                });

                // Xử lý sự kiện show-comment (hiển thị bình luận)
                channel.bind("show-comment", function(data) {
                    const productName = data.product_name ? capitalizeFirstLetter(data.product_name) : '';
                    const productText = productName ? `<strong>Sản phẩm: ${productName}</strong>` : '';

                    $.notify({
                        title: "<strong>Thông báo từ hệ thống:</strong><br>",
                        message: `Bình luận ở ${productText} của bạn đã được hiển thị lại bởi quản trị viên.`
                    }, {
                        element: "body",
                        type: "success",
                        allow_dismiss: true,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        delay: 5000,
                        z_index: 9999,
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp"
                        },
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert notify-alert-custom success" role="alert">' +
                            '    <span data-notify="title">{1}</span>' +
                            '    <span data-notify="message">{2}</span>' +
                            '</div>'
                    });
                });
            } else {
                console.log('Người dùng chưa đăng nhập, không thể đăng ký kênh Pusher');
            }
        });
        // Hàm toggle bảng biến thể
        function toggleVariantTable() {
            const variantTable = document.querySelector(".variant-table");
            variantTable.style.display = variantTable.style.display === "none" || variantTable.style.display === "" ?
                "block" : "none";
        }

        // Hàm toggle bảng đánh giá
        function toggleReviewTable() {
            const reviewTable = document.querySelector(".review-table");
            reviewTable.style.display = reviewTable.style.display === "none" || reviewTable.style.display === "" ? "block" :
                "none";
        }
    </script>
    <script>
        function filterReviews() {
            const userFilter = document.getElementById("filter-user").value;
            const dateFilter = document.getElementById("filter-date").value;
            const orderIdFilter = document.getElementById("filter-order-id").value;
            const saoFilter = document.getElementById("filter-sao").value;

            $.ajax({
                url: "{{ route('danhgias.search', $sanPham->id) }}",
                type: "GET",
                data: {
                    user: userFilter,
                    date: dateFilter,
                    order_id: orderIdFilter,
                    sao: saoFilter,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $("#review-table-body").html(response.html);
                    // Gắn lại sự kiện cho các nút toggleStatus
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
                },
                error: function() {
                    alert("Lỗi khi tìm kiếm đánh giá.");
                }
            });
        }
    </script>
    <script>
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
                    $('#videoContainer').html('<p class="text-center">Không hỗ trợ định dạng video</p>');
                }
            } else {
                $('#videoContainer').html('<p class="text-center">Không có video</p>');
            }
        });

        // Gắn lại sự kiện cho eye-icon sau khi tải lại bảng đánh giá
        $(document).on('click', '.eye-icon', function() {
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
                    $('#videoContainer').html('<p class="text-center">Không hỗ trợ định dạng video</p>');
                }
            } else {
                $('#videoContainer').html('<p class="text-center">Không có video</p>');
            }
        });
    </script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
