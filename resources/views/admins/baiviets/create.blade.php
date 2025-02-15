@extends('layouts.admin')

@section('title')
    Thêm mới bài viết
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
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Thêm Mới Bài Viết</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tiêu Đề
                                    </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Product Name">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title"> Danh Mục Tiêu Đề
                                    </label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="state">
                                        <option disabled>Static Menu</option>
                                        <option>Áo Khoác</option>
                                        <option>Áo Thu Đông</option>
                                    </select>
                                </div>
                            </div>




                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Tags</label>
                                <div class="col-sm-9">
                                    <div class="bs-example">
                                        <input type="text" class="form-control" placeholder="Type tag & hit enter"
                                            id="#inputTag" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Exchangeable</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <input type="checkbox"><span class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Refundable</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <input type="checkbox" checked=""><span class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Description</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Product
                                            Description</label>
                                        <div class="col-sm-9">
                                            <div id="editor"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Product Images</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Images</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-choose" type="file" id="formFile" multiple>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Thumbnail
                                    Image</label>
                                <div class="col-sm-9">
                                    <input class="form-control form-choose" type="file" id="formFileMultiple1"
                                        multiple>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Product Videos</h5>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label form-label-title">Video
                                    Provider</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single w-100" name="state">
                                        <option>Vimeo</option>
                                        <option>Youtube</option>
                                        <option>Dailymotion</option>
                                        <option>Vimeo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Video
                                    Link</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" placeholder="Video Link">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>





                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Search engine listing</h5>
                        </div>

                        <div class="seo-view">
                            <span class="link">https://fastkart.com</span>
                            <h5>Buy fresh vegetables & Fruits online at best price</h5>
                            <p>Online Vegetable Store - Buy fresh vegetables & Fruits online at best
                                prices. Order online and get free delivery.</p>
                        </div>

                        <form class="theme-form theme-form-2 mega-form">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Page title</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search" placeholder="Fresh Fruits">
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label class="form-label-title col-sm-3 mb-0">Meta
                                    description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">URL handle</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="search"
                                        placeholder="https://fastkart.com/fresh-veggies">
                                </div>
                            </div>
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

    <!-- ck editor js -->
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor-custom.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
