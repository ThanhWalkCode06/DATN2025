@extends('layouts.client')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #009688;">NẠP TIỀN</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="napTienForm" method="POST" action="{{ route('nap-tien.xuly') }}" class="card p-4 shadow"
            style="max-width: 500px; margin: 0 auto; border-radius: 16px;">
            @csrf
            <div class="mb-3">
                <label for="so_tien" class="form-label">Số tiền muốn nạp (VNĐ)</label>
                <input type="number" name="so_tien" id="so_tien" class="form-control">
                <div id="so_tien_error" class="invalid-feedback" style="display: none;"></div>
                <!-- Thông báo lỗi cho số tiền -->

            </div>

            <button type="submit" class="btn btn-success w-100" style="background-color: #009688; border: none;">
                <i class="fas fa-wallet me-2"></i> Nạp tiền qua VNPAY
            </button>
        </form>
    </div>

    <script>
        document.getElementById('napTienForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);
            let so_tien = formData.get('so_tien');
            let so_tien_input = document.getElementById('so_tien');
            let error_div = document.getElementById('so_tien_error');
            let isValid = true;

            // Validate số tiền nạp
            if (so_tien < 10000 || isNaN(so_tien)) {
                document.getElementById('so_tien_error').textContent = 'Vui lòng nhập số tiền lớn hơn hoặc bằng 10,000 VNĐ.';
                document.getElementById('so_tien_error').style.display = 'block';
                document.getElementById('so_tien').classList.add('is-invalid');
                isValid = false;
            }
            // else if (so_tien > 10000000) { // Giới hạn tối đa là 500 triệu VNĐ
            //     document.getElementById('so_tien_error').textContent = 'Số tiền nạp tối đa là 10,000,000 VNĐ.';
            //     document.getElementById('so_tien_error').style.display = 'block';
            //     document.getElementById('so_tien').classList.add('is-invalid');
            //     isValid = false;
            // }
            // else {
            //     document.getElementById('so_tien_error').style.display = 'none';
            //     document.getElementById('so_tien').classList.remove('is-invalid');
            // }



            if (!isValid) return;  // Nếu không hợp lệ, ngừng form submit

            // Nếu hợp lệ, gửi form
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            }).then(res => res.json()).then(data => {
                if (data.status === 'success') {
                    window.location.href = data.url;
                } else {
                    error_div.textContent = data.message;
                    error_div.style.display = 'block';
                    so_tien_input.classList.add('is-invalid');

                }
            }).catch(err => {
                console.error(err);
                error_div.textContent = 'Có lỗi xảy ra. Vui lòng thử lại.';
                error_div.style.display = 'block';
                so_tien_input.classList.add('is-invalid');

            });
        });
    </script>
@endsection