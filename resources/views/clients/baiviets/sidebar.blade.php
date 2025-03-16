<div class="col-xxl-3 col-xl-4 col-lg-5">
    <div class="left-sidebar-box wow fadeInUp">
        <div class="accordion left-accordion-box" id="accordionExample">

            <div class="left-search-box">
                <div class="search-box">
                    <form action="{{ route('baiviets.danhsach') }}" method="GET">
                        <input type="text" class="form-control" name="search" id="searchInput"
                            placeholder="Nhập tiêu đề bài viết..." value="{{ request('search') }}"
                            onkeyup="handleSearch()">
                        <button type="submit" style="display: none;"></button>
                    </form>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#categoryList">
                        Danh Mục Bài Viết
                    </button>
                </h2>
                <div id="categoryList" class="accordion-collapse collapse show">
                    <div class="accordion-body pt-0">
                        <ul class="list-unstyled">
                            @foreach ($danhMucBaiViets as $danhMuc)
                                <li class="d-flex justify-content-between align-items-center py-2">
                                    <a href="{{ route('baiviets.danhsach', ['danh_muc' => $danhMuc->id]) }}"
                                        class="text-secondary text-decoration-none fw-bold">
                                        {{ $danhMuc->ten_danh_muc }}
                                    </a>
                                    <span class="badge rounded-circle bg-success text-white px-2 py-1">
                                        {{ $danhMuc->baiViets->count() }}
                                    </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#recentPosts">
                        Bài Viết Gần Đây
                    </button>
                </h2>
                <div id="recentPosts" class="accordion-collapse collapse show">
                    <div class="accordion-body pt-0">
                        <ul class="list-group">
                            @foreach ($baiVietGanDay as $bv)
                                <li class="list-group-item d-flex align-items-center">
                                    <a href="{{ route('baiviets.chitiet', $bv->id) }}" class="recent-image">
                                        <img src="{{ asset('uploads/' . $bv->hinh_anh) }}" class="img-fluid rounded"
                                            alt="{{ $bv->tieu_de }}"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </a>
                                    <div class="ms-3">
                                        <a href="{{ route('baiviets.chitiet', $bv->id) }}">
                                            <h6 class="mb-1">{{ $bv->tieu_de }}</h6>
                                        </a>
                                        <small class="text-muted">{{ $bv->created_at->format('d M, Y') }}
                                            <i class="fas fa-thumbs-up ms-1"></i>
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
