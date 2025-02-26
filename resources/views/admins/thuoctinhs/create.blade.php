@extends('layouts.admin')

@section('title')
    Thêm mới thuộc tính và giá trị
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
        <div class="row">
            <div class="col-xxl-8 col-lg-10 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Thêm thuộc tính</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form" action="{{ route('thuoctinhs.store') }}" method="POST">
                            @csrf
                            
                            <!-- Tên thuộc tính -->
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0" for="ten_thuoc_tinh">Tên thuộc tính</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="ten_thuoc_tinh" name="ten_thuoc_tinh" type="text" placeholder="Tên thuộc tính">
                                    @error('ten_thuoc_tinh')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Giá trị thuộc tính -->
                            <div class="mb-4 row align-items-start">
                                <label class="form-label-title col-sm-3 mb-0">Giá trị thuộc tính</label>
                                <div class="col-sm-9">
                                    <div id="giaTriContainer">
                                        <div class="input-group mb-2">
                                            <input type="text" name="gia_tri[]" class="form-control" placeholder="Giá trị thuộc tính">
                                           
                                            <button type="button" class="btn btn-danger removeGiaTri">Xóa</button>
                                        </div>
                                    </div>
                                    <button type="button" id="addGiaTri" class="btn btn-primary mt-2">Thêm giá trị</button>
                                </div>
                            </div>
                            
                            <button class="btn ms-auto theme-bg-color text-white" type="submit">Thêm mới</button>
                        </form>

                    </div>

                   
                </div>
            </div>
        </div>
    </div>
@endsection

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



    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const giaTriContainer = document.getElementById('giaTriContainer');
            const addGiaTriButton = document.getElementById('addGiaTri');

            addGiaTriButton.addEventListener('click', function() {
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-2');
                newInputGroup.innerHTML = `
                    <input type="text" name="gia_tri[]" class="form-control" placeholder="Giá trị thuộc tính">
                    <button type="button" class="btn btn-danger removeGiaTri">Xóa</button>
                `;
                giaTriContainer.appendChild(newInputGroup);
            });

            giaTriContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('removeGiaTri')) {
                    event.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
