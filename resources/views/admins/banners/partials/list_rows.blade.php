@php
    $listPosition = [
        'homepage' => 'Banner chính',
        'secondary' => 'Banner phụ',
        'sidebar' => 'Banner sidebar',
    ];
@endphp
@if (@$lists)
    @foreach ($lists as $key => $item)
        <tr class="justify-content-center">
            <td>
                <div class="check-box-contain">
                    <span class="form-check user-checkbox">
                        <input class="checkbox_animated check-it" type="checkbox" value="{{ $item->id }}">
                    </span>
                    <span>{{ ++$key }}</span>
                </div>
            </td>




            <td>{{ $listPosition[$item->position] }}</td>

            <td>{{ $item->priority ?? '' }}</td>

            <td class="{{ $item->status == 1 ? 'status-close' : 'status-danger' }}">
                <span>{{ $item->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</span>
            </td>

            <td>
                <ul>
                    <li>
                        <a href="{{ route('bannerAdmin.edit', $item->id) }}">
                            <i class="ri-pencil-line"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="confirmDelete(event, {{ $item->id }})">
                            <i class="ri-delete-bin-line"></i>
                        </a>

                        <form id="delete-form-{{ $item->id }}"
                            action="{{ route('bannerAdmin.destroy', $item->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>

                </ul>
            </td>
        </tr>
    @endforeach
@endif

@if ($lists->isEmpty())
    <tr>
        <td colspan="6">Không có dữ liệu</td>
    </tr>
@endif
