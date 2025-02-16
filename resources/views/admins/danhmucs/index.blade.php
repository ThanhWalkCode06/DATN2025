@extends('layouts.admin')

@section('title')
    Danh mục sản phẩm
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css-->
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
                    <h5>Quản lý danh mục</h5>

                </div>

                <div class="table-responsive category-table">
                    <div>
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <th>Ảnh danh mục</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Áo dài tay</td>


                                    <td>
                                        <div class="table-image">
                                            <img src="https://th.bing.com/th/id/OIP.5lVZVJxK63aTGaVvj-ATzAHaHa?rs=1&pid=ImgDetMain" class="img-fluid" alt="">
                                        </div>
                                    </td>

                          


                                    <td>
                                        <ul>
                                        

                                            <li>
                                                <a href="{{ route('danhmucs.edit',1) }}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Áo ngắn tay</td>


                                    <td>
                                        <div class="table-image">
                                            <img src="https://th.bing.com/th?id=OIF.RpWQcTsQUd%2byUmbK8OwTHw&rs=1&pid=ImgDetMain" class="img-fluid" alt="">
                                        </div>
                                    </td>



                                    <td>
                                        <ul>
                                            

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Quần dài</td>


                                    <td>
                                        <div class="table-image">
                                            <img src="https://th.bing.com/th/id/OIP.xYGVt4EpeIELcHgFB4TsHwHaLH?rs=1&pid=ImgDetMain" class="img-fluid" alt="">
                                        </div>
                                    </td>



                                    <td>
                                        <ul>

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Quần ngắn</td>


                                    <td>
                                        <div class="table-image">
                                            <img src="https://th.bing.com/th/id/R.84e05068c314e6833878b21571c8de88?rik=%2brbuZEd%2f52C6aQ&pid=ImgRaw&r=0" class="img-fluid" alt="">
                                        </div>
                                    </td>



                                    <td>
                                        <ul>
                                            

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Đồ bộ</td>


                                    <td>
                                        <div class="table-image">
                                            <img src="https://dongphuchaianh.vn/wp-content/uploads/2021/07/quan-ao-the-thao-nam-adidas-1.jpg" class="img-fluid" alt="">
                                        </div>
                                    </td>



                                    <td>
                                        <ul>
                                            

                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalToggle">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>


                            
                            </tbody>
                        </table>
                    </div>
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
