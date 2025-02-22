@extends('layouts.admin')

@section('title')
    Thuộc tính
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
                    <h5>Tất cả thuộc tính</h5>
                    <form class="d-inline-flex">
                        <a href="{{route('thuoctinhs.create')}}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus-square"></i>Thêm mới
                        </a>
                    </form>
                </div>

                @if (session('success'))
                                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{session('success')}} </strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    
                @endif

                @if (session('error'))
                                        
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{session('error')}} </strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    
                @endif
                <div class="table-responsive category-table">
                    <table class="table all-package theme-table" id="table_id">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thuộc tính</th>
                                <th>Giá trị thuộc tính</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($listThuocTinh as $index => $thuocTinh )
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$thuocTinh->ten_thuoc_tinh}}</td>
                                <td>{{ $thuocTinh->danh_sach_gia_tri}}</td> 
                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{route('thuoctinhs.edit',$thuocTinh->id)}}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                        </li>
                                        <li>
                                            
                                            <form action="{{route('thuoctinhs.destroy',$thuocTinh->id)}}" method="POST"
                                                onsubmit = "return confirm('xác nhận xoá')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </form> 
                                           
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {{ $listThuocTinh->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>


    
@endsection
