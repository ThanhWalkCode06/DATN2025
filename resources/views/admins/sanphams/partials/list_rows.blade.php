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
