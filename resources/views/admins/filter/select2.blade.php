
{{-- @php
    $key = $key ?? 'key_name';
    $label = $label ?? 'Chọn giá trị';
    $options = $options ?? [];
    $multiple = $multiple ?? false;
    $selected = request($key, $multiple ? [] : null);
@endphp --}}
<style>
    /* Phần ô select2 tổng thể */
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ccc !important;
        border-radius: 0.375rem;
        background-color: #fff;
        min-height: 3em;
        min-width: 250px;
        padding:  0.75rem;
        font-size: 0.875rem; /* Nhỏ hơn một chút */
    }

    /* Giao diện tag đã chọn (ví dụ: SuperAdmin) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #198754; /* Màu xanh lá */
        border: none !important;  /* Không cần viền */
        color: #fff;
        font-size: 0.75rem; /* Nhỏ hơn chữ thường */
        font-weight: 400;
        padding: 0.2rem 1.5rem 0.2rem 0.75rem;
        border-radius: 1rem;
        margin-top: 3px;
        position: relative;
    }

    /* Nút x bên trong tag */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff;
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateX(50%);
        background: none !important;
        border: none !important;
        font-size: 0.85rem;
        line-height: 1;
        cursor: pointer;
    }

    /* Hover vào x đổi màu nhẹ hoặc không đổi nếu không thích */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #ffc107;
    }
</style>
<div class="col-md-3 mb-3">
    <label for="{{ str_replace('.', '_', $key) }}" class="form-label">{{ $label }}</label>
    <select
        name="{{ $multiple ? $key.'[]' : $key }}"
        id="{{ str_replace('.', '_', $key) }}"
        class="form-control super-select2"
        {{ $multiple ? 'multiple' : '' }}
    >
        @if(!$multiple)
            <option value="">-- Chọn {{ $label }} --</option>
        @endif

        @foreach($options as $value => $text)
            @if($multiple)
                <option value="{{ $value }}"
                    {{ in_array($value, (array) $selected) ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @else
                <option value="{{ $value }}"
                    {{ $value == $selected ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endif
        @endforeach
    </select>
</div>
