@extends('layouts.admin')

@section('title')
    Thêm mới vai trò
@endsection

@section('css')
    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}" />

    <!-- Dropzone css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}" />

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}" />

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}" />

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}" />

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}" />

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}" />

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}" />

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
@endsection

@section('content')
    <div class="col-12">
        <a style="float: left" href="{{ route('roles.index') }}" class="btn btn-secondary col-1">Trở lại</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Create Role</h5>
                        </div>


                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên vai trò: <span
                                        class="theme-color">*</span></label>
                                <div class="col-sm-5">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Tên vai trò"
                                    name="name" value="{{ old('name') }}"/>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <h4>Chọn quyền:</h4>
                            <input type="checkbox" id="check-all" class="checkbox_animated checkall"> Chọn tất cả
                            <div class="row mt-4">
                                @foreach($permissions->chunk(ceil(count($permissions) / 2)) as $chunk)
                                    <div class="col-md-6"> {{-- Chia làm 2 cột --}}
                                        @foreach($chunk as $group => $perms)
                                            <h5 class="text-primary">{{ ucfirst($group) }}</h5>
                                            <ul class="list-unstyled">
                                                @foreach($perms as $perm)
                                                    <li>
                                                        <input class="checkbox_animated checkall" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}">
                                                        <label for="perm_{{ $perm->id }}">{{ ucfirst(str_replace('-', ' ', $perm->description)) }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>


                            <button  class="btn btn-solid" type="submit">Tạo Vai Trò</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const checkAll = document.getElementById("check-all");
    const checkItems = document.querySelectorAll(".checkall");

    checkAll.addEventListener("change", function () {
        checkItems.forEach(item => {
            item.checked = checkAll.checked;
        });
    });

    checkItems.forEach(item => {
        item.addEventListener("change", function () {
            if (!this.checked) {
                checkAll.checked = false;
            } else if (document.querySelectorAll(".checkall:checked").length === checkItems.length) {
                checkAll.checked = true;
            }
        });
    });
});
</script>
@section('js')
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

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection
