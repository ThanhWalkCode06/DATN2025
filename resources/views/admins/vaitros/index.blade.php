@extends('layouts.admin')

@section('title')
    Biến thể
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
                    <h5>Danh sách vai trò </h5>
                    <form class="d-inline-flex">
                        <a href="{{route('roles.create')}}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus-square"></i>Thêm mới
                        </a>
                    </form>
                </div>

                <div class="table-responsive table-product">
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
                                <th>Tên vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($lists != null)
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

                                    <td>{{ $item->name }}</td>

                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{ route('roles.edit', $item->id) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" onclick="confirmDelete(event, {{ $item->id }})">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>

                                                <form id="delete-form-{{ $item->id }}" action="{{ route('roles.destroy', $item->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $lists->onEachSide(5)->links("pagination::bootstrap-5") }}
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
