@extends('layouts.admin')
@section('title')
    Cài đặt thông tin
@endsection
@section('css')

@endsection
@section('content')

                <div class="col-sm-12">
                    <!-- Details Start -->
                    <div class="card">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>Profile Setting</h5>
                            </div>
                            <form class="theme-form theme-form-2 mega-form" action="{{ route('setting-infor.private') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class=" mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Tên tài khoản</label>
                                        <div class="col-sm-8">
                                            <input style="border: 1px solid #ced4da;"  class="form-control" type="text" value="{{ $user->username }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Họ và tên:</label>
                                        <div class="col-sm-8">
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('ten_nguoi_dung') is-invalid @enderror" type="text"
                                                placeholder="Enter Your Full Name " value="{{ $user->ten_nguoi_dung }}" name="ten_nguoi_dung">
                                        </div>
                                        @error('ten_nguoi_dung')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Số điện thoại:</label>
                                        <div class="col-sm-8">
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('so_dien_thoai') is-invalid @enderror" type="number" placeholder="Enter Your Number"
                                            value="{{ $user->so_dien_thoai }}" name="so_dien_thoai">
                                        </div>
                                        @error('so_dien_thoai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Địa chỉ email:</label>
                                        <div class="col-sm-8">
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('email') is-invalid @enderror" type="email"
                                                placeholder="Enter Your Email Address" value="{{ $user->email }}" name="email">
                                        </div>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">Photo</label>

                                        <div class="col-sm-8">
                                            <input  class="form-control form-choose" type="file" id="formFileMultiple"
                                                multiple name="anh_dai_dien">
                                            @if ($user->anh_dai_dien)
                                                <img style="width: 100px;height: 100px" src="{{ Storage::url($user->anh_dai_dien) }}" alt="">
                                            @endif
                                        </div>

                                    </div>

                                    @if(!empty($user->ngay_sinh))
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày sinh
                                            </label>
                                            <div class="col-md-9 col-lg-8">
                                                <input style="border: 1px solid #ced4da;" class="form-control " type="date" name="ngay_sinh"
                                                value="{{ $user->ngay_sinh }}">
                                                @error('ngay_sinh')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>
                                        </div>
                                    @else
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Ngày sinh
                                        </label>
                                        <div class="col-md-9 col-lg-8">
                                            <input style="border: 1px solid #ced4da;" class="form-control " type="date" name="ngay_sinh"
                                            value="{{ $user->ngay_sinh }}" readonly>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Địa chỉ
                                         </label>
                                        <div class="col-md-9 col-lg-8">
                                            <input style="border: 1px solid #ced4da;" class="form-control @error('dia_chi') is-invalid @enderror  @error('dia_chi') is-invalid @enderror" type="text"
                                            name="dia_chi" value="{{ $user->dia_chi }}">
                                            @error('dia_chi')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        </div>

                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Giới tính</label>
                                        <div class="col-lg-8 col-md-9 d-flex gap-3">
                                            <div class="form-check">
                                                <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="gioi_tinh_nam" name="gioi_tinh" value="1"
                                                {{ $user->gioi_tinh == 1 ? 'checked' : '' }}>
                                                <label for="gioi_tinh_nam" class="form-check-label ms-1">Nam</label>
                                            </div>
                                            <div class="form-check">
                                                <input style="border: 1px solid #ced4da;" type="radio" class="form-check-input" id="gioi_tinh_nu" name="gioi_tinh" value="0"
                                                {{ $user->gioi_tinh == 0 ? 'checked' : '' }}>
                                                <label for="gioi_tinh_nu" class="form-check-label ms-1">Nữ</label>
                                            </div>
                                            @error('gioi_tinh')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        </div>

                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">Trạng thái</label>
                                        @if ($user->trang_thai == 1)
                                        <div class="col-sm-8">
                                        <div class="status-close">
                                            <span >Hoạt động</span>
                                        </div>
                                        </div>
                                        @else
                                        <div class="col-sm-8">
                                            <div class="status-danger">
                                                <span>Không hoạt động</span>
                                            </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <input  class="btn btn-solid" type="submit" value="Lưu">
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Settings Section End -->
            </div>
            <!-- Page Body End-->


        </div>


@endsection
@section('js')
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endsection
