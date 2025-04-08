@foreach ($phieuGiamGias as $phieuGiamGia)
    <tr>
        <td>{{ $phieuGiamGia->ten_phieu }}</td>
        <td>{{ $phieuGiamGia->ma_phieu }}</td>
        <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_bat_dau)) }}</td>
        <td>{{ date('d-m-Y', strtotime($phieuGiamGia->ngay_ket_thuc)) }}</td>
        <td class="theme-color">{{ $phieuGiamGia->gia_tri }}%</td>
        <td class="menu-status">
            @if ($phieuGiamGia->trang_thai == 1)
                <span class="badge bg-success">Kích hoạt</span>
            @else
                <span class="badge bg-danger">Không kích hoạt</span>
            @endif
        </td>
        <td>
            <ul class="d-flex justify-content-center">
                <li>
                    <a href="{{ route('phieugiamgias.edit', $phieuGiamGia->id) }}">
                        <i class="ri-pencil-line"></i>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="confirmDelete(event, '{{ $phieuGiamGia->id }}')">
                        <i class="ri-delete-bin-line"></i>
                    </a>

                    <form id="delete-form-{{ $phieuGiamGia->id }}"
                        action="{{ route('phieugiamgias.destroy', $phieuGiamGia->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </li>
            </ul>
        </td>
    </tr>
@endforeach


@if ($phieuGiamGias->isEmpty())
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>
@endif
