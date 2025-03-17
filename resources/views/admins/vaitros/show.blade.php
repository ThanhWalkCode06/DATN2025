@extends('layouts.admin')

@section('title')
    Sản phẩm
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')

    <body>

        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Thông tin vai trò</h5>
                            </div>
                            <div class="row">
                                <div class="col-12 overflow-hidden">
                                    <div class="order-left-image">
                                        <div class="order-image-contain">
                                            <h4>Tên vai trò: {{ $item->name }}</h4>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 overflow-visible">
                                    <div class="tracker-table">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr class="table-head">
                                                        <th scope="col">Xem</th>
                                                        <th scope="col">Thêm</th>
                                                        <th scope="col">Sửa</th>
                                                        <th scope="col">Xóa</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @for ($i = 0; $i < $maxRows; $i++)
                                                    <tr>
                                                        <td><?= $permissionsByAction['Xem'][$i] ?? '' ?></td>
                                                        <td><?= $permissionsByAction['Thêm'][$i] ?? '' ?></td>
                                                        <td><?= $permissionsByAction['Sửa'][$i] ?? '' ?></td>
                                                        <td><?= $permissionsByAction['Xóa'][$i] ?? '' ?></td>
                                                    </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-outline">Trở lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- Container-fluid Ends-->


    </body>
@endsection

@section('js')
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>
@endsection
