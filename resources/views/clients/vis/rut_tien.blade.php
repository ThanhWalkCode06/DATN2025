@extends('layouts.client')
@section('title', 'Rút tiền')
{{-- @section('css')
   
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
   
{{-- @endsection --}} 

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #009688;">RÚT TIỀN VỀ NGÂN HÀNG</h2>

        {{-- @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif --}}

        <form method="POST" onsubmit="return validateForm()" action="{{ route('rut-tien.xuly') }}" class="card p-4 shadow"
            style="max-width: 600px; margin: 0 auto; border-radius: 16px;">
            @csrf

            <!-- Ô chọn ngân hàng dạng hiển thị -->
            <div class="mb-3">
                <label class="form-label">Ngân hàng nhận tiền</label>
                <div class="position-relative">
                    <input type="hidden" name="ten_ngan_hang" id="ten_ngan_hang" required>
                    <input type="text" id="ngan_hang_label" class="form-control" placeholder="-- Chọn ngân hàng --" readonly required
                        data-bs-toggle="modal" data-bs-target="#bankModal" style="cursor: pointer;">
                    <span class="position-absolute top-50 end-0 translate-middle-y pe-3" style="pointer-events: none;">
                        <i class="fas fa-chevron-down text-muted"></i>
                    </span>
                </div>
                  <!-- Thêm thông báo lỗi ở đây -->
    <div id="ngan_hang_error" class="invalid-feedback" style="display: none;"></div>
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
                <input type="number" name="so_tai_khoan" id="so_tai_khoan" class="form-control" >
                <div class="invalid-feedback" id="so_tai_khoan_error"></div> <!-- Thông báo lỗi -->
            </div>

            <!-- Tên người nhận -->
            <div class="mb-3">
                <label for="ten_nguoi_nhan" class="form-label">Tên người nhận (ví dụ: NGUYEN VAN A)</label>
                <input type="text" name="ten_nguoi_nhan" id="ten_nguoi_nhan" class="form-control" >
                <div class="invalid-feedback" id="ten_nguoi_nhan_error"></div> <!-- Thông báo lỗi -->
            </div>

            <!-- Số tiền -->
            <div class="mb-3">
                <label for="so_tien" class="form-label">Số tiền muốn rút (VNĐ)</label>
                <input type="number" name="so_tien" id="so_tien" class="form-control"  >
                <div class="invalid-feedback" id="so_tien_error"></div> <!-- Thông báo lỗi -->
            </div>

            <!-- Checkbox xác nhận -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="xac_nhan" >
                <label class="form-check-label" for="xac_nhan">
                    Tôi xác nhận thông tin đã nhập là chính xác.
                </label>
                <div class="invalid-feedback" id="xac_nhan_error"></div> <!-- Thông báo lỗi -->
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
    
<script>
   function validateForm() {
    let isValid = true;

    // Reset thông báo lỗi cũ
    document.querySelectorAll('.invalid-feedback').forEach(element => {
        element.textContent = '';
        element.style.display = 'none';
    });

    // Kiểm tra chọn ngân hàng
const tenNganHang = document.getElementById('ten_ngan_hang').value.trim();
if (tenNganHang === '') {
    document.getElementById('ngan_hang_label').classList.add('is-invalid');
    document.getElementById('ngan_hang_error').textContent = 'Vui lòng chọn ngân hàng.';
    document.getElementById('ngan_hang_error').style.display = 'block';
    isValid = false;
} else {
    document.getElementById('ngan_hang_label').classList.remove('is-invalid');
    document.getElementById('ngan_hang_error').style.display = 'none';
}


    // Kiểm tra số tài khoản
    const soTaiKhoan = document.getElementById('so_tai_khoan').value.trim();
    const stkRegex = /^\d{8,16}$/;
    if (!stkRegex.test(soTaiKhoan)) {
        document.getElementById('so_tai_khoan_error').textContent = 'Số tài khoản phải từ 8 đến 16 chữ số.';
        document.getElementById('so_tai_khoan_error').style.display = 'block';
        document.getElementById('so_tai_khoan').classList.add('is-invalid');
        isValid = false;
    } else {
        document.getElementById('so_tai_khoan').classList.remove('is-invalid');
    }

   // Kiểm tra tên người nhận
const tenNguoiNhan = document.getElementById('ten_nguoi_nhan').value.trim();
const tenNguoiNhanError = document.getElementById('ten_nguoi_nhan_error');
const tenNguoiNhanInput = document.getElementById('ten_nguoi_nhan');

// Biểu thức chính quy cho chữ cái tiếng Anh (không dấu, chỉ a-z, A-Z và khoảng trắng)
const regexChiChuaChuTiengAnh = /^[a-zA-Z\s]+$/;

// Biểu thức chính quy yêu cầu ít nhất một nguyên âm (a, e, i, o, u, y)
const regexCoNguyenAm = /[aeiouy]/i;

// Kiểm tra tên người nhận
if (tenNguoiNhan === '') {
    tenNguoiNhanError.textContent = 'Vui lòng nhập tên người nhận.';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} else if (!regexChiChuaChuTiengAnh.test(tenNguoiNhan)) {
    tenNguoiNhanError.textContent = 'Tên người nhận chỉ được chứa chữ cái (không dấu).';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} else if (tenNguoiNhan.length < 2 || tenNguoiNhan.length > 50) {
    tenNguoiNhanError.textContent = 'Tên người nhận phải từ 2 đến 50 ký tự.';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} else if (!tenNguoiNhan.includes(' ') || tenNguoiNhan.split(/\s+/).filter(word => word).length < 2) {
    tenNguoiNhanError.textContent = 'Tên người nhận phải bao gồm họ và tên (ít nhất hai từ).';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
}else if (tenNguoiNhan.split(/\s+/).some(word => /(.)\1{1,}/.test(word))) {
    tenNguoiNhanError.textContent = 'Tên người nhận không được chứa ký tự lặp lại liên tiếp trong cùng một từ (ví dụ: KK).';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} else if (tenNguoiNhan !== tenNguoiNhan.toUpperCase()) {
    tenNguoiNhanError.textContent = 'Tên người nhận phải được viết in hoa toàn bộ (ví dụ: NGUYEN VAN A).';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} else if (!regexCoNguyenAm.test(tenNguoiNhan)) {
    tenNguoiNhanError.textContent = 'Tên người nhận phải chứa ít nhất một nguyên âm (A, E, I, O, U, Y).';
    tenNguoiNhanError.style.display = 'block';
    tenNguoiNhanInput.classList.add('is-invalid');
    isValid = false;
} 

else {
    tenNguoiNhanError.style.display = 'none';
    tenNguoiNhanInput.classList.remove('is-invalid');
}
    // Kiểm tra số tiền
    const soTien = document.getElementById('so_tien').value.trim();
    if (soTien < 10000) {
        document.getElementById('so_tien_error').textContent = 'Số tiền rút phải tối thiểu 10,000 VNĐ.';
        document.getElementById('so_tien_error').style.display = 'block';
        document.getElementById('so_tien').classList.add('is-invalid');
        isValid = false;
    } else {
        document.getElementById('so_tien').classList.remove('is-invalid');
    }

    // Kiểm tra checkbox xác nhận
    const checkbox = document.getElementById('xac_nhan');
    if (!checkbox.checked) {
        document.getElementById('xac_nhan_error').textContent = 'Vui lòng xác nhận thông tin trước khi gửi.';
        document.getElementById('xac_nhan_error').style.display = 'block';
        document.getElementById('xac_nhan').classList.add('is-invalid');
        isValid = false;
    } else {
        document.getElementById('xac_nhan').classList.remove('is-invalid');
    }

    return isValid;
}

</script>



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
    // Gán tên ngân hàng
    document.getElementById('ngan_hang_label').value = name;
    document.getElementById('ten_ngan_hang').value = name;

    // Lấy và ẩn modal đúng chuẩn Bootstrap
    const modalElement = document.getElementById('bankModal');

    // Kiểm tra nếu modal đang mở, mới gọi hide
    const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
    modalInstance.hide();

    // 🧼 Fix nếu Bootstrap không dọn sạch backdrop hoặc body
    setTimeout(() => {
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
    }, 300); // đợi Bootstrap xử lý xong modal (animation 300ms)
}

    </script>
@endsection