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
</style>

@php
    // Các giá trị mặc định
    $key = $key ?? 'trang_thai';
    $label = $label ?? 'Trạng thái';
    $modelClass = $modelClass ?? null;
    $relation = $relation ?? null;
    $column = $column ?? 'name'; // Trường mặc định là 'name', có thể tùy chỉnh

    // Nếu có quan hệ, lấy dữ liệu từ bảng quan hệ
    if ($modelClass && $relation && class_exists($modelClass) && method_exists($modelClass, $relation)) {
        $relatedModel = (new $modelClass)->{$relation}()->getRelated();
        // Kiểm tra xem cột có tồn tại trong bảng không
        $columns = Schema::getColumnListing($relatedModel->getTable());
        $displayColumn = in_array($column, $columns) ? $column : 'name'; // Fallback về 'name' nếu cột không tồn tại
        $options = $relatedModel::pluck($displayColumn,'id')->prepend('-- Tất cả --', '')->all();
        // dd($options);
    } else {
        // Mặc định nếu không có quan hệ
        $options = $options ?? [
            '' => '-- Tất cả --',
            1 => 'Hoạt động',
            0 => 'Không hoạt động',
        ];
    }
@endphp

<div class="col-md-3">
    <label style="display: block" for="{{ $key }}" class="form-label">{{ $label }}</label>
    <select name="{{ $key }}" id="{{ $key }}" class="form-control js-example-basic-single w-100">
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ request($key) == (string)$value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
