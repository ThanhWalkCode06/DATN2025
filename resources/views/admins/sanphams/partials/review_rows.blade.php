@foreach ($danhGias as $danhGia)
    <tr data-sao="{{ $danhGia->so_sao }}" data-date="{{ $danhGia->created_at->toDateString() }}">
        <td>{{ $danhGia->user->ten_nguoi_dung ?? 'Ẩn danh' }}</td>
        <td>{{ $danhGia->don_hang_id ?? 'Không có' }}</td>
        <td>
            @for ($i = 0; $i < $danhGia->so_sao; $i++)
                ⭐
            @endfor
        </td>
        <td>
            <div style="max-width: 300px; word-wrap: break-word; white-space: pre-line;">
                {!! nl2br(e($danhGia->nhan_xet)) !!}
            </div>
        </td>
        <td>
            @if ($danhGia->bienThe?->anh_bien_the)
                <img src="{{ asset('storage/' . $danhGia->bienThe->anh_bien_the) }}" width="100" class="img-thumbnail">
            @endif
            <br>
            {{ $danhGia->bienThe->ten_bien_the ?? 'Không rõ biến thể' }}
        </td>
        <td class="status-icon">
            @if ($danhGia->trang_thai == 1)
                <i class="ri-checkbox-circle-line text-success"></i>
            @else
                <i class="ri-close-circle-line text-danger"></i>
            @endif
        </td>
        <td>{{ $danhGia->ly_do_an ?? 'Không có' }}</td>
        <td>
            @php
                $images = $danhGia->hinh_anh_danh_gia;
                if (is_string($images)) {
                    $images = json_decode($images, true);
                }
                $images = !empty($images) && is_array($images) ? $images : [];
                $video = $danhGia->video;
            @endphp
            @if (!empty($images) || !empty($video))
                <i class="ri-eye-line eye-icon" data-images='@json($images)'
                    data-video="{{ $video }}" data-bs-toggle="modal" data-bs-target="#mediaModal"></i>
            @else
                Không có
            @endif
        </td>
        <td>
            {{-- <button
                class="toggleStatus btn btn-sm {{ $danhGia->trang_thai == 1 ? 'btn-danger' : 'btn-primary' }}"
                data-id="{{ $danhGia->id }}" style="display:flex; justify-content:center; align">
                {{ $danhGia->trang_thai == 1 ? 'Ẩn' : 'Hiện' }}
            </button> --}}
            <div style="display: flex; justify-content: center; align-items: center;">
                <button
                    class="btn toggleStatus btn btn-sm  {{ $danhGia->trang_thai == 1 ? 'btn-danger' : 'btn-primary' }} toggleStatus"
                    data-id="{{ $danhGia->id }}">
                    {{ $danhGia->trang_thai == 1 ? 'Ẩn' : 'Hiện' }}
                </button>
            </div>
        </td>
    </tr>
@endforeach
