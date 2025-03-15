<div class="col-xxl-3 col-xl-4 col-lg-5">
    <div class="left-sidebar-box wow fadeInUp">
        <div class="accordion left-accordion-box" id="accordionExample">

            <div class="left-search-box">
                <div class="search-box">
                    <form action="{{ route('baiviets.danhsach') }}" method="GET">
                        <input type="text" class="form-control" name="search" id="searchInput"
                            placeholder="Nhập tiêu đề bài viết..."
                            value="{{ request('search') }}"
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
                        <ul class="list-group">
                            @foreach ($danhMucBaiViets as $danhMuc)
                                <li class="list-group-item">
                                    <a
                                        href="{{ route('baiviets.danhsach', ['danh_muc' => $danhMuc->id]) }}">{{ $danhMuc->ten_danh_muc }}</a>
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
                                <li class="list-group-item">
                                    <a href="{{ route('baiviets.chitiet', $bv->id) }}">{{ $bv->tieu_de }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
