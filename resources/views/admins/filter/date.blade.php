@php
    $key1 = $key1 ?? '';
    $key2 = $key2 ?? '';

    $label1 = $label1 ?? 'Từ ngày';
    $label2 = $label2 ?? 'Đến ngày';
// dd($label1,$label2 )
@endphp

@if($key1)
<div class="col-md-3">
  <label style="display: block" for="{{ $key1 }}" class="form-label">{{ $label1 }}</label>
  <input type="date" class="form-control" name="{{ $key1 }}" value="{{ request($key1) }}">
</div>
@endif

@if($key2)
<div class="col-md-3">
    <label style="display: block" for="{{ $key2 }}" class="form-label">{{ $label2 }}</label>
    <input type="date" class="form-control" name="{{ $key2 }}" value="{{ request($key2) }}">
</div>
@endif

