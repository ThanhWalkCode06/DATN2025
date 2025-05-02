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
                <div class="action-group">
                    <label>Vai trò</label>
                    <select id="role-action" class="form-control js-example-basic-single-sing w-100">
                        <option value="">Chọn vai trò</option>
                        <option value="[]">Khách hàng</option>
                        @foreach ($roles as $key => $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="action-group">
                    <label>Trạng thái</label>
                    <select id="status-action" class="form-control js-example-basic-single-sing w-100">
                        <option value="">Chọn trạng thái</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>
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
    $(document).ready(function() {

        // Khởi tạo Select2 khi modal được mở
        $('#actionModal').on('shown.bs.modal', function() {
            $(this).removeAttr('aria-hidden');
            $('.js-example-basic-single-sing').each(function() {
                $(this).select2({
                    dropdownParent: $('#actionModal'),
                    width: '100%',
                    placeholder: $(this).find('option:first').text(),
                });
            });

            // Buộc ô tìm kiếm nhận focus
            $(document).on('click', '.select2-search__field', function(e) {
                e.stopPropagation();
                this.focus(); // Sử dụng native focus
                console.log('Ô tìm kiếm được click');
            });

            // Đảm bảo ô tìm kiếm có thể tương tác
            $(document).on('click', '.select2-search__field', function(e) {
                e.stopPropagation();
                $(this).focus();
                console.log('Ô tìm kiếm được click');
            });
        });

        // Hủy Select2 khi modal đóng
        $('#actionModal').on('hidden.bs.modal', function() {
            $('.js-example-basic-single').each(function() {
            });
        });

        // Xử lý checkbox "checkall"
        $('.checkall').on('change', function() {
            $('.check-it').prop('checked', $(this).is(':checked'));
        });

        // Xử lý nút áp dụng trong modal
        $('#apply-btn').on('click', function() {
            var selectedIds = [];
            console.log($('.check-it:checked'))
            $('.check-it:checked').each(function() {
                selectedIds.push($(this).val());
            });

            var roleAction = $('#role-action').val();
            var statusAction = $('#status-action').val();

            if (selectedIds.length === 0) {
                Swal.fire('Lỗi','Vui lòng chọn ít nhất một người dùng!','warning');
                return;
            }
            if (!roleAction && !statusAction) {
                Swal.fire('Lỗi','Vui lòng chọn ít nhất một vai trò hoặc trạng thái!','warning');
                return;
            }

            $.ajax({
                url: '{{ route("users.quick-update") }}',
                type: 'POST',
                data: JSON.stringify({ ids: selectedIds, roles: roleAction, status: statusAction }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    console.log('Server trả về:', response);
                    $('#user-list-body').html(response.html);
                    if(response.success){
                        Swal.fire('Thành công','Cập nhật thành công!','success');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Mã lỗi:', xhr.status);
                    console.error('Chi tiết:', xhr.responseText);
                    $('#response').html('<p>Có lỗi xảy ra.</p>');
                }
            });


            $('#actionModal').modal('hide');
            $('#actionModal').on('hidden.bs.modal', function() {
                // Xóa giá trị các input trong modal
                $('#actionModal input').val(''); // Reset các input text, number, v.v.
                $('#actionModal select').val(''); // Reset các select
                $('#actionModal input[type="checkbox"]').prop('checked', false); // Bỏ chọn các checkbox
                $('#actionModal input[type="radio"]').prop('checked', false); // Bỏ chọn các radio button
            });
        });
    });
</script>
