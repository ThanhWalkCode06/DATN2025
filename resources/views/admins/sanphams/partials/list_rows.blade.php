@foreach ($sanPhams as $index => $sanpham)
    <tr>
        <td>{{ $sanpham->ten_san_pham }}</td>

        <td>{{ $sanpham->ma_san_pham }}</td>

        <td>{{ $sanpham->danhMuc->ten_danh_muc ?? 'Không có danh mục' }}</td>

        <td>
            <div class="table-image">
                <img src="{{ Storage::url($sanpham->hinh_anh) }}" class="img-thumbnail" alt="Hình ảnh" width="100px">
            </div>
        </td>
        <td>
            @if ($sanpham->trang_thai == 1)
                <span class="badge bg-success-subtle text-success fs-6">Còn hàng</span>
            @else
                <span class="badge bg-danger-subtle text-danger fs-6">Hết hàng</span>
            @endif
        </td>

        {{-- <td>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#variant_{{ $sanpham->id }}">
                Xem biến thể
            </button>

            <!-- Modal hiển thị biến thể sản phẩm -->
            <div id="variant_{{ $sanpham->id }}" class="modal fade fadeInLeft" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 800px !important;">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <div class="mt-4">
                                <h4 class="mb-3">Thông tin biến thể của sản phẩm</h4>
                                <h5 class="mb-3">'{{ $sanpham->ten_san_pham }}'</h5>
                                <div class="hstack gap-2 justify-content-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Tên biến thể</td>
                                                <td>Hình ảnh</td>
                                                <td>Giá bán</td>
                                                <td>Số lượng</td>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @if ($sanpham->bienThes->isNotEmpty())
                                                @php
                                                    // dd($sanpham->bienThes);
                                                @endphp
                                                @foreach ($sanpham->bienThes as $key => $bienThe)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $bienThe->ten_bien_the }}
                                                        </td>
                                                        <td>
                                                            @if ($bienThe->anh_bien_the)
                                                                <img src="{{ Storage::url($bienThe->anh_bien_the) }}"
                                                                    class="img-thumbnail" width="80px">
                                                            @else
                                                                Không có ảnh
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($bienThe->gia_ban, 0, ',', '.') }}
                                                            VNĐ</td>
                                                        <td>{{ $bienThe->so_luong }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        Không có biến thể nào</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </td> --}}

        <td>
            <ul>
                <li>
                    <a href="{{ route('sanphams.show', $sanpham->id) }}">
                        <i class="ri-eye-line"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('sanphams.edit', $sanpham->id) }}">
                        <i class="ri-pencil-line"></i>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $sanpham->id }}">
                        <i class="ri-delete-bin-line"></i>
                    </a>

                    <div class="modal fade" id="deleteModal{{ $sanpham->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">Bạn muốn xóa sản phẩm
                                    {{ $sanpham->ten_san_pham }} đúng không ?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Hủy</button>
                                    <form action="{{ route('sanphams.destroy', $sanpham->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </td>
    </tr>
@endforeach

@if ($sanPhams->isEmpty())
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>
@endif
