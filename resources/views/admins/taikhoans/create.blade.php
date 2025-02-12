@extends('layouts.admin')

@section('title')
    Thêm mới tài khoản
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Add New User</h5>
                        </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button">Account</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button">Pernission</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="card-header-1">
                                        <h5>Product Information</h5>
                                    </div>

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">First
                                                Name</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Email
                                                Address</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="email">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="col-lg-2 col-md-3 col-form-label form-label-title">Password</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="password">
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Confirm
                                                Password</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="password">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                <div class="card-header-1">
                                    <h5>Product Related Permition</h5>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Add Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Update Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Delete Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Apply Discount</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-header-1">
                                    <h5>Category Related Permition</h5>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Add Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Update Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Delete Product</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-md-2 mb-0">Apply Discount</label>
                                    <div class="col-md-9">
                                        <form class="radio-section">
                                            <label>
                                                <input type="radio" name="opinion" checked>
                                                <i></i>
                                                <span>Allow</span>
                                            </label>

                                            <label>
                                                <input type="radio" name="opinion" />
                                                <i></i>
                                                <span>Deny</span>
                                            </label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js-->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
@endsection
