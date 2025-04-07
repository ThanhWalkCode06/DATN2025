@extends('layouts.admin')

@section('title')
    Tài khoản
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')

    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Danh sách người dùng </h5>
                    <form class="d-inline-flex">
                        <a href="{{route('users.create')}}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus-square"></i>Thêm mới
                        </a>
                    </form>
                </div>

                <div class="table-responsive table-product">
                    <form id="searchForm" class="row g-3 align-items-center" method="get" action="{{ route('users-search') }}">
                        <!-- Phần tìm kiếm cơ bản -->
                        <div class="col-md-5">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Tìm kiếm tên tài khoản" name="username" value="">
                                <button type="submit" class="btn btn-theme btn-sm"><i data-feather="search"></i></button>
                                <button class="btn btn-primary btn-sm ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                                    Tìm kiếm nâng cao
                                </button>
                            </div>
                        </div>

                        <!-- Phần bộ lọc nâng cao -->
                        <div class="col-12">
                            <div class="collapse" id="filterPanel">
                                <div class="card card-body mt-2">
                                    <div class="row">
                                        @include('admins.filter.name',['key' => 'email', 'label' => 'Email'])
                                        @include('admins.filter.status',['key' => 'trang_thai', 'label' => 'Trạng thái'])
                                        {{-- @include('admins.filter.select2', [
                                            'key' => 'roles.id_in',
                                            'label' => 'Vai trò',
                                            'options' => $roles,
                                            'multiple' => true,
                                            'selected' => request('roles.id_in')
                                            ? (array) request('roles.id_in')
                                            : []
                                        ]) --}}
                                        {{-- @include('admins.filter.date',['key1' => null,'key2' => null, 'label1' => null, 'label2' => null]) --}}
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-end">
                                            <!-- Nút Reset Filter (chỉ reset các input filter) -->
                                            <button type="button" id="resetFilter" class="btn btn-primary btn-sm">
                                                <i data-feather="refresh-ccw"></i> Làm mới
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if(session('error-key'))
                        <p class="text-danger">{{ session('error-key') }}</p>
                    @endif

                    <table class="table all-package theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th>
                                    <div class="check-box-contain">
                                        <span class="form-check user-checkbox">
                                            <input class="checkbox_animated checkall"
                                                type="checkbox" value="">
                                        </span>
                                        <span>STT</span>
                                    </div>
                                </th>
                                <th>Tên tài khoản</th>
                                <th>email</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody id="user-list-body">
                            @include('admins.taikhoans.partials.list_rows', ['lists' => $lists])
                        {{-- @if(@$lists)
                            @foreach ( $lists as $key => $item)
                                <tr class="justify-content-center">
                                    <td>
                                        <div class="check-box-contain">
                                            <span class="form-check user-checkbox">
                                                <input class="checkbox_animated check-it"
                                                    type="checkbox" value="">
                                            </span>
                                            <span>{{ ++$key }}</span>
                                        </div>
                                    </td>

                                    <td>{{ $item->username }}</td>

                                    <td>{{ $item->email }}</td>

                                    <td>
                                        <img style="width:100px;height:100px" src="{{ Storage::url($item->anh_dai_dien) }}" alt="">
                                    </td>

                                    <td class="{{ $item->trang_thai == 1 ? 'status-close' : 'status-danger' }}">
                                        <span>{{ $item->trang_thai == 1 ? 'Hoạt động' : 'Không hoạt động' }}</span>
                                    </td>

                                    <td>
                                        <ul>



                                            @if ($item->roles->pluck('name')->first() == Auth()->user()->roles->pluck('name')->first()
                                            || $item->roles->pluck('name')->first() == 'SuperAdmin')

                                            @else
                                            @can('users-update', $item->id)
                                            <li>
                                                <a href="{{ route('users.edit', $item->id) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('users-view', $item->id)
                                            <li>
                                                <a href="{{ route('users.show', $item->id) }}">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </li>
                                            @endcan
                                            @endif

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif --}}


                        </tbody>
                    </table>
                    @if($lists->isEmpty())
                        <p style="font-size: 2rem" class="text-center text-muted">Danh sách trống</p>
                        <center><img style="width: 200px; height: 200px" src="{{ asset('assets/images/inner-page/not-found.png') }}" alt=""></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 pagination-wrapper">
    {{ $lists->links("pagination::bootstrap-5") }}
    </div>
@endsection

@section('js')
<script>
    function confirmDelete(event, id) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: 'Hành động này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Có, xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit(); // Gửi form ẩn để xóa
            }
        });
    }
</script>

<script>
$(document).ready(function() {
    // Hàm tải dữ liệu
    function loadData(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#user-list-body').html(response.html);
                $('.pagination-wrapper').html(response.pagination);

                // Cập nhật URL trình duyệt không reload
                history.pushState(null, null, url);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

    // Submit form lọc
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        let url = $(this).attr('action') + '?' + $(this).serialize();
        loadData(url);
    });

    // Xử lý click phân trang
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        loadData($(this).attr('href'));
    });

    // Reset filter
    $('#resetFilter').click(function() {
        $('#filterPanel input').val('');
        $('#filterPanel select').val('').trigger('change');
        $('#searchForm').submit();
    });
});
</script>
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
