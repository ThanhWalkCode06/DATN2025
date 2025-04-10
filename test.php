<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật nhanh người dùng - Sổ xuống</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 850px;
            padding: 20px;
        }
        .table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 8px;
        }
        .check-box {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-check-input {
            margin: 0;
            cursor: pointer;
        }
        .action-btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 20px;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-body {
            padding: 20px;
        }
        .action-group {
            margin-bottom: 15px;
        }
        .action-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="mb-3">Quản lý người dùng</h4>

        <!-- Bảng người dùng -->
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>
                        <div class="check-box">
                            <input class="form-check-input checkall" type="checkbox">
                            <span>#</span>
                        </div>
                    </th>
                    <th>Tên</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="check-box">
                            <input class="form-check-input check-it" type="checkbox" value="1">
                            <span>1</span>
                        </div>
                    </td>
                    <td>Nguyễn Văn A</td>
                    <td>User</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <td>
                        <div class="check-box">
                            <input class="form-check-input check-it" type="checkbox" value="2">
                            <span>2</span>
                        </div>
                    </td>
                    <td>Trần Thị B</td>
                    <td>Admin</td>
                    <td>Inactive</td>
                </tr>
                <tr>
                    <td>
                        <div class="check-box">
                            <input class="form-check-input check-it" type="checkbox" value="3">
                            <span>3</span>
                        </div>
                    </td>
                    <td>Lê Văn C</td>
                    <td>User</td>
                    <td>Active</td>
                </tr>
            </tbody>
        </table>

        <!-- Nút hành động -->
        <div class="mt-3">
            <button style="background-color: none !important;" class="btn btn-primary action-btn" data-bs-toggle="modal" data-bs-target="#actionModal">
                Hành động
            </button>
        </div>
    </div>

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
                        <select id="role-action" class="form-select">
                            <option value="">Chọn vai trò</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="action-group">
                        <label>Trạng thái</label>
                        <select id="status-action" class="form-select">
                            <option value="">Chọn trạng thái</option>
                            <option value="active">Kích hoạt</option>
                            <option value="inactive">Vô hiệu hóa</option>
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

    <!-- jQuery và Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Xử lý checkbox "checkall"
            $('.checkall').on('change', function() {
                $('.check-it').prop('checked', $(this).is(':checked'));
            });

            // Xử lý nút áp dụng trong modal
            $('#apply-btn').on('click', function() {
                var selectedIds = [];
                $('.check-it:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                var roleAction = $('#role-action').val();
                var statusAction = $('#status-action').val();

                if (selectedIds.length === 0) {
                    alert('Vui lòng chọn ít nhất một người dùng!');
                    return;
                }
                if (!roleAction && !statusAction) {
                    alert('Vui lòng chọn ít nhất một vai trò hoặc trạng thái!');
                    return;
                }

                // Mô phỏng request
                var updates = {};
                if (roleAction) updates.role = roleAction;
                if (statusAction) updates.status = statusAction;

                console.log('Cập nhật:', {
                    ids: selectedIds,
                    updates: updates
                });
                alert('Đã gửi yêu cầu cập nhật cho ID: ' + selectedIds.join(', ') +
                      (roleAction ? ' - Vai trò: ' + roleAction : '') +
                      (statusAction ? ' - Trạng thái: ' + statusAction : ''));

                // Đóng modal
                $('#actionModal').modal('hide');

                // AJAX thực tế khi tích hợp server
                /*
                $.ajax({
                    url: '/admin/users/update-quick',
                    method: 'POST',
                    data: {
                        ids: selectedIds,
                        role: roleAction,
                        status: statusAction,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Cập nhật thành công!');
                            location.reload();
                        } else {
                            alert('Lỗi: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Lỗi hệ thống!');
                    }
                });
                */
            });
        });
    </script>
</body>
</html>
