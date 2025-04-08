@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: #009688;">Nạp tiền vào ví</h2>

    <form method="POST" action="{{ route('nap-tien.xuly') }}" id="form-nap-tien">
        @csrf
        <div class="mb-3">
            <label for="so_tien" class="form-label">Số tiền cần nạp (VNĐ)</label>
            <input type="number" name="so_tien" id="so_tien" class="form-control" required min="1000">
        </div>

        <button type="submit" class="btn btn-success" style="background-color: #009688; border: none;">
            <i class="fas fa-wallet me-2"></i> Nạp tiền qua VNPAY
        </button>
    </form>

    <script>
        document.getElementById('form-nap-tien').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const result = await response.json();

            if (result.status === 'success') {
                window.location.href = result.url;
            } else {
                alert(result.message || 'Có lỗi xảy ra khi tạo yêu cầu thanh toán.');
            }
        });
    </script>
</div>
@endsection
