@extends('layouts.client')

@section('css')
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #009688;">RÚT TIỀN VỀ NGÂN HÀNG</h2>

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('rut-tien.xuly') }}" class="card p-4 shadow"
            style="max-width: 600px; margin: 0 auto; border-radius: 16px;">
            @csrf

            <!-- Ô chọn ngân hàng dạng hiển thị -->
            <div class="mb-3">
                <label class="form-label">Ngân hàng nhận tiền</label>
                <div class="position-relative">
                    <input type="hidden" name="ngan_hang" id="ngan_hang" required>
                    <input type="text" id="ngan_hang_label" class="form-control" placeholder="-- Chọn ngân hàng --" readonly required
                        data-bs-toggle="modal" data-bs-target="#bankModal" style="cursor: pointer;">
                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="pointer-events: none;">
                        <i class="fas fa-chevron-down text-muted"></i>
                    </span>
                </div>
            </div>
            
            <!-- Modal popup chọn ngân hàng -->
            <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content" style="border-radius: 16px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bankModalLabel">Chọn ngân hàng</h5>
                       
                                
                          
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-2 row-cols-md-4 g-3">
                                
                                <input type="text" id="searchBank" class="form-control form-control-lg" placeholder="🔍 Tìm ngân hàng theo tên..." style="border-radius: 12px;">
                                @foreach($nganHangs as $code => $bank)
                                <div class="col bank-item">
                                    <div class="card h-100 bank-card text-center p-2" style="cursor: pointer;"
                                        onclick="selectBank('{{ $code }}', '{{ $bank['name'] }}', '{{ $bank['logo'] }}')">
                                        <img src="{{ $bank['logo'] }}" class="img-fluid"
                                            style="height: 50px; object-fit: contain;" alt="{{ $bank['name'] }}">
                                        <div class="mt-2 fw-bold bank-name" style="font-size: 14px;">{{ $bank['name'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Số tài khoản -->
            <div class="mb-3">
                <label for="so_tai_khoan" class="form-label">Số tài khoản ngân hàng</label>
                <input type="text" name="so_tai_khoan" id="so_tai_khoan" class="form-control" required>
            </div>

            <!-- Tên người nhận -->
            <div class="mb-3">
                <label for="ten_nguoi_nhan" class="form-label">Tên người nhận</label>
                <input type="text" name="ten_nguoi_nhan" id="ten_nguoi_nhan" class="form-control" required>
            </div>

            <!-- Số tiền -->
            <div class="mb-3">
                <label for="so_tien" class="form-label">Số tiền muốn rút (VNĐ)</label>
                <input type="number" name="so_tien" id="so_tien" class="form-control" required min="10000">
            </div>

            <!-- Nút xác nhận -->
            <button type="submit" class="btn btn-success w-100" style="background-color: #009688; border: none;">
                <i class="fas fa-paper-plane me-2"></i> Gửi yêu cầu rút tiền
            </button>

            <p class="text-muted text-center mt-3" style="font-size: 0.9rem;">
                Thời gian xử lý có thể mất đến 24h. Phí rút: 0đ.
            </p>
        </form>
    </div>
@endsection

@section('js')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- tìm kiếm --}}
    <script>
        document.getElementById('searchBank').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('.bank-item').forEach(item => {
                const name = item.querySelector('.bank-name').textContent.toLowerCase();
                if (name.includes(keyword)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
    
    <script>
        function selectBank(code, name, logo) {
            // Gán giá trị vào input
            document.getElementById('ngan_hang').value = code;
            document.getElementById('ngan_hang_label').value = name;
    
            // Lấy modal và ẩn nó đúng cách bằng Bootstrap 5
            const modalElement = document.getElementById('bankModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
    
            // Remove backdrop nếu cần
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
    
            // Remove class 'modal-open' để body scroll lại
            document.body.classList.remove('modal-open');
            document.body.style.overflow = ''; // Cho phép scroll lại
        }
    </script>
@endsection