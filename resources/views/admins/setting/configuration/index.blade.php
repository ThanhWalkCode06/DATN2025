@extends('layouts.admin')
@section('title')
Cấu hình website
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">

    <!-- Feather icon css-->
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
<div class="container mt-4">
    <h2 class="pb-3">Cấu Hình Hệ Thống</h2>

    <ul class="nav nav-tabs" id="settingsTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#emailSettings" onclick="saveTab('#emailSettings')">Cấu Hình Email</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#generalSettings" onclick="saveTab('#generalSettings')">Cấu Hình Chung</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Cấu hình Email -->
        <div id="emailSettings" class="tab-pane fade show active">
            <form action="{{ route('configuration.setting-mail') }}" method="POST">
                @csrf
            <div class="row">
                <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Mailer</label>
                    <input type="text" name="MAIL_MAILER" class="form-control" value="{{ env('MAIL_MAILER', 'smtp') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Host</label>
                    <input type="text" name="MAIL_HOST" class="form-control" value="{{ env('MAIL_HOST') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Port</label>
                    <input type="text" name="MAIL_PORT" class="form-control" value="{{ env('MAIL_PORT', '587') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="MAIL_USERNAME" class="form-control" value="{{ env('MAIL_USERNAME') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="MAIL_PASSWORD" class="form-control" value="{{ env('MAIL_PASSWORD') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Encryption</label>
                    <input type="text" name="MAIL_ENCRYPTION" class="form-control" value="{{ env('MAIL_ENCRYPTION', 'tls') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">From Address</label>
                    <input type="email" name="MAIL_FROM_ADDRESS" class="form-control" value="{{ env('MAIL_FROM_ADDRESS') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">From Name</label>
                    <input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{ env('MAIL_FROM_NAME') }}">
                </div>
            </div>
            </div>
                <button type="submit" class="btn btn-primary">Lưu Cấu Hình Email</button>
            </form>
        </div>

        <!-- Cấu hình Chung -->
        <div id="generalSettings" class="tab-pane fade">
            <form action="{{ route('configuration.common') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="mb-3">
                    <label class="form-label">Tên Website</label>
                    <input type="text" name="APP_NAME" class="form-control" value="{{ env('APP_NAME', 'Laravel') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ </label>
                    <input type="text" name="dia_chi" class="form-control" value="{{ env('dia_chi','Hà Nội') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="sdt" class="form-control" value="{{ env('sdt','0387660612') }}">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" >
                    @error('logo')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <img style="width:150px; height: 100px" class="img-fluid for-white" src="{{  Storage::url($globalSetting->logo ?? 'storage/logo.webp')  }}" alt="logo">
                <button type="submit" class="btn btn-primary">Lưu Cấu Hình Chung</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let activeTab = localStorage.getItem("activeTab") || "#emailSettings"; // Mặc định là tab đầu tiên
        let currentTab = document.querySelector(`[href="${activeTab}"]`);

        if (currentTab) {
            document.querySelectorAll(".nav-link").forEach(tab => tab.classList.remove("active"));
            document.querySelectorAll(".tab-pane").forEach(tab => tab.classList.remove("show", "active"));

            currentTab.classList.add("active");
            document.querySelector(activeTab).classList.add("show", "active");
        }
    });

    function saveTab(tabId) {
        localStorage.setItem("activeTab", tabId);
    }
</script>

@endsection

@section('js')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!--Dropzon js -->
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>

    <!-- select2 js -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-custom.js') }}"></script>
@endsection
