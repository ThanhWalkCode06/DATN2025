@if ($sanPhams->isEmpty())
    <div class="text-center mt-4">
        <h4 style="color: red">Không có sản phẩm nào phù hợp với bộ lọc</h4>
        <p>Hãy thử thay đổi tiêu chí lọc để tìm kiếm sản phẩm phù hợp.</p>
    </div>
@else
    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
        @foreach ($sanPhams as $sanPham)
            <div>
                <div class="product-box-3 h-100 wow fadeInUp">
                    <div class="product-header">
                        @if ($sanPham->gia_cu > $sanPham->giaThapNhatCuaSP())
                            <span class="badge bg-danger">
                                -{{ $sanPham->phanTramGiamGia() }}%
                            </span>
                        @endif
                        <div class="product-image text-center" style="max-width: 250px;">
                            <a href="{{ route('sanphams.chitiet', $sanPham->id) }}">
                                <img src="{{ Storage::url($sanPham->hinh_anh) }}" class="img-fluid rounded shadow-sm"
                                    alt="{{ $sanPham->ten_san_pham }}">
                            </a>
                            <ul class="product-option">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết">
                                    <a href="{{ route('sanphams.chitiet', ['id' => $sanPham['id']]) }}">
                                        <i data-feather="eye"></i>
                                    </a>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Yêu thích">
                                    <a href="#" class="notifi-wishlist" data-id="{{ $sanPham['id'] }}">
                                        <i data-feather="heart"></i>
                                    </a>
                                    <form action="{{ route('add.wishlist', $sanPham['id']) }}" method="POST"
                                        class="wishlist-form">
                                        @csrf
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="product-detail">
                            <span class="span-name">{{ $sanPham->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</span>
                            <a href="{{ route('sanphams.chitiet', $sanPham->id) }}">
                                <h5 class="name">{{ $sanPham->ten_san_pham }}</h5>
                            </a>
                            <p class="text-content mt-1 mb-2 product-content">{{ $sanPham->mo_ta }}
                            </p>
                            <div class="product-rating mt-2">
                                <ul class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            <i data-feather="star"
                                                class="{{ $i <= $sanPham->tinhDiemTrungBinh() ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span>({{ number_format($sanPham->tinhDiemTrungBinh(), 1) }} /
                                    5)</span>
                                <span class="text-muted">({{ $sanPham->soLuongDanhGia() }} đánh
                                    giá)</span>
                            </div>
                            <h5 class="price">

                                <span class="theme-color">
                                    {{ number_format($sanPham->giaThapNhatCuaSP(), 0, ',', '.') }} ₫
                                </span>
                                <del>{{ number_format($sanPham->gia_cu, 0, ',', '.') }} ₫</del>

                            </h5>
                            <div class="add-to-cart-box bg-white">
                                <button class="btn btn-add-cart addcart-button">
                                    @if ($sanPham['trang_thai'] == 1)
                                        <a class="btn-quick-view" style="margin-right: 10px;" href="javascript:void(0)"
                                            data-bs-toggle="modal" data-bs-target="#view"
                                            data-id="{{ $sanPham['id'] }}">
                                            <span class="add-icon bg-light-gray">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </span> Thêm vào giỏ hàng
                                        </a>
                                    @endif
                                </button>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif


@if ($sanPhams->hasPages())
    <nav class="custom-pagination">
        <ul class="pagination justify-content-center">
            {{-- Nút "Trang đầu" --}}
            <li class="page-item {{ $sanPhams->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $sanPhams->url(1) }}">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
            </li>

            {{-- Các trang --}}
            @foreach ($sanPhams->links()->elements[0] as $page => $url)
                <li class="page-item {{ $sanPhams->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Nút "Trang cuối" --}}
            <li class="page-item {{ $sanPhams->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $sanPhams->url($sanPhams->lastPage()) }}">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </li>
        </ul>
    </nav>
@endif

<div id="custom-toast" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
    <div id="toast-inner" class="alert d-flex align-items-center" role="alert"
        style="margin-bottom: 0; border-radius: 8px; padding: 12px 16px;">
        <i id="toast-icon" class="me-2"></i>
        <span id="toast-message" class="fw-semibold"></span>
    </div>
</div>

<script>
    $(document).ready(function() {
        let selectedAttributes = {}; // Lưu thuộc tính đã chọn
        let bienTheList = []; // Lưu danh sách biến thể
        let matchedVariant = null; // Biến toàn cục để lưu biến thể phù hợp

        // Xử lý khi bấm vào nút "Xem nhanh"
        $(".btn-quick-view").click(function() {
            let productId = $(this).data("id");

            $.ajax({
                url: 'http://127.0.0.1:8000/quick-view?id=' + productId,
                method: 'GET',
                success: function(response) {
                    // Reset dữ liệu khi mở modal mới
                    selectedAttributes = {};
                    bienTheList = response.bien_the;
                    matchedVariant = null;

                    // Cập nhật thông tin sản phẩm
                    $('#view .title-name').text(response.ten_san_pham);
                    $('#view .slider-image img').attr('src', response.hinh_anh);
                    $('#view .danh_muc').text(response.danh_muc);
                    $('#view .mo_ta').html(response.mo_ta);

                    $('#view .danh_gia').text(response.danh_gia + ' lượt đánh giá');
                    $('#view .gia_moi').text(response.gia_moi + ' đ');
                    $('#view .gia_cu').text(response.gia_cu + ' đ');

                    document.getElementById("btnChiTiet").addEventListener("click",
                        function() {
                            location.href = '/sanpham/' + response.id;
                        });

                    // Hiển thị số sao đánh giá
                    let so_sao = response.so_sao;
                    $('#view .rating li svg').css({
                        'fill': 'none',
                        'stroke': '#ffc107'
                    });
                    $('#view .rating li').each(function(index) {
                        if (index < so_sao) {
                            $(this).find('svg').css({
                                'fill': '#ffc107',
                                'stroke': '#ffc107'
                            });
                        }
                    });

                    // Gom nhóm thuộc tính từ biến thể
                    let thuocTinhMap = {};
                    response.bien_the.forEach(bienThe => {
                        bienThe.thuoc_tinh_gia_tri.forEach(thuocTinh => {
                            if (!thuocTinhMap[thuocTinh.ten]) {
                                thuocTinhMap[thuocTinh.ten] = new Set();
                            }
                            thuocTinhMap[thuocTinh.ten].add(thuocTinh
                                .gia_tri);
                        });
                    });

                    // Hiển thị danh sách thuộc tính
                    let thuocTinhHtml = "";
                    Object.keys(thuocTinhMap).forEach(tenThuocTinh => {
                        thuocTinhHtml += `<h4>${tenThuocTinh}</h4>`;
                        thuocTinhHtml +=
                            `<div id="thuoc_tinh_${tenThuocTinh.replace(/\s+/g, '_')}" class="thuoc-tinh-group">`;
                        thuocTinhMap[tenThuocTinh].forEach(giaTri => {
                            thuocTinhHtml += `
                            <span class="option" data-thuoc-tinh="${tenThuocTinh}" data-gia-tri="${giaTri}">
                                ${giaTri}
                            </span>
                        `;
                        });
                        thuocTinhHtml += `</div>`;
                    });

                    $('.variant-section').html(thuocTinhHtml); // Thêm thuộc tính vào UI
                },
                error: function() {
                    // alert('Không tìm thấy sản phẩm!');
                }
            });
        });

        // Xử lý khi chọn thuộc tính
        $(document).on("click", ".option", function() {
            let thuocTinh = $(this).data("thuoc-tinh");
            let giaTri = $(this).data("gia-tri");

            // Cập nhật giá trị thuộc tính đã chọn
            selectedAttributes[thuocTinh] = giaTri;

            // Bỏ chọn tất cả option cùng nhóm
            $(`.option[data-thuoc-tinh='${thuocTinh}']`).removeClass("selected");
            $(this).addClass("selected");

            // Cập nhật ảnh và giá biến thể
            updateVariantImage();
        });

        // Hàm cập nhật ảnh và giá dựa trên biến thể được chọn
        function updateVariantImage() {
            matchedVariant = null; // Đặt lại biến thể phù hợp

            bienTheList.forEach(variant => {
                let isMatch = Object.keys(selectedAttributes).length >
                    0; // Đảm bảo có thuộc tính được chọn

                variant.thuoc_tinh_gia_tri.forEach(attr => {
                    if (selectedAttributes[attr.ten] !== attr.gia_tri) {
                        isMatch = false;
                    }
                });

                if (isMatch) {
                    matchedVariant = variant;
                }
            });

            if (matchedVariant) {
                $("#view .slider-image img").attr("src", matchedVariant.anh_bien_the);
                $("#view .gia_moi").text(matchedVariant.gia_ban + ' đ');
                $("#view .so_luong").text("Tồn kho: " + matchedVariant.so_luong);
                $("#quantity").val(1).attr("max", matchedVariant.so_luong); // Cập nhật max quantity

                // Kiểm tra tồn kho để khóa/mở nút "Thêm vào giỏ hàng"
                if (matchedVariant.so_luong > 0) {
                    $("#addToCartBtn").prop("disabled", false); // Mở khóa nút
                } else {
                    $("#addToCartBtn").prop("disabled", true); // Khóa nút
                }
            } else {
                $("#view .slider-image img").attr("src", "/storage/uploads/sanphams/default.png");
                $("#view .gia_moi").text("Chọn thuộc tính để xem giá");
                $("#view .so_luong").text("Tồn kho: ");
                $("#quantity").val(1).attr("max", ""); // Xóa giới hạn khi chưa chọn biến thể

                $("#addToCartBtn").prop("disabled", true); // Khóa nút nếu chưa chọn biến thể
            }

            if (matchedVariant) {
                $("#id_bienthe").val(matchedVariant.id); // Cập nhật ID biến thể
            } else {
                $("#id_bienthe").val(""); // Xóa ID nếu chưa chọn đầy đủ
            }
        }


        // Chặn nhập số vượt quá tồn kho
        $("#quantity").on("input", function() {
            let input = $(this);
            let value = parseInt(input.val(), 10) || 1;

            let maxQuantity = matchedVariant ? matchedVariant.so_luong : Infinity;

            if (isNaN(value) || value < 1) {
                input.val(1);
            } else if (value > maxQuantity) {
                input.val(maxQuantity); // Chặn vượt số lượng tồn kho
            }
        });

        // Nút tăng số lượng
        function increaseValue() {
            event.preventDefault();
            let input = $("#quantity");
            let value = parseInt(input.val(), 10) || 1;
            let maxQuantity = matchedVariant ? matchedVariant.so_luong : Infinity;

            if (value < maxQuantity) {
                input.val(value + 1);
            }
        }

        // Nút giảm số lượng
        function decreaseValue() {
            event.preventDefault();
            let input = $("#quantity");
            let value = parseInt(input.val(), 10) || 1;

            if (value > 1) {
                input.val(value - 1);
            }
        }

        // Gán sự kiện nút tăng/giảm số lượng
        $(document).on("click", ".number-input button:first-child", decreaseValue);
        $(document).on("click", ".number-input button:last-child", increaseValue);

        // Reset dữ liệu khi đóng modal để tránh lỗi hiển thị sai
        $("#view").on("hidden.bs.modal", function() {
            selectedAttributes = {}; // Xóa thuộc tính đã chọn
            bienTheList = []; // Xóa danh sách biến thể
            matchedVariant = null; // Reset biến thể
            $(".variant-section").html(""); // Xóa giao diện thuộc tính
            $(".option").removeClass("selected"); // Bỏ chọn option cũ
            $("#view .gia_moi").text("Chọn thuộc tính để xem giá"); // Reset giá
            $("#view .so_luong").text("Số lượng: --"); // Reset số lượng
            $("#view .slider-image img").attr("src",
                "/storage/uploads/sanphams/default.png"); // Reset ảnh
            $("#quantity").val(1).attr("max", ""); // Reset số lượng về mặc định
        });


    });
    // add-cart-button
</script>
