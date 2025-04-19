<style>
    .blog-image {
        width: 300px;
        height: 180px;
        overflow: hidden;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 8px;
    }
</style>
@extends('layouts.client')

@section('content')
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4">

                        @foreach ($baiViets as $baiViet)
                            <div class="col-12">
                                <div class="blog-box blog-list wow fadeInUp">
                                    <!-- Hình ảnh bài viết -->
                                    <div class="blog-image flex-shrink-0 me-3"
                                        style="width: 340px; height: 217px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $baiViet->anh_bia) }}" class="blog-image-full"
                                            alt="{{ $baiViet->tieu_de }}">
                                    </div>


                                    <div class="blog-contain blog-contain-2">
                                        <div class="d-flex align-items-center text-muted mb-2">
                                            <i class="fa-regular fa-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($baiViet->created_at)->format('d M, Y') }}
                                            &nbsp; | &nbsp;
                                            <i class="fa-regular fa-user me-1"></i>
                                            {{ $baiViet->user->ten_nguoi_dung }}
                                        </div>

                                        <a href="{{ route('baiviets.chitiet', $baiViet->id) }}">
                                            <h3 class="">{{ $baiViet->tieu_de }}</h3>
                                        </a>

                                        <p class="text-muted">{!! Str::limit(strip_tags($baiViet->noi_dung), 150) !!}</p>

                                        <button onclick="location.href = '{{ route('baiviets.chitiet', $baiViet->id) }}';"
                                            class="blog-button">Chi
                                            Tiết <i class="fa-solid fa-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $baiViets->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <!-- Sidebar -->
                @include('clients.baiviets.sidebar')
            </div>
        </div>
    </section>
@endsection


{{-- <!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Công Nghệ - Trang Bài Viết</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; color: #333; line-height: 1.8; padding: 20px; }
    header, footer { text-align: center; background: #0d6efd; color: white; padding: 20px; border-radius: 10px; }
    nav { margin: 20px 0; padding: 10px 20px; background: white; border-radius: 10px; display: flex; gap: 15px; }
    nav a { color: #0d6efd; font-weight: bold; text-decoration: none; }
    nav a:hover { text-decoration: underline; }

    .container { max-width: 1200px; margin: auto; display: flex; gap: 20px; }
    .main-content { flex: 3; }
    .post-card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.2s; }
    .post-card:hover { background: #f1f1f1; }
    .post-title { font-size: 1.5rem; margin-bottom: 10px; color: #0d6efd; }
    .post-excerpt { color: #555; }

    .detail-view { display: none; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.05); margin-bottom: 30px; }
    .detail-title { font-size: 2rem; color: #0d6efd; margin-bottom: 10px; }
    .detail-meta { color: #999; margin-bottom: 20px; }
    .detail-content p { margin-bottom: 15px; text-align: justify; }
    .detail-content img { max-width: 100%; border-radius: 10px; margin: 20px 0; }
    .back-btn { display: inline-block; margin-top: 20px; color: #0d6efd; cursor: pointer; text-decoration: underline; }

    .sidebar { flex: 1; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }

    footer { margin-top: 40px; font-size: 0.9rem; }
  </style>
</head>
<body>
  <header>
    <h1>Blog Lập Trình & Công Nghệ</h1>
  </header>

  <nav>
    <a href="#">Trang chủ</a>
    <a href="#">Bài viết</a>
    <a href="#">Liên hệ</a>
  </nav>

  <div class="container">
    <div class="main-content">

      <!-- Danh sách bài viết -->
      <div class="post-card" onclick="showDetail(1)">
        <h2 class="post-title">Làm quen với Laravel cho người mới bắt đầu</h2>
        <p class="post-excerpt">Laravel là framework mạnh mẽ và thân thiện, phù hợp cho cả người mới và chuyên nghiệp...</p>
      </div>
      <div class="post-card" onclick="showDetail(2)">
        <h2 class="post-title">Tại sao nên học PHP và Laravel năm 2025?</h2>
        <p class="post-excerpt">Dù có nhiều ngôn ngữ lập trình mới, PHP vẫn giữ vững vị trí trong phát triển web nhờ vào Laravel...</p>
      </div>
      <div class="post-card" onclick="showDetail(3)">
        <h2 class="post-title">Hướng dẫn tạo RESTful API với Laravel</h2>
        <p class="post-excerpt">Việc xây dựng API trong Laravel rất dễ dàng với Route Resource và Eloquent Model...</p>
      </div>
      <div class="post-card" onclick="showDetail(4)">
        <h2 class="post-title">Sử dụng Livewire để tạo giao diện tương tác</h2>
        <p class="post-excerpt">Livewire là công cụ mạnh mẽ giúp bạn tạo các giao diện hiện đại mà không cần JavaScript...</p>
      </div>
      <div class="post-card" onclick="showDetail(5)">
        <h2 class="post-title">Deploy Laravel lên hosting cPanel</h2>
        <p class="post-excerpt">Triển khai Laravel lên hosting có thể gây khó khăn nếu bạn chưa từng làm qua. Hãy cùng tìm hiểu cách đơn giản nhất...</p>
      </div>
      <div class="post-card" onclick="showDetail(6)">
        <h2 class="post-title">Tối ưu hiệu suất website Laravel</h2>
        <p class="post-excerpt">Làm sao để Laravel chạy nhanh hơn, phản hồi nhanh hơn? Hãy áp dụng các kỹ thuật cache, eager loading, queue...</p>
      </div>

      <!-- Chi tiết bài viết (1->6) -->
      <div class="detail-view" id="detail-1">
        <h2 class="detail-title">Làm quen với Laravel cho người mới bắt đầu</h2>
        <div class="detail-meta">Đăng ngày 19/04/2025 bởi Admin</div>
        <div class="detail-content">
          <p>Laravel là framework PHP phổ biến với cú pháp rõ ràng, dễ đọc và dễ bảo trì. Bắt đầu với Laravel, bạn sẽ được tiếp cận hệ thống routing, middleware, blade template...</p>
          <img src="https://picsum.photos/800/400?random=1">
          <p>Laravel còn hỗ trợ Eloquent ORM, hệ thống command artisan mạnh mẽ và tích hợp đầy đủ các gói package...</p>
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
      <div class="detail-view" id="detail-2">
        <h2 class="detail-title">Tại sao nên học PHP và Laravel năm 2025?</h2>
        <div class="detail-meta">Đăng ngày 18/04/2025 bởi Admin</div>
        <div class="detail-content">
          Trí Tuệ Nhân Tạo: Từ Giấc Mơ Khoa Học Viễn Tưởng Đến Thực Tế Đầy Tiềm Năng
Trong nhiều thập kỷ, trí tuệ nhân tạo (AI) từng chỉ là một khái niệm nằm trong những bộ phim khoa học viễn tưởng. Tuy nhiên, đến nay, nó đã trở thành một trong những công nghệ chủ chốt làm thay đổi thế giới. Với sự phát triển vượt bậc của phần cứng và các thuật toán học sâu (deep learning), AI không còn là thứ xa vời mà đang hiện diện trong từng khía cạnh của đời sống hiện đại.

🧩 AI là gì?
AI là lĩnh vực trong khoa học máy tính tập trung vào việc tạo ra các hệ thống có thể thực hiện các nhiệm vụ mà trước đây chỉ có con người mới làm được như học hỏi, suy nghĩ logic, nhận diện hình ảnh, xử lý ngôn ngữ tự nhiên, và thậm chí là ra quyết định.

Công nghệ AI hiện đại có thể được chia thành hai dạng chính:

AI hẹp (Narrow AI): Là loại AI được thiết kế để thực hiện một nhiệm vụ cụ thể, ví dụ như chatbot hỗ trợ khách hàng hoặc nhận diện khuôn mặt trong camera an ninh.

AI tổng quát (General AI): Là dạng AI vẫn đang trong quá trình nghiên cứu, có khả năng hiểu biết và học hỏi mọi kỹ năng mà con người có thể làm.

🛠️ Ứng dụng thực tiễn của AI
Y tế: AI đang được sử dụng để hỗ trợ chẩn đoán bệnh như ung thư, dự đoán khả năng tái phát, và tối ưu hoá phác đồ điều trị cá nhân hoá.

Giao thông: Xe tự lái là một ví dụ điển hình, sử dụng mạng nơ-ron và học máy để nhận diện vật thể, đọc biển báo và xử lý tình huống giao thông.

Thương mại điện tử: Từ đề xuất sản phẩm đến chatbot bán hàng, AI đang góp phần tạo ra trải nghiệm mua sắm cá nhân hóa và hiệu quả hơn.

Ngân hàng và tài chính: AI giúp phát hiện gian lận, tự động hóa quy trình kiểm toán và tư vấn đầu tư thông minh.

Giáo dục: AI hỗ trợ xây dựng chương trình học cá nhân hóa, chấm điểm tự động và tạo nội dung giáo dục phù hợp với từng học viên.

⚖️ Những thách thức và lo ngại
Bên cạnh những tiềm năng to lớn, AI cũng mang đến nhiều câu hỏi đáng suy ngẫm:

Liệu AI có thay thế lao động con người?

AI có thể tạo ra thành kiến nếu dữ liệu huấn luyện không đa dạng?

Làm sao để kiểm soát đạo đức của AI khi nó ra quyết định?

Chính vì vậy, các chuyên gia đang kêu gọi xây dựng một khung pháp lý và đạo đức rõ ràng để đảm bảo AI phục vụ lợi ích chung của xã hội.

🌐 Tương lai của AI
AI sẽ tiếp tục phát triển mạnh mẽ trong 5–10 năm tới. Những công nghệ như AI sáng tạo (generative AI), AI đạo đức, và kết hợp AI với công nghệ lượng tử có thể tạo ra các bước nhảy vọt. Con người không chỉ là người dùng công nghệ mà sẽ là người đồng hành và cộng tác cùng AI trong hầu hết lĩnh vực đời sống.
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
      <div class="detail-view" id="detail-3">
        <h2 class="detail-title">Hướng dẫn tạo RESTful API với Laravel</h2>
        <div class="detail-meta">Đăng ngày 17/04/2025 bởi Admin</div>
        <div class="detail-content">
          <p>Laravel cung cấp Route::resource giúp bạn tạo các endpoint chuẩn RESTful chỉ trong vài dòng code.</p>
          <img src="https://picsum.photos/800/400?random=3">
          <p>Bạn nên sử dụng Postman để test API và dùng Laravel Sanctum hoặc Passport cho bảo mật.</p>
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
      <div class="detail-view" id="detail-4">
        <h2 class="detail-title">Sử dụng Livewire để tạo giao diện tương tác</h2>
        <div class="detail-meta">Đăng ngày 16/04/2025 bởi Admin</div>
        <div class="detail-content">
          <p>Livewire cho phép bạn xây dựng các thành phần tương tác mà không cần viết JavaScript phức tạp.</p>
          <img src="https://picsum.photos/800/400?random=4">
          <p>Hãy thử tạo các component như form liên hệ, modal, hoặc pagination động bằng Livewire.</p>
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
      <div class="detail-view" id="detail-5">
        <h2 class="detail-title">Deploy Laravel lên hosting cPanel</h2>
        <div class="detail-meta">Đăng ngày 15/04/2025 bởi Admin</div>
        <div class="detail-content">
          <p>Sử dụng FTP hoặc File Manager để upload code, chỉnh sửa file `.env`, chạy `composer install`, và `php artisan migrate`.</p>
          <img src="https://picsum.photos/800/400?random=5">
          <p>Đừng quên cấu hình thư mục public làm thư mục gốc (document root).</p>
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
      <div class="detail-view" id="detail-6">
        <h2 class="detail-title">Tối ưu hiệu suất website Laravel</h2>
        <div class="detail-meta">Đăng ngày 14/04/2025 bởi Admin</div>
        <div class="detail-content">
          <p>Cache route, view và config bằng Artisan để cải thiện tốc độ. Sử dụng queue và lazy loading để tiết kiệm tài nguyên.</p>
          <img src="https://picsum.photos/800/400?random=6">
          <p>Giám sát hệ thống với Laravel Telescope hoặc Horizon nếu bạn dùng queue.</p>
        </div>
        <div class="back-btn" onclick="hideDetails()">← Quay lại danh sách bài viết</div>
      </div>
    </div>

    <div class="sidebar">
      <h3>Bài viết nổi bật</h3>
      <ul>
        <li><a href="#" onclick="showDetail(1)">Laravel cơ bản</a></li>
        <li><a href="#" onclick="showDetail(2)">Học PHP năm 2025</a></li>
        <li><a href="#" onclick="showDetail(3)">Tạo API</a></li>
        <li><a href="#" onclick="showDetail(4)">Giao diện Livewire</a></li>
        <li><a href="#" onclick="showDetail(5)">Deploy hosting</a></li>
        <li><a href="#" onclick="showDetail(6)">Tối ưu hiệu suất</a></li>
      </ul>
    </div>
  </div>

  <footer>
    &copy; 2025 Blog Công Nghệ. Thiết kế bởi bạn.
  </footer>

  <script>
    function showDetail(id) {
      document.querySelectorAll('.post-card').forEach(p => p.style.display = 'none');
      document.querySelectorAll('.detail-view').forEach(d => d.style.display = 'none');
      document.getElementById('detail-' + id).style.display = 'block';
    }
    function hideDetails() {
      document.querySelectorAll('.post-card').forEach(p => p.style.display = 'block');
      document.querySelectorAll('.detail-view').forEach(d => d.style.display = 'none');
    }
  </script>
</body>
</html>
 --}}
