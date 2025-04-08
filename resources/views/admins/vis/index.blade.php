@extends('layouts.admin')

@section('title', 'Quản lý ví người dùng')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách ví người dùng</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Số dư ví</th>
                <th>Lịch sử giao dịch</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->ten_nguoi_dung ?? $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ number_format($user->vi->so_du ?? 0, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <a href="{{ route('admin.vis.show', $user->id) }}" class="btn btn-sm btn-info">Xem giao dịch</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
       
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
