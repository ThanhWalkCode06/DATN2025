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
    /* .select2-container--default .select2-results__option--selected {
    background-color: #f9f9f6;
    border: 1px solid #ccc;
    border-top: none;
    } */
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
  <label for="{{ $key }}" class="form-label">{{ $label }}</label>
  <select name="{{ $key }}" id="{{ $key }}" class="form-control js-example-basic-single w-100">
    @foreach($options as $value => $text)
      <option value="{{ $value }}" {{ request($key) == (string)$value ? 'selected' : '' }}>
        {{ $text }}
      </option>
    @endforeach
  </select>
</div>



