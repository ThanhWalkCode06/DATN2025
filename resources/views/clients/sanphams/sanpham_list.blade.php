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
