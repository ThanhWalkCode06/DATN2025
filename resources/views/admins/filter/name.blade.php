
@php
    // Dữ liệu truyền vào
    $key1 = $key1 ?? '';
    $key2 = $key2 ?? '';

    $label1 = $label1 ?? '';
    $label2 = $label2 ?? '';
@endphp

@if($key1)
<div class="col-md-3">
    <label for="{{ $key1 }}" class="form-label">{{ $label1 }}</label>
    <input type="text" name="{{ $key1 }}" id="{{ $key1 }}" class="form-control"
           value="{{ request($key1) }}" placeholder="Nhập {{ strtolower($label1) }}">
</div>
@endif

@if($key2)
<div class="col-md-3">
    <label for="{{ $key2 }}" class="form-label">{{ $label2 }}</label>
    <input type="text" name="{{ $key2 }}" id="{{ $key2 }}" class="form-control"
           value="{{ request($key2) }}" placeholder="Nhập {{ strtolower($label2) }}">
</div>
@endif
