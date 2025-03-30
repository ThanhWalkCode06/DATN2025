@extends('layouts.admin')

@section('title')
    Sản phẩm
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

<style>
   ::selection {  
      background-color: yellow !important;
      color: black !important;
   }
   ::-moz-selection {
      background-color: yellow !important;
      color: black !important;
   }
</style>

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="bg-inner cart-section order-details-table">
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="table-responsive table-details">
                            <table class="table cart-table table-borderless">
                                <thead>
                                    <tr>
                                        <th colspan="2">Chi tiết sản phẩm</th>
                                        <th class="text-end" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-order">
                                        <td>
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" class="img-fluid blur-up lazyload" alt="{{ $sanPham->ten_san_pham }}">
                                            </a>
                                        </td>
                                        <td>
                                            <p>Tên sản phẩm</p>
                                            <h5>{{ $sanPham->ten_san_pham }}</h5>
                                        </td>
                                        <td>
                                            <p>Số lượng</p>
                                            <h5>{{ $sanPham->so_luong }}</h5>
                                        </td>
                                        <td>
                                            <p>Giá</p>
                                            <h5>{{ number_format($sanPham->gia_moi) }} VNĐ</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="order-success">
                            <h4>Biến thể</h4>
                            @if($sanPham->bienThes->isNotEmpty())
                                @foreach($sanPham->bienThes as $bienThe)
                                    <ul class="order-details">
                                        <li><strong>Tên biến thể:</strong> {{ $bienThe->ten_bien_the }}</li>
                                        <li><strong>Giá nhập:</strong> {{ number_format($bienThe->gia_nhap) }} VNĐ</li>
                                        <li><strong>Giá bán:</strong> {{ number_format($bienThe->gia_ban) }} VNĐ</li>
                                        <li><strong>Số lượng:</strong> {{ $bienThe->so_luong }}</li>
                                        <li>
                                            <strong>Ảnh:</strong>
                                            @if($bienThe->anh_bien_the)
                                                <img src="{{ asset('storage/' . $bienThe->anh_bien_the) }}" alt="{{ $bienThe->ten_bien_the }}" width="80">
                                            @else
                                                Không có ảnh
                                            @endif
                                        </li>
                                    </ul>
                                @endforeach
                            @else
                                <p>Không có biến thể nào cho sản phẩm này.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Mô tả</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Bình luận</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                        {!! nl2br(e($sanPham->mo_ta)) !!}
                    </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                        Chức năng bình luận sẽ được cập nhật sau.
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabLinks = document.querySelectorAll(".nav-tabs .nav-link");
        const tabContents = document.querySelectorAll(".tab-pane");

        tabLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();

                tabLinks.forEach(tab => tab.classList.remove("active"));
                tabContents.forEach(content => content.classList.remove("active", "show"));

                this.classList.add("active");

                const targetTab = document.querySelector(this.getAttribute("href"));
                if (targetTab) {
                    targetTab.classList.add("active", "show");
                }
            });
        });
    });
</script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/customizer.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
