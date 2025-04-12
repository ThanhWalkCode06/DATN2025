@extends('layouts.client')

@section('title')
    Sản phẩm
@endsection

@section('css')
    <style>
        .category-list-box {
            transition: all 0.3s ease-in-out;
            border-radius: 5px;
            padding: 5px;
        }

        .category-list-box:hover {
            background-color: #17a589;
            transform: scale(1.05);
            cursor: pointer;
        }

        .category-list-box:hover .name {
            font-weight: bold;
            color: white;
        }

        .product-option {
            list-style: none;
            display: flex;
            justify-content: center;
            /* Căn giữa các biểu tượng */
            align-items: center;
            gap: 10px;
            /* Giảm khoảng cách giữa hai biểu tượng */
            padding: 5px 10px;
            /* Tạo padding hợp lý */
        }

        .product-option li {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            /* Chia đều khoảng cách giữa các mục */
        }

        .product-option a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-option i {
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .product-option a:hover i {
            color: #1abc9c;
        }

        #clearAllFilters {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        #clearAllFilters:hover {
            background: linear-gradient(135deg, #ff4b2b);
            transform: translateY(-3px);
        }
    </style>
@endsection

@section('breadcrumb')
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Sản phẩm</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('sanphams.danhsach') }}">
                                        <i class="fa-solid fa-box"></i>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-3 wow fadeInUp">
                    <div class="left-box">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>

                            <div class="accordion custom-accordion" id="accordionExample">
                                <div class="selected-filters mt-4 text-center">
                                    <strong class="text-dark fs-4 d-block">Bộ lọc đã chọn</strong>
                                    <div id="selectedFilters" class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                                    </div>
                                    <a href="{{ route('sanphams.danhsach') }}" id="clearAllFilters" style="display: none;">
                                        <i class="fas fa-trash-alt"></i> Bỏ hết
                                    </a>
                                </div>

                                {{-- DANH MỤC --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>Danh mục</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            @if ($danhMucs->isNotEmpty())
                                                <ul class="category-list custom-padding custom-height" id="category-list">
                                                    @foreach ($danhMucs as $danhMuc)
                                                        <li>
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input class="checkbox_animated d-none filter-input"
                                                                    type="radio" name="danh_muc_id"
                                                                    value="{{ $danhMuc->id }}"
                                                                    id="danhmuc-{{ $danhMuc->id }}"
                                                                    {{ request('danh_muc_id') == $danhMuc->id ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                    for="danhmuc-{{ $danhMuc->id }}"
                                                                    style="cursor: pointer;">
                                                                    {{ $danhMuc->ten_danh_muc }}
                                                                    <span class="badge bg-success text-white ms-2">
                                                                        {{ $danhMuc->san_phams_count }} sản phẩm
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>Không có danh mục nào có sản phẩm.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- GIÁ --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree">
                                            <span>Giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            @foreach ([['0-100000', 'Giá dưới 100.000đ'], ['100000-200000', '100.000đ - 200.000đ'], ['200000-300000', '200.000đ - 300.000đ'], ['300000-500000', '300.000đ - 500.000đ'], ['500000-1000000', '500.000đ - 1.000.000đ'], ['1000000-999999999', 'Giá trên 1.000.000đ']] as [$value, $label])
                                                <div class="form-check">
                                                    <input class="form-check-input filter-input" type="radio"
                                                        name="price_range" value="{{ $value }}"
                                                        id="price-{{ $loop->index }}">
                                                    <label class="form-check-label" for="price-{{ $loop->index }}">
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>



                                {{-- ĐÁNH GIÁ --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix">
                                            <span>Đánh giá</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                @foreach ([5, 4, 3, 2, 1] as $i)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated d-none filter-input"
                                                                type="radio" name="so_sao" value="{{ $i }}"
                                                                id="so_sao-{{ $i }}"
                                                                {{ request('so_sao') == $i ? 'checked' : '' }}>

                                                            <label class="form-check-label"
                                                                for="so_sao-{{ $i }}" style="cursor: pointer;">
                                                                <ul class="rating">
                                                                    @for ($j = 1; $j <= 5; $j++)
                                                                        <li>
                                                                            <i
                                                                                class="fa fa-star {{ $j <= $i ? 'text-warning' : 'text-secondary' }}"></i>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                                <span class="text-content">
                                                                    ({{ $i == 5 ? '5 sao' : $i . '.0 - ' . $i . '.9 sao' }})
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- SẢN PHẨM + SẮP XẾP --}}
                <div class="col-custom- wow fadeInUp">
                    <div class="show-button">
                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Sắp xếp theo :</h5>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown">
                                        <span id="sort-label">
                                            @php
                                                $sortText = match (request('sort')) {
                                                    'Giá thấp - cao' => 'Giá thấp - cao',
                                                    'Giá cao - thấp' => 'Giá cao - thấp',
                                                    'Giảm giá % cao - thấp' => 'Giảm giá % cao - thấp',
                                                    default => 'Sắp xếp',
                                                };
                                            @endphp
                                            {{ $sortText }}
                                        </span>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item sort-option" href="javascript:void(0)"
                                                data-value="Giá thấp - cao">Giá thấp - cao</a></li>
                                        <li><a class="dropdown-item sort-option" href="javascript:void(0)"
                                                data-value="Giá cao - thấp">Giá cao - thấp</a></li>
                                        <li><a class="dropdown-item sort-option" href="javascript:void(0)"
                                                data-value="Giảm giá % cao - thấp">Giảm giá % cao - thấp</a></li>
                                    </ul>
                                    <input type="hidden" name="sort" id="sort-hidden" value="{{ request('sort') }}"
                                        class="filter-input">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PHẦN HIỂN THỊ SẢN PHẨM --}}
                    <div id="product-list-container">
                        @include('clients.sanphams.sanpham_list', ['sanPhams' => $sanPhams])


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            function formatCurrencyVND(value) {
                return new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND"
                }).format(value);
            }

            function formatPriceRange(value) {
                let [min, max] = value.split("-").map(Number);
                if (max >= 999999999) return `Giá trên ${formatCurrencyVND(min)}`;
                if (min === 0) return `Giá dưới ${formatCurrencyVND(max)}`;
                return `${formatCurrencyVND(min)} - ${formatCurrencyVND(max)}`;
            }

            const filterNames = {
                "danh_muc_id": {
                    "1": "Áo Hoodio",
                    "2": "Thời Trang",
                    "3": "Thể thao",
                    "4": "Áo"
                },
                "so_sao": {
                    "5": "(5 sao)",
                    "4": "(4 sao)",
                    "3": "(3 sao)",
                    "2": "(2 sao)",
                    "1": "(1 sao)"
                }
            };

            function updateSelectedFiltersUI(params) {
                const selectedFiltersContainer = $("#selectedFilters");
                const clearAllFilters = $("#clearAllFilters");
                selectedFiltersContainer.html("");
                let hasFilter = false;

                for (const key in params) {
                    if (!params[key]) continue;
                    let displayName = "";

                    if (key === "price_range") {
                        const ranges = params[key].split(',');
                        displayName = ranges.map(r => formatPriceRange(r)).join(", ");
                    } else {
                        displayName = filterNames[key]?.[params[key]] || params[key];
                    }

                    const tag = $(`
                    <span class="badge text-white px-3 py-2 d-flex align-items-center me-2 mb-2" style="background-color:#17a589;">
                        <span class="me-2">${displayName}</span>
                        <span class="remove-filter" data-key="${key}" style="cursor:pointer;">✖</span>
                    </span>
                `);

                    selectedFiltersContainer.append(tag);
                    hasFilter = true;
                }

                clearAllFilters.toggle(hasFilter);
            }

            function fetchFilteredProducts(page = 1) {
                let query = $('input[name="query"]').val();
                let danh_muc_id = $('input[name="danh_muc_id"]:checked').val();
                let price_range = $('input[name="price_range"]:checked').val();
                let so_sao = $('input[name="so_sao"]:checked').val();
                let sort = $('#sort-hidden').val();

                let params = {
                    query,
                    danh_muc_id,
                    price_range,
                    so_sao,
                    sort,
                    page
                };

                $.ajax({
                    url: "{{ route('sanphams.danhsach') }}?page=" + page,
                    type: "GET",
                    data: params,
                    success: function(response) {
                        $('#product-list-container').html(response.html);
                        feather.replace();
                        $('[data-bs-toggle="tooltip"]').tooltip();

                        const cleanParams = {
                            ...params
                        };
                        delete cleanParams.page;
                        history.pushState(null, '', buildUrl(cleanParams));
                        updateSelectedFiltersUI(cleanParams);
                    },
                    error: function() {
                        alert("Lỗi khi tải sản phẩm!");
                    }
                });
            }

            function buildUrl(params) {
                const url = new URL(window.location.href);
                url.search = '';
                for (const key in params) {
                    if (params[key]) {
                        url.searchParams.set(key, params[key]);
                    }
                }
                return url.pathname + '?' + url.searchParams.toString();
            }

            // ===== Sự kiện lọc, phân trang =====
            $(document).on('click', '.sort-option', function() {
                const sortValue = $(this).data('value');
                $('#sort-hidden').val(sortValue);
                $('#sort-label').text(sortValue);
                fetchFilteredProducts(1);
            });

            $(document).on('change', '.filter-input', function() {
                fetchFilteredProducts(1);
            });

            $(document).on('input', 'input[name="query"]', function() {
                fetchFilteredProducts(1);
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                fetchFilteredProducts(page);
            });

            $('#clearAllFilters').on('click', function(e) {
                e.preventDefault();
                $('input[type=radio], input[type=checkbox]').prop('checked', false);
                $('input[name="query"]').val('');
                $('#sort-hidden').val('');
                $('#sort-label').text('Sắp xếp');
                fetchFilteredProducts(1);
            });

            $(document).on("click", ".remove-filter", function() {
                const key = $(this).data("key");

                if (key === "price_range") {
                    $('input[name="price_range"]').prop('checked', false);
                } else {
                    $(`input[name="${key}"]`).prop('checked', false);
                }

                if (key === "query") {
                    $('input[name="query"]').val('');
                }

                if (key === "sort") {
                    $('#sort-hidden').val('');
                    $('#sort-label').text('Sắp xếp');
                }

                fetchFilteredProducts(1);
            });

            // ===== Xem nhanh sản phẩm (modal) =====
            $(document).on('click', '.btn-quick-view', function() {
                const id = $(this).data('id');
                $("#modal-content-detail").html(
                    '<div class="text-center text-muted">Đang tải dữ liệu...</div>');

                $.ajax({
                    url: url: 'http://127.0.0.1:8000/quick-view?id=' + id,
                    method: "GET",
                    success: function(response) {
                        $("#modal-content-detail").html(response);
                    },
                    error: function() {
                        $("#modal-content-detail").html(
                            '<div class="text-danger text-center">Lỗi khi tải dữ liệu sản phẩm!</div>'
                        );
                    }
                });
            });

            // ===== Khôi phục bộ lọc từ URL =====
            const urlParams = new URLSearchParams(window.location.search);
            const selectedPrice = urlParams.get("price_range");
            if (selectedPrice) {
                $('input[name="price_range"]').each(function() {
                    if ($(this).val() === selectedPrice) {
                        $(this).prop('checked', true);
                    }
                });
            }

            // ===== Xử lý wishlist =====
            function showToast(message, type = 'success') {
                const toast = $('#custom-toast');
                const toastInner = $('#toast-inner');
                const toastIcon = $('#toast-icon');
                const toastMessage = $('#toast-message');

                let bgClass = 'alert-success';
                let iconHtml = '<i class="fas fa-check-circle"></i>';

                if (type === 'error' || type === 'danger') {
                    bgClass = 'alert-danger';
                    iconHtml = '<i class="fas fa-exclamation-circle"></i>';
                } else if (type === 'warning') {
                    bgClass = 'alert-warning';
                    iconHtml = '<i class="fas fa-exclamation-triangle"></i>';
                }

                // Reset class và icon
                toastInner
                    .removeClass('alert-success alert-danger alert-warning')
                    .addClass(bgClass);

                toastIcon.html(iconHtml);
                toastMessage.text(message);
                toast.fadeIn(200);

                setTimeout(() => {
                    toast.fadeOut(400);
                }, 3000);
            }


            $(document).on('click', '.notifi-wishlist', function(e) {
                e.preventDefault();

                const $btn = $(this);
                const $form = $btn.closest('li').find('.wishlist-form');
                const action = $form.attr('action');
                const token = $form.find('input[name="_token"]').val();

                $.ajax({
                    url: action,
                    method: 'POST',
                    data: {
                        _token: token
                    },
                    success: function(res) {
                        showToast(res.message || 'Đã thêm vào yêu thích!');
                        $btn.find('i').addClass('text-danger');
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            showToast("Bạn cần đăng nhập để sử dụng chức năng này!", 'error');
                        } else {
                            const res = xhr.responseJSON;
                            showToast(res?.message || 'Đã xảy ra lỗi!', 'warning');
                        }
                    }
                });
            });

            // ===== Load mặc định =====
            fetchFilteredProducts(1);
        });
    </script>

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
@endsection
