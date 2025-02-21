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
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Username</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Số điện thoại:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('so_dien_thoai') is-invalid @enderror" type="number" placeholder="Enter Your Number"
                                            value="{{ $user->so_dien_thoai }}" name="so_dien_thoai">
                                        </div>
                                        @error('so_dien_thoai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Địa chỉ email:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                placeholder="Enter Your Email Address" value="{{ $user->email }}" name="email">
                                        </div>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">Photo</label>

                                        <div class="col-sm-10">
                                            <input class="form-control form-choose" type="file" id="formFileMultiple"
                                                multiple name="anh_dai_dien">
                                            @if ($user->anh_dai_dien)
                                                <img style="width: 100px;height: 100px" src="{{ Storage::url($user->anh_dai_dien) }}" alt="">
                                            @endif
                                        </div>

                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">Trạng thái</label>
                                        @if ($user->trang_thai == 1)
                                        <div class="col-sm-10">
                                        <div class="status-close">
                                            <span >Hoạt động</span>
                                        </div>
                                        </div>
                                        @else
                                        <div class="col-sm-10">
                                            <div class="status-danger">
                                                <span>Không hoạt động</span>
                                            </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <input onclick="showNotification()" class="btn btn-solid" type="submit" value="Lưu">
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
