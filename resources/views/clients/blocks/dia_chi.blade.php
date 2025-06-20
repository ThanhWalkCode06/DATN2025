<div class="row">
    <div class="col-md-4 mt-3">
        <label for="">Tỉnh thành:</label>
        <div style="display: flex;flex-direction: column-reverse">
            <select id="province" onchange="loadDistricts(this.value)" class="select2" name="province">
                <option value="">Chọn tỉnh/thành</option>
            </select>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <label for="">Quận / Huyện:</label>
        <div style="display: flex;flex-direction: column-reverse">
            <select id="district" onchange="loadWards(this.value)" class="select2" name="district">
                <option value="">Chọn quận/huyện</option>
            </select>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <label for="">Phường / Xã:</label>
        <div style="display: flex;flex-direction: column-reverse">
            <select id="ward" class="select2" name="ward">
                <option value="">Chọn phường/xã</option>
            </select>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editProfile')
         });
        // Load provinces
        $.ajax({
            url: '/provinces',
            method: 'GET',
            success: function(data) {
                console.log('Provinces:', data); // Debug
                $.each(data, function(index, province) {
                    $('#province').append(`<option value="${province.code}">${province.name}</option>`);
                });

                const oldProvince = $('#oldProvince').val();
                if (oldProvince) {
                    const matchedProvince = $('#province option').filter(function () {
                        return $(this).text().trim() === oldProvince.trim();
                    });

                    if (matchedProvince.length > 0) {
                        $('#province').val(matchedProvince.val()).trigger('change');
                    }
                }
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

                    const oldDistrict = $('#oldDistrict').val();
                    console.log(oldDistrict);
                    if (oldDistrict) {
                    const matchedDistrict = $('#district option').filter(function () {
                        return $(this).text().trim() === oldDistrict.trim();
                    });

                    if (matchedDistrict.length > 0) {
                        $('#district').val(matchedDistrict.val()).trigger('change');
                    }
                }
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

                    const oldWard = $('#oldWard').val();
                    if (oldWard) {
                        const matchedWard = $('#ward option').filter(function () {
                            return $(this).text().trim() === oldWard.trim();
                        });

                        if (matchedWard.length > 0) {
                            $('#ward').val(matchedWard.val()).trigger('change');
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Lỗi khi lấy phường/xã:', xhr.responseText);
                }
            });
        }
    }
</script>
