@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4" style="color: #009688;">NẠP TIỀN</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="napTienForm" method="POST" action="{{ route('nap-tien.xuly') }}" class="card p-4 shadow" style="max-width: 500px; margin: 0 auto; border-radius: 16px;">
        @csrf
        <div class="mb-3">
            <label for="so_tien" class="form-label">Số tiền muốn nạp (VNĐ)</label>
            <input type="number" name="so_tien" id="so_tien" class="form-control" required min="1000">
        </div>

        <button type="submit" class="btn btn-success w-100" style="background-color: #009688; border: none;">
            <i class="fas fa-wallet me-2"></i> Nạp tiền qua VNPAY
        </button>
    </form>
</div>

<script>
    document.getElementById('napTienForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);
        let so_tien = formData.get('so_tien');

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
                alert(data.message);
            }
        }).catch(err => {
            console.error(err);
            alert("Có lỗi xảy ra. Vui lòng thử lại.");
        });
    });
</script>
@endsection
