@extends('layouts.admin')

@section('title')
    Thêm mới quyền
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <a style="float: left" href="{{ route('permissions.index') }}" class="btn btn-secondary col-1">Trở lại</a>
        <div class="row">
            <div class="col-xxl-8 col-lg-10 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Thêm quyền</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form" method="post" action="{{ route('permissions.store') }}">
                            @csrf
                            <table class="table variation-table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên quyền</th>
                                        <th scope="col">Mô tả quyền</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="permissions-container">
                                    @if(old('name'))
                                    <p class="text-danger">Vui lòng đặt theo cú pháp: <b>Tên Route(Nếu là router resource thì thêm s và thêm '-')</b></p>
                                    @foreach(old('name') as $index => $oldName)
                                    <tr>
                                        <td>
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('name.'.$index) is-invalid @enderror" type="text" placeholder="Tên quyền"
                                            name="name[]" value="{{ $oldName }}">

                                            @error('name.'.$index)
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('description.'.$index) is-invalid @enderror" type="text" placeholder="Mô tả quyền" name="description[]" value="{{ old('description.'.$index) }}" >
                                            @error('description.'.$index)
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <ul class="order-option">
                                                <li>
                                                    <a href="javascript:void(0)" class="delete-row">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>
                                            <input style="border: 1px solid #ced4da;" class="form-control " type="text" placeholder="Tên quyền"
                                            name="name[]" >
                                        </td>
                                        <p class="text-danger">Vui lòng đặt theo cú pháp: <b>Tên Route(Nếu là router resource thì thêm s và thêm '-')</b></p>
                                        <span class="text-danger">VD: resource: orders_view, route đơn: danhgia</span>
                                        <td>
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text" placeholder="Mô tả quyền" name="description[]" value="{{ old('description.0')}}" >
                                        </td>
                                        <td>
                                            <ul class="order-option">
                                                <li>
                                                    <a href="javascript:void(0)" class="delete-row">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            <button type="button" id="add-permission" class="btn text-white theme-bg-color">Add Value</button>
                            <button type="submit" class="btn ms-auto theme-bg-color text-white">Thêm mới</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
<script>
    document.getElementById('add-permission').addEventListener('click', function () {
    let tableBody = document.getElementById('permissions-container');

    let newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <input style="border: 1px solid #ced4da;" class="form-control" type="text" placeholder="Tên quyền" name="name[]">
        </td>
        <td>
            <input style="border: 1px solid #ced4da;" class="form-control" type="text" placeholder="Mô tả quyền" name="description[]">
        </td>
        <td>
            <ul class="order-option">
                <li>
                    <a href="javascript:void(0)" class="delete-row">
                        <i class="ri-delete-bin-line"></i>
                    </a>
                </li>
            </ul>
        </td>
    `;

    tableBody.appendChild(newRow);
});

// Xóa dòng khi bấm vào icon thùng rác
document.addEventListener('click', function (event) {
    if (event.target.closest('.delete-row')) {
        event.target.closest('tr').remove();
    }
});

</script>
    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
