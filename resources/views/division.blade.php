<!-- resources/views/division.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Chọn đơn vị hành chính</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <select id="province" onchange="loadDistricts(this.value)">
        <option value="">Chọn tỉnh/thành</option>
    </select>
    <select id="district" onchange="loadWards(this.value)">
        <option value="">Chọn quận/huyện</option>
    </select>
    <select id="ward">
        <option value="">Chọn phường/xã</option>
    </select>

    <script>
        $(document).ready(function() {
            // Load provinces
            $.ajax({
                url: '/provinces',
                method: 'GET',
                success: function(data) {
                    console.log('Provinces:', data); // Debug
                    $.each(data, function(index, province) {
                        $('#province').append(`<option value="${province.code}">${province.name}</option>`);
                    });
                },
                error: function(xhr) {
                    console.error('Lỗi khi lấy tỉnh/thành:', xhr.responseText);
                }
            });
        });

        function loadDistricts(provinceId) {
            $('#district').html('<option value="">Chọn quận/huyện</option>');
            $('#ward').html('<option value="">Chọn phường/xã</option>');
            if (provinceId) {
                $.ajax({
                    url: `/districts/${provinceId}`,
                    method: 'GET',
                    success: function(data) {
                        console.log('Districts:', data); // Debug
                        if (data.length === 0) {
                            console.warn('Không có quận/huyện cho provinceId:', provinceId);
                        }
                        $.each(data, function(index, district) {
                            $('#district').append(`<option value="${district.code}">${district.name}</option>`);
                        });
                    },
                    error: function(xhr) {
                        console.error('Lỗi khi lấy quận/huyện:', xhr.responseText);
                    }
                });
            }
        }

        function loadWards(districtId) {
            $('#ward').html('<option value="">Chọn phường/xã</option>');
            if (districtId) {
                $.ajax({
                    url: `/wards/${districtId}`,
                    method: 'GET',
                    success: function(data) {
                        console.log('Wards:', data); // Debug
                        if (data.length === 0) {
                            console.warn('Không có phường/xã cho districtId:', districtId);
                        }
                        $.each(data, function(index, ward) {
                            $('#ward').append(`<option value="${ward.code}">${ward.name}</option>`);
                        });
                    },
                    error: function(xhr) {
                        console.error('Lỗi khi lấy phường/xã:', xhr.responseText);
                    }
                });
            }
        }
    </script>
</body>
</html>
