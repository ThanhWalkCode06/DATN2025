<style>
    .select2 {
        max-width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .select2-search--dropdown {
        display: block;
        padding: 4px;
        border: 1px solid #ccc;
        border-top: none;
    }
    .select2-container--default .select2-results>.select2-results__options {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ccc;
    border-top: none;
    }
    .selection{
        width: 100%;
    }
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
@php
    $key = $key ?? 'trang_thai';
    $label = $label ?? 'Trạng thái';
    $options = $options ?? [
        '' => '-- Tất cả --',
        1 => 'Hoạt động',
        0 => 'Không hoạt động',
    ];
@endphp

<div style="boder: 1px solid #ccc" class="col-md-3">
  <label style="display: block" for="{{ $key }}" class="form-label">{{ $label }}</label>
  <select name="{{ $key }}" id="{{ $key }}" class="form-control js-example-basic-single w-100">
    @foreach($options as $value => $text)
      <option value="{{ $value }}" {{ request($key) == (string)$value ? 'selected' : '' }}>
        {{ $text }}
      </option>
    @endforeach
  </select>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>


