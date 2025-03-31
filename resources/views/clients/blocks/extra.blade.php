<style>
      .number-input {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f8f8;
            border-radius: 8px;
            padding: 5px;
            width: 120px;
        }

        .number-input button {
            background: none;
            border: none;
            /* cursor: pointer; */
            font-size: 20px;
            color: #008080;
            padding: 5px;
        }

        .number-input input {
            width: 40px;
            text-align: center;
            border: none;
            background: none;
            font-size: 18px;
        }

        .number-input input:focus {
            outline: none;
        }

.option {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ddd;
    color: #333;
    font-size: 14px;
    /* font-weight: bold; */
    cursor: pointer;
    margin: 5px;
    transition: all 0.3s ease-in-out;
}

.option:hover {
    border-color: #0da487;
}

.option.selected {
    background-color: #0da487;
    color: white;
    border-color: #0da487;
}
</style>
<!-- Quick View Modal Box Start -->
<div class="modal fade theme-modal view-modal" id="view" tabindex="-1">
    <form id="form-cart-post" >
        @csrf
        <input type="hidden" name="id_bienthe" id="id_bienthe">

        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name"></h4>
                                <div style="display: flex">
                                    <h4 class="gia_moi" style="color: #0da487"></h4>
                                    <del class="gia_cu" style="margin-left: 20px"></del>
                                </div>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class=""></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class=""></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class=""></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class=""></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class=""></i>
                                        </li>
                                    </ul>
                                    <span class="danh_gia ms-2">8 Reviews</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Mô tả</h4>
                                    <p class="mo_ta"></p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Danh mục:</h5>
                                            <h6 class="danh_muc"></h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="variant-section"></div>

                                <span style="margin-top: 5px" class="so_luong"></span>

                                <h5 style="margin-top: 5px; font-weight: 600" >Số lượng:</h5>
                                <div style="margin-top: 5px" class="number-input">
                                    <button onclick="decreaseValue()">−</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1">
                                    <button onclick="increaseValue()">+</button>
                                </div>


                                <div class="modal-button">
                                    <button type="submit" id="addToCartBtn"
                                            class="btn btn-md add-cart-button icon" disabled>
                                        Thêm vào giỏ hàng
                                    </button>
                                    <button type="button" id="btnChiTiet"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        Xem chi tiết</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Quick View Modal Box End -->

<!-- Cookie Bar Box Start -->
{{-- <div class="cookie-bar-box">
    <div class="cookie-box">
        <div class="cookie-image">
            <img src="../assets/client/images/cookie-bar.png" class="blur-up lazyload" alt="">
            <h2>Cookies!</h2>
        </div>

        <div class="cookie-contain">
            <h5 class="text-content">We use cookies to make your experience better</h5>
        </div>
    </div>

    <div class="button-group">
        <button class="btn privacy-button">Privacy Policy</button>
        <button class="btn ok-button">OK</button>
    </div>
</div> --}}
<!-- Cookie Bar Box End -->

<!-- Deal Box Modal Start -->
<div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title w-100" id="deal_today">Top sản phẩm hôm nay</h5>
                    <p class="mt-1 text-content">Giới thiệu cho bạn những sản phẩm hot hôm nay.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="deal-offer-box">
                    <ul class="deal-offer-list">
                        @foreach ($topOrderProducts as $index => $item)
                        <li class="list-{{ ++$index }}">
                            <div class="deal-offer-contain">
                                <div>
                                    <a href="{{ route('sanphams.chitiet',$item->sanPham->id) }}" class="deal-image">
                                        <img src="{{ Storage::url($item->sanPham->hinh_anh) ?? 'images/sanpham-default.png' }}" class="blur-up lazyload"
                                            alt="">
                                    </a>
                                </div>

                                <div style="min-width: 220px">
                                    <a href="{{ route('sanphams.chitiet',$item->sanPham->id) }}" class="deal-contain">
                                        <h5>{{ $item->sanPham->ten_san_pham }}</h5>
                                        <h6>{{ number_format($item->sanPham->gia_moi,0,'','.') }}đ
                                        <del>{{ number_format($item->sanPham->gia_cu,0,'','.') }}đ</del> </h6>
                                    </a>
                                </div>
                                <div>
                                    <h6>{{ number_format($item->total_quantity,0,'','.') }} sản phẩm</h6>
                                </div>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Deal Box Modal End -->

<!-- Tap to top button start -->
<div class="theme-option">
    <div class="back-to-top">
        <a id="back-to-top" href="#">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
</div>
<!-- Tap to top button end -->

<!-- Add address modal box start -->
<div class="modal fade theme-modal" id="add-address" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
                        <label for="fname">First Name</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
                        <label for="lname">Last Name</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                        <label for="email">Email Address</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="address" style="height: 100px"></textarea>
                        <label for="address">Enter Address</label>
                    </div>
                </form>

                <form>
                    <div class="form-floating mb-4 theme-form-floating">
                        <input type="email" class="form-control" id="pin" placeholder="Enter Pin Code">
                        <label for="pin">Pin Code</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Add address modal box end -->

<!-- Edit Profile Start -->
@if (isset($user))
<form id="myForm" action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Chỉnh sửa thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-12">

                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control @error('ten_nguoi_dung') is-invalid @enderror" name="ten_nguoi_dung"
                                    id="pname" value="{{ $user->ten_nguoi_dung ?? '' }}">
                                    <label for="pname">Họ và tên</label>
                                </div>
                                @error('ten_nguoi_dung')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                        </div>

                        <div class="col-xxl-6">

                                <div class="form-floating theme-form-floating">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email1" name="email"
                                        value="{{ $user->email ?? ''}}">
                                    <label for="email1">Địa chỉ email</label>
                                </div>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>

                        <div class="col-xxl-6">

                                <div class="form-floating theme-form-floating">
                                    <input class="form-control @error('so_dien_thoai') is-invalid @enderror" type="tel" value="{{ $user->so_dien_thoai ?? ''}}"
                                     name="so_dien_thoai" id="mobile" maxlength="10"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                    <label for="mobile">Số điện thoại</label>
                                </div>
                                @error('so_dien_thoai')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>

                        <div class="col-12">

                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control @error('dia_chi') is-invalid @enderror" id="address1"
                                        name="dia_chi" value="{{ $user->dia_chi ?? ''}}">
                                    <label for="address1">Địa chỉ</label>
                                </div>
                                @error('dia_chi')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                        </div>

                        {{-- <div class="col-12">

                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address2" value="CA 94080">
                                    <label for="address2">Add Address 2</label>
                                </div>

                        </div> --}}
                        @if (isset($user))
                        <div class="col-xxl-4">

                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect" name="gioi_tinh">
                                        <option selected>Chọn Giới tính</option>
                                        <option {{ ($user->gioi_tinh == 1 ? 'selected' : '') }} value="1">Nam</option>
                                        <option {{ ($user->gioi_tinh == 0 ? 'selected' : '') }} value="0">Nữ</option>
                                    </select>
                                    <label for="floatingSelect">Giới tính</label>
                                </div>

                        </div>
                        @endif

                        <div class="col-xxl-4">
                                <div class="form-floating theme-form-floating">
                                    <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" id="address3"
                                    value="{{ $user->ngay_sinh }}" name="ngay_sinh">
                                    <label for="address3">Ngày sinh</label>
                                </div>
                                @error('ngay_sinh')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="col-xxl-4">
                                <div class="form-floating theme-form-floating">
                                    <input type="file" class="form-control @error('anh_dai_dien') is-invalid @enderror"
                                    id="address3" name="anh_dai_dien">
                                    <label for="address3">Ảnh đại diện</label>
                                </div>
                                @error('anh_dai_dien')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Lưu thay đổi</button>

                </div>
            </div>
        </div>
    </div>
</form>

@endif

<!-- Edit Profile End -->

<!-- Edit Card Start -->
<div class="modal fade theme-modal" id="editCard" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel8">Edit Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-xxl-6">
                        <form>
                            <div class="form-floating theme-form-floating">
                                <input type="text" class="form-control" id="finame" value="Mark">
                                <label for="finame">First Name</label>
                            </div>
                        </form>
                    </div>

                    <div class="col-xxl-6">
                        <form>
                            <div class="form-floating theme-form-floating">
                                <input type="text" class="form-control" id="laname" value="Jecno">
                                <label for="laname">Last Name</label>
                            </div>
                        </form>
                    </div>

                    <div class="col-xxl-4">
                        <form>
                            <div class="form-floating theme-form-floating">
                                <select class="form-select" id="floatingSelect12">
                                    <option selected>Card Type</option>
                                    <option value="kingdom">Visa Card</option>
                                    <option value="states">MasterCard Card</option>
                                    <option value="fra">RuPay Card</option>
                                    <option value="china">Contactless Card</option>
                                    <option value="spain">Maestro Card</option>
                                </select>
                                <label for="floatingSelect12">Card Type</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-animation btn-md fw-bold"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Update Card</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Card End -->

<!-- Remove Profile Modal Start -->
<div class="modal fade theme-modal remove-profile" id="removeProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <p>The permission for the use/group, preview is inherited from the object, object will create a
                        new permission for this object</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                    data-bs-target="#removeAddress" data-bs-toggle="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade theme-modal remove-profile" id="removeAddress" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box text-center">
                    <h4 class="text-content">It's Removed.</h4>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $("#myForm").submit(function(e) {
        e.preventDefault(); // Ngăn reload trang

        let formData = new FormData(this);
        formData.append("_method", "PUT"); // Laravel yêu cầu thêm _method=PUT khi gửi bằng POST

        $.ajax({
            url: $(this).attr("action"),
            type: "POST", // Laravel không hỗ trợ AJAX PUT, phải dùng POST
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $(".text-danger").remove(); // Xóa lỗi cũ
                $("#editProfile").modal("hide"); // Đóng modal
                location.reload(); // Tải lại trang để thấy cập nhật mới
            },
            error: function(xhr) {
                $(".text-danger").remove(); // Xóa lỗi cũ

                let errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(field, messages) {
                        let input = $(`[name="${field}"]`);
                        let errorHtml = `<p class="text-danger">${messages[0]}</p>`;

                        input.after(errorHtml); // Hiển thị lỗi dưới input
                    });
                }
            }
        });
    });
});

</script>

<script>
$(document).ready(function () {
    let selectedAttributes = {}; // Lưu thuộc tính đã chọn
    let bienTheList = []; // Lưu danh sách biến thể
    let matchedVariant = null; // Biến toàn cục để lưu biến thể phù hợp

    // Xử lý khi bấm vào nút "Xem nhanh"
    $(".btn-quick-view").click(function () {
        let productId = $(this).data("id");

        $.ajax({
            url: 'http://127.0.0.1:8000/quick-view?id=' + productId,
            method: 'GET',
            success: function (response) {
                // Reset dữ liệu khi mở modal mới
                selectedAttributes = {};
                bienTheList = response.bien_the;
                matchedVariant = null;

                // Cập nhật thông tin sản phẩm
                $('#view .title-name').text(response.ten_san_pham);
                $('#view .slider-image img').attr('src', response.hinh_anh);
                $('#view .danh_muc').text(response.danh_muc);
                $('#view .mo_ta').text(response.mo_ta);
                $('#view .danh_gia').text(response.danh_gia + ' lượt đánh giá');
                $('#view .gia_moi').text(response.gia_moi + ' đ');
                $('#view .gia_cu').text(response.gia_cu + ' đ');

                document.getElementById("btnChiTiet").addEventListener("click", function() {
                    location.href = '/sanpham/' + response.id;
                });

                // Hiển thị số sao đánh giá
                let so_sao = response.so_sao;
                $('#view .rating li svg').css({'fill': 'none', 'stroke': '#ffc107'});
                $('#view .rating li').each(function (index) {
                    if (index < so_sao) {
                        $(this).find('svg').css({'fill': '#ffc107', 'stroke': '#ffc107'});
                    }
                });

                // Gom nhóm thuộc tính từ biến thể
                let thuocTinhMap = {};
                response.bien_the.forEach(bienThe => {
                    bienThe.thuoc_tinh_gia_tri.forEach(thuocTinh => {
                        if (!thuocTinhMap[thuocTinh.ten]) {
                            thuocTinhMap[thuocTinh.ten] = new Set();
                        }
                        thuocTinhMap[thuocTinh.ten].add(thuocTinh.gia_tri);
                    });
                });

                // Hiển thị danh sách thuộc tính
                let thuocTinhHtml = "";
                Object.keys(thuocTinhMap).forEach(tenThuocTinh => {
                    thuocTinhHtml += `<h4>${tenThuocTinh}</h4>`;
                    thuocTinhHtml += `<div id="thuoc_tinh_${tenThuocTinh.replace(/\s+/g, '_')}" class="thuoc-tinh-group">`;
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
            error: function () {
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
        let isMatch = Object.keys(selectedAttributes).length > 0; // Đảm bảo có thuộc tính được chọn

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
            $("#addToCartBtn").prop("disabled", true);  // Khóa nút
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
    $("#view").on("hidden.bs.modal", function () {
        selectedAttributes = {}; // Xóa thuộc tính đã chọn
        bienTheList = []; // Xóa danh sách biến thể
        matchedVariant = null; // Reset biến thể
        $(".variant-section").html(""); // Xóa giao diện thuộc tính
        $(".option").removeClass("selected"); // Bỏ chọn option cũ
        $("#view .gia_moi").text("Chọn thuộc tính để xem giá"); // Reset giá
        $("#view .so_luong").text("Số lượng: --"); // Reset số lượng
        $("#view .slider-image img").attr("src", "/storage/uploads/sanphams/default.png"); // Reset ảnh
        $("#quantity").val(1).attr("max", ""); // Reset số lượng về mặc định
    });


});
// add-cart-button
</script>
<script>
$(document).ready(function () {
    $("#form-cart-post").submit(function (event) {
        event.preventDefault();

        let bienTheId = $("#id_bienthe").val();
        if (!bienTheId) {
            Swal.fire('Lỗi', 'Vui lòng chọn biến thể trước khi thêm vào giỏ hàng!', 'warning');
            return;
        }

        let formData = $(this).serialize();

        $.ajax({
            url: '/post-giohang',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
    console.log("Cart response:", response); // Kiểm tra dữ liệu

    if (response.cart) {
        $(".header-wishlist .badge").text(response.cart.totalItem);
        $(".total-price").text(response.cart.totalPrice.toLocaleString("vi-VN") + " đ");

        let cartListHtml = '';
        let itemsToShow = response.cart.items.slice(0, 4); // Giới hạn chỉ lấy 4 sản phẩm đầu tiên

        itemsToShow.forEach(item => {
            cartListHtml += `
                <li style="width: 100%" class="product-box-contain">
                    <div class="drop-cart">
                        <a href="/sanpham/${item.id}" class="drop-image">
                            <img src="${item.image}" class="blur-up lazyload" alt="">
                        </a>
                        <div class="drop-contain">
                            <a href="/sanpham/${item.id}">
                                <h5>${item.name}</h5>
                                <h6>${item.name_bienthe}</h6>
                            </a>
                            <h6><span>${item.quantity} x</span> ${item.price.toLocaleString("vi-VN")} đ</h6>
                            <button class="close-button close_button delete-cart-item" data-id="${item.id_cart}">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </li>`;
        });

        $(".cart-list").html(cartListHtml); // Cập nhật danh sách sản phẩm

        // Nếu số lượng sản phẩm lớn hơn 4, hiển thị "Xem thêm..."
        if (response.cart.items.length > 4) {
            $(".cart-list").append('<li class="text-center"><a href="giohang">Xem thêm...</a></li>');
        }
    }

    $.notify({
        icon: "fa fa-check",
        title: "Sản phẩm đã được thêm vào giỏ hàng.",
    }, {
        element: "body",
        type: "Thành công",
        placement: { from: "top", align: "right" },
        delay: 10,
        z_index: 9999,
        animate: { enter: "animated fadeInDown faster", exit: "animated fadeOutUp faster" },
        showDuration: 100,  // Hiển thị nhanh (mặc định là 400-600ms)
        hideDuration: 200,
        template: '<div class="alert alert-success" style="background-color:#1abc9c; color:white; border-color:#16a085; padding: 10px; border-radius: 5px;">' +
                '<strong><i class="fa fa-check"></i> {0}</strong> {1}' +
                '</div>'
    });
},
            error: function(xhr) {
                if (xhr.status === 403 && xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                    Swal.fire('Lỗi', errorMessage,'error');
                }else{
                    console.log("AJAX error:", xhr.responseText);
                    Swal.fire('Lỗi', 'Bạn chưa đăng nhập!','error');
                }

            }
        });

    });
});
$(document).on("click", ".delete-cart-item", function () {
    let cartItemId = $(this).data("id"); // Lấy ID sản phẩm trong giỏ hàng

    $.ajax({
        url: "/xoa-gio-hang", // Route xử lý xóa sản phẩm
        method: "POST",
        data: { id: cartItemId },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log("Response từ server:", response); // Debug dữ liệu
            if (response.status === "success") {
                $(".header-wishlist .badge").text(response.totalItem); // Cập nhật số sản phẩm

                // Xóa sản phẩm khỏi giao diện
                $(`.delete-cart-item[data-id="${cartItemId}"]`).closest("li").remove();

                // Cập nhật lại tổng tiền
            let total = 0;
            let totalItem = response.totalItem;
            let totalPrice = response.totalPrice;
            $(".cart-list li").each(function () {
                let text = $(this).find("h6").text();
                let matches = text.match(/(\d+)\s*x\s*([\d\.]+)/);

                if (matches) {
                    let soLuong = parseInt(matches[1]);  // Số lượng
                    let giaBan = parseInt(matches[2].replace(/\./g, "")); // Giá (loại bỏ dấu chấm)

                    total += soLuong * giaBan;
                }
            });

            $(".header-wishlist .badge").text(totalItem);
            // Cập nhật tổng tiền
            $(".total-price").text(totalPrice.toLocaleString("vi-VN") + " đ");
            } else {
                Swal.fire("Lỗi", "Không thể xóa sản phẩm", "error");
            }
        },
        error: function () {
            Swal.fire("Lỗi", "Bạn chưa đăng nhập!", "error");
        },
    });
});
</script>
