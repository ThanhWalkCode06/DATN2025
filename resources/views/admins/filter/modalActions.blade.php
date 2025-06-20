<style>
    .action-btn {
        font-weight: bold;
        padding: 7px 10px;
        font-size: 16px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        background-color: rgba(180, 241, 197, 0.4);
        border: none;
        color: #0da487;
    }

    .action-btn i {
        color: #0da487;
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
        z-index: 9999999999;
    }
    .select2-container {
    position: relative; /* Đảm bảo container của select2 có position */
    /* z-index: 10000; Cao hơn z-index của modal */
    }
    .select2-search__field{
    /* z-index: 9999999999; */
    }
</style>

<!-- Modal sổ xuống -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Cập nhật nhanh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($fields as $field)
                    <div class="action-group mb-3">
                        <label for="{{ $field['key'] }}">{{ $field['label'] }}</label>
                        <select id="{{ $field['key'] }}" class="form-control js-example-basic-single-sing w-100">
                            @foreach ($field['options'] as $value => $text)
                                <option value="{{ $value }}">{{ $text }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="apply-btn">Áp dụng</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    const filterFieldIds = @json(array_column($fields, 'key'));
</script>
<script>
$(document).ready(function() {
    $('#actionModal').on('shown.bs.modal', function () {
        $(this).removeAttr('aria-hidden');
        $('.js-example-basic-single-sing').each(function () {
            $(this).select2({
                dropdownParent: $('#actionModal'),
                width: '100%',
                placeholder: $(this).find('option:first').text(),
            });
        });
    });

    $('#actionModal').on('hidden.bs.modal', function () {
        $(this).find('input, select').val('');
        $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    });

    $('.checkall').on('change', function () {
        $('.check-it').prop('checked', $(this).is(':checked'));
    });

    $('#apply-btn').on('click', function () {
        var selectedIds = [];
        $('.check-it:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            Swal.fire('Lỗi', 'Vui lòng chọn ít nhất 1!', 'warning');
            return;
        }

        // Thu thập dữ liệu các filter đã truyền vào
        let filterData = {};
        let hasValue = false;

        filterFieldIds.forEach(id => {
            let value = $('#' + id).val();
            filterData[id] = value;
            if (value) hasValue = true;
        });

        if (!hasValue) {
            Swal.fire('Lỗi', 'Vui lòng chọn ít nhất một giá trị!', 'warning');
            return;
        }

        $.ajax({
            url: '{{ route("banners.quick-update") }}',
            type: 'POST',
            data: JSON.stringify({
                ids: selectedIds,
                filters: filterData
            }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                $('#banners-list-body').html(response.html);
                if (response.success) {
                    Swal.fire('Thành công', 'Cập nhật thành công!', 'success');
                }
            },
            error: function (xhr) {
                console.error('Mã lỗi:', xhr.status);
                console.error('Chi tiết:', xhr.responseText);
                $('#response').html('<p>Có lỗi xảy ra.</p>');
            }
        });

        $('#actionModal').modal('hide');
    });
});
</script>

