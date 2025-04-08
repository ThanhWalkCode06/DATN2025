@foreach ($lists as $key => $item)
    <tr class="justify-content-center">
        <td>
            <div class="check-box-contain">
                <span class="form-check user-checkbox">
                    <input class="checkbox_animated check-it" type="checkbox" value="">
                </span>
                <span>{{ ++$key }}</span>
            </div>
        </td>

        <td>{{ $item->username }}</td>

        <td>{{ $item->email }}</td>

        <td>
            <img style="width:100px;height:100px" src="{{ Storage::url($item->anh_dai_dien) }}" alt="">
        </td>

        <td class="{{ $item->trang_thai == 1 ? 'status-close' : 'status-danger' }}">
            <span>{{ $item->trang_thai == 1 ? 'Hoạt động' : 'Không hoạt động' }}</span>
        </td>

        <td>
            <ul>
                @if (
                    $item->roles->pluck('name')->first() == Auth()->user()->roles->pluck('name')->first() ||
                        $item->roles->pluck('name')->first() == 'SuperAdmin')
                @else
                    @can('users-update', $item->id)
                        <li>
                            <a href="{{ route('users.edit', $item->id) }}">
                                <i class="ri-pencil-line"></i>
                            </a>
                        </li>
                    @endcan

                    @can('users-view', $item->id)
                        <li>
                            <a href="{{ route('users.show', $item->id) }}">
                                <i class="ri-eye-line"></i>
                            </a>
                        </li>
                    @endcan
                @endif

            </ul>
        </td>
    </tr>
@endforeach

@if ($lists->isEmpty())
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>
@endif
