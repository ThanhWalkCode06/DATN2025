@extends('layouts.admin')

@section('title', 'Quản lý ví người dùng')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color: #009688; font-weight: 700; font-size: 2.5rem;">Danh sách ví người dùng</h2>

    <table class="table table-bordered shadow-sm" style="border-color: #009688;">
        <thead style="background-color: #009688; color: white !important;">
            <tr>
                <th style="color: white !important;">Tên người dùng</th>
                <th style="color: white !important;">Email</th>
                <th style="color: white !important;">Số dư ví</th>
                <th style="color: white !important;">Lịch sử giao dịch</th>
            </tr>
        </thead>
        <form method="GET" class="mb-4">
            <div class="input-group" style="max-width: 400px;">
                <input type="text" name="keyword" class="form-control"
                autocomplete="off"
                placeholder="Tìm theo tên hoặc username..." value="{{ request('keyword') }}">
                <button type="submit" class="btn" style="background-color: #009688; color: white;">
                    <i class="bi bi-search"></i> Tìm kiếm
                </button>
            </div>
        </form>
<br>        
        
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->ten_nguoi_dung ?? $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="color: #009688; font-weight: 600;">{{ number_format($user->vi->so_du ?? 0, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <a href="{{ route('admin.vis.show', $user->id) }}"
                           class="btn btn-sm"
                           style="background-color: #009688; color: white; font-weight: 600;">
                            Xem giao dịch
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}

    </div>
</div>
@endsection
@section('js')
</script>
<!-- customizer js -->
<script src="{{ asset('assets/js/customizer.js') }}"></script>

<!-- Sidebar js -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

<!-- Data table js -->
<script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

<script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
