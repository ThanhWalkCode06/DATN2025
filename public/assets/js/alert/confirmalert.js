function confirmDelete(event, element) {
    event.preventDefault(); // Ngăn chặn chuyển hướng ngay lập tức

    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: 'Hành động này không thể hoàn tác!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Có, xóa!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = element.href; // Chuyển hướng đến route xóa
        }
    });
}
