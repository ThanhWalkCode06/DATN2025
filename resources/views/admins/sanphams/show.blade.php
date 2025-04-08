@extends('layouts.admin')

@section('title', 'Chi Tiết Sản Phẩm')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <style>
        .product-image {
            max-width: 100%;
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
        .variant-container, .review-container {
            cursor: pointer;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .variant-container:hover, .review-container:hover {
            background-color: #e9ecef;
        }
        .variant-table, .review-table {
            display: none;
        }
        .text-secondary {
            color: black !important;
        }
        
        .album-img {  
            width: 100%; /* Đặt chiều rộng 100% */  
            height: 150px; /* Đặt chiều cao cố định */  
            object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */  
            border-radius: 10px; /* Để có góc bo tròn */  
        }  
    </style>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center text-success mb-4">Chi Tiết Sản Phẩm</h2>
    <div class="card card-custom shadow-lg border-0">
        <div class="row g-4 align-items-center">
            <div class="col-md-5 text-center">
                <img width="200px" src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="product-image" alt="{{ $sanPham->ten_san_pham }}">
                @if($sanPham->anhSP->isNotEmpty())  
                <div class="mt-4">  
                
                    <div class="row g-2 justify-content-center">  
                        @foreach($sanPham->anhSP as $anh)  
                            <div class="col-4 col-md-3 col-lg-3">  
                                <img src="{{ asset('storage/' . $anh->link_anh_san_pham) }}" class="album-img rounded shadow-sm" alt="Ảnh phụ">  
                            </div>  
                        @endforeach  
                    </div>  
                </div>  
            @endif  
            </div>
            <div class="col-md-7 product-info">
                <p class="text-secondary">Tên sản phẩm: {{ $sanPham->ten_san_pham }}<p>
                <p class="text-secondary">Giá: {{ number_format($sanPham->gia_cu) }} đ</p>
                <p class="text-secondary">Mô tả: {!! nl2br($sanPham->mo_ta) !!}</p>
            </div>
        </div>
    </div>

    <div class="card card-custom mt-4 shadow-lg border-0">
        <div class="variant-container" onclick="toggleVariantTable()">
            <h4 class="text-success mb-0">Biến thể ▼</h4>
        </div>
        @if($sanPham->bienThes->isNotEmpty())
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
                        @foreach($sanPham->bienThes as $bienThe)
                            <tr>
                                <td class="text-center">
                                    @if($bienThe->anh_bien_the)
                                        <img src="{{ asset('storage/' . $bienThe->anh_bien_the) }}" alt="{{ $bienThe->ten_bien_the }}" class="img-thumbnail" width="80">
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

    {{-- Đánh giá --}}
    <div class="card card-custom mt-4 shadow-lg border-0">
        <div class="review-container" onclick="toggleReviewTable()">
            <h4 class="text-success mb-0">Đánh giá ▼</h4>
        </div>
        
        <div class="px-3 py-2">
            <label for="filter-sao" class="form-label fw-bold">Lọc theo số sao:</label>
            <select id="filter-sao" class="form-select" onchange="filterReviews()">
                <option value="all">Tất cả</option>
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
        </div>

        @if($sanPham->danhGias->isNotEmpty())
            <div class="table-responsive review-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Người dùng</th>
                            <th>Số sao</th>
                            <th>Nhận xét</th>
                            <th>Biến thể</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="review-table-body">
                        @foreach($sanPham->danhGias as $danhGia)
                            <tr data-sao="{{ $danhGia->so_sao }}">
                                <td>{{ $danhGia->user->username ?? 'Ẩn danh' }}</td>
                                <td>
                                    @for($i = 0; $i < $danhGia->so_sao; $i++)
                                        ⭐
                                    @endfor
                                </td>
                                <td>{!! nl2br(e($danhGia->nhan_xet)) !!}</td>
                                <td>
                                    @if($danhGia->bienThe?->anh_bien_the)
                                        <img src="{{ asset('storage/' . $danhGia->bienThe->anh_bien_the) }}" width="60" class="img-thumbnail">
                                    @endif
                                    <br>
                                    {{ $danhGia->bienThe->ten_bien_the ?? 'Không rõ biến thể' }}
                                </td>
                                <td>
                                    @if($danhGia->trang_thai === 1)
                                        <span class="badge bg-success">Hiển thị</span>
                                    @elseif($danhGia->trang_thai === 0)
                                        <span class="badge bg-secondary text-light">Ẩn</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Không rõ</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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
<script>
    function filterReviews() {
        const selected = document.getElementById("filter-sao").value;
        const rows = document.querySelectorAll("#review-table-body tr");

        rows.forEach(row => {
            const sao = row.getAttribute("data-sao");
            if (selected === "all" || sao === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function toggleReviewTable() {
        const reviewTable = document.querySelector(".review-table");
        if (reviewTable) {
            reviewTable.style.display = reviewTable.style.display === "none" || reviewTable.style.display === "" ? "block" : "none";
        }
    }
</script>

<script>
    // JavaScript để thu gọn/hiển thị bảng biến thể
    function toggleVariantTable() {
        const variantTable = document.querySelector(".variant-table");
        variantTable.style.display = variantTable.style.display === "none" || variantTable.style.display === "" ? "block" : "none";
    }

    // JavaScript để thu gọn/hiển thị bảng đánh giá
    function toggleReviewTable() {
        const reviewTable = document.querySelector(".review-table");
        reviewTable.style.display = reviewTable.style.display === "none" || reviewTable.style.display === "" ? "block" : "none";
    }
</script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/customizer.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
