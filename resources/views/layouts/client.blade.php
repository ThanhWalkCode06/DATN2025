<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/iconly@latest/css/iconly.css">

    <!-- Google font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/vendors/bootstrap.css') }}">

    <!-- Wow css -->
    <link rel="stylesheet" href="{{ asset('assets/client/css/animate.min.css') }}">

    <!-- Iconly css -->
    {{--
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/bulk-style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/client/css/style.css') }}">

    <!-- Pusher -->
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    @yield('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/iconly@1.0.0/css/iconly.min.css">

    <style>
        .swal-custom-popup {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .swal-custom-title {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
        }

        .swal-custom-confirm {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
        }

        .swal-custom-cancel {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
        }

        .notify-alert-custom {
            background-color: #e74c3c !important;
            /* Màu đỏ cho ẩn bình luận */
            color: white !important;
            border: 1px solid #c0392b !important;
            border-radius: 6px;
            padding: 15px 20px;
            font-size: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .notify-alert-custom.success {
            background-color: #28a745 !important;
            /* Màu xanh lá cây cho hiển thị bình luận */
            border: 1px solid #218838 !important;
            /* Viền xanh đậm hơn */
        }

        .notify-alert-custom .title {
            font-weight: 600;
            color: #c0392b;
            /* Màu tiêu đề cho ẩn bình luận */
            font-size: 16px;
            margin-bottom: 5px;
        }

        .notify-alert-custom.success .title {
            color: #218838;
            /* Màu tiêu đề xanh đậm cho hiển thị bình luận */
        }

        .notify-alert-custom .message {
            font-weight: 400;
        }

        .animated.fadeInDown {
            animation: fadeInDown 0.5s;
        }

        .animated.fadeOutUp {
            animation: fadeOutUp 0.5s;
        }

        .notify-alert-custom .close {
            color: #fff;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .notify-alert-custom .close:hover {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-effect">
    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    @include('clients.blocks.header')
    <!-- Header End -->

    @yield('breadcrumb')

    @yield('content')

    <!-- Footer Section Start -->
    @include('clients.blocks.footer')
    <!-- Footer Section End -->

    @include('clients.blocks.extra')

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Latest jQuery -->
    <script src="{{ asset('assets/client/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/client/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/client/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/bootstrap/popper.min.js') }}"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/client/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload JS -->
    <script src="{{ asset('assets/client/js/lazysizes.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('assets/client/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/client/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height JS -->
    <script src="{{ asset('assets/client/js/auto-height.js') }}"></script>

    <!-- Price Range JS -->
    <script src="{{ asset('assets/client/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Sidebar Open JS -->
    <script src="{{ asset('assets/client/js/filter-sidebar.js') }}"></script>

    <!-- Quantity JS -->
    <script src="{{ asset('assets/client/js/quantity-2.js') }}"></script>

    <!-- Zoom JS -->
    <script src="{{ asset('assets/client/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/client/js/zoom-filter.js') }}"></script>

    <!-- Sticky Bar JS -->
    <script src="{{ asset('assets/client/js/sticky-cart-bottom.js') }}"></script>

    <!-- Timer JS -->
    <script src="{{ asset('assets/client/js/timer1.js') }}"></script>

    <!-- Fly Cart JS -->
    <script src="{{ asset('assets/client/js/fly-cart.js') }}"></script>

    <!-- Quantity JS -->
    <script src="{{ asset('assets/client/js/quantity-2.js') }}"></script>

    <!-- WOW JS -->
    <script src="{{ asset('assets/client/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/custom-wow.js') }}"></script>

    <!-- Script JS -->
    <script src="{{ asset('assets/client/js/script.js') }}"></script>

    <!-- Theme Setting JS -->
    <script src="{{ asset('assets/client/js/theme-setting.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('js')
    <script>
        // Pusher.logToConsole = true; // Bật debug Pusher

        var pusher = new Pusher("0ca5e8c271c25e1264d2", {
            cluster: "ap1",
            encrypted: true
        });

        var userId = {{ Auth::id() ?? 'null' }};
        if (userId !== 'null') {
            var channel = pusher.subscribe("comment-hidden-" + userId);

            // Hàm hỗ \n hỗ trợ viết hoa chữ cái đầu
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Xử lý sự kiện hide-comment
            channel.bind("hide-comment", function (data) {
                console.log('Nhận sự kiện hide-comment:', data);
                const productName = data.product_name ? capitalizeFirstLetter(data.product_name) : '';
                const productText = productName ? `<strong>Sản phẩm: ${productName}</strong>` : '';
                const reasonText = data.reasons ? `<br><strong>Lý do:</strong> ${data.reasons}` : '';

                $.notify({
                    title: "<strong>Thông báo từ hệ thống:</strong><br>",
                    message: `Đánh giá ở ${productText} của bạn đã bị ẩn bởi quản trị viên.${reasonText}`
                }, {
                    element: "body",
                    type: "danger",
                    allow_dismiss: true,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 5000,
                    z_index: 9999,
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp"
                    },
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert notify-alert-custom" role="alert">' +
                        '<button type="button" class="close" data-notify="dismiss" style="position: absolute; top: 5px; right: 5px; background: none; border: none; font-size: 16px; cursor: pointer;">&times;</button>' +
                        '<span data-notify="title">{1}</span>' +
                        '<span data-notify="message">{2}</span>' +
                        '</div>'
                });
            });

            // Xử lý sự kiện show-comment
            channel.bind("show-comment", function (data) {
                console.log('Nhận sự kiện show-comment:', data);
                const productName = data.product_name ? capitalizeFirstLetter(data.product_name) : '';
                const productText = productName ? `<strong>Sản phẩm: ${productName}</strong>` : '';

                $.notify({
                    title: "<strong>Thông báo từ hệ thống:</strong><br>",
                    message: `Đánh giá ở ${productText} của bạn đã được hiển thị lại bởi quản trị viên.`
                }, {
                    element: "body",
                    type: "success",
                    allow_dismiss: true,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    delay: 5000,
                    z_index: 9999,
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp"
                    },
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert notify-alert-custom success" role="alert">' +
                        '<button type="button" class="close" data-notify="dismiss" style="position: absolute; top: 5px; right: 5px; background: none; border: none; font-size: 16px; cursor: pointer;">&times;</button>' +
                        '<span data-notify="title">{1}</span>' +
                        '<span data-notify="message">{2}</span>' +
                        '</div>'
                });
            });
        } else {
            console.log('Người dùng chưa đăng nhập, không thể đăng ký kênh Pusher');
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Thành công!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Thất bại",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            });
        </script>
    @endif


    @isset(Auth::user()->id)
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const userId = {{ Auth::user()->id ?? 'null' }};
                const nguoiNhanId = 1; // Đối tác chat (admin ID = 1)

                // Hàm cập nhật số tin nhắn chưa đọc
                function updateUnreadCount() {
                    fetch(`/messages/${nguoiNhanId}`, {
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    })
                        .then(response => response.json())
                        .then(messages => {
                            const unreadCount = messages.filter(chat => chat.nguoi_nhan_id === userId && !chat.trang_thai).length;
                            console.log('Unread messages:', messages);
                            console.log('Unread count:', unreadCount);
                            const notificationElement = document.getElementById("unread-notification");
                            if (notificationElement) {
                                notificationElement.innerHTML = unreadCount > 0 ? `<span class="badge bg-danger">${unreadCount}</span>` : '';
                            }
                        })
                        .catch(error => console.error('Error updating unread count:', error));
                }

                // Gọi updateUnreadCount() khi trang tải
                updateUnreadCount();

                // Khi modal chat được mở
                const chatModal = document.getElementById('chat-box-modal');
                chatModal.addEventListener('shown.bs.modal', async function () {
                    try {
                        const response = await fetch(`/messages/${nguoiNhanId}`, {
                            headers: {
                                'Cache-Control': 'no-cache'
                            }
                        });
                        const messages = await response.json();

                        const chatBox = document.getElementById("chat-box");
                        chatBox.innerHTML = "";
                        const messageIds = new Set();

                        messages.forEach(chat => {
                            if (!messageIds.has(chat.id)) {
                                messageIds.add(chat.id);
                                let align = chat.nguoi_gui_id === userId ? "text-end" : "text-start";
                                let chatMessage = document.createElement("p");
                                chatMessage.classList.add(align);
                                chatMessage.dataset.id = chat.id;
                                chatMessage.innerHTML = `<strong>${chat.ten_nguoi_gui}:</strong> ${chat.noi_dung || ''}`;

                                if (chat.hinh_anh) {
                                    const ext = chat.hinh_anh.split('.').pop().toLowerCase();
                                    if (['mp4', 'webm', 'ogg'].includes(ext)) {
                                        chatMessage.innerHTML += `
                                            <br><video controls style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 5px;">
                                                <source src="${chat.hinh_anh}">
                                                Trình duyệt không hỗ trợ video.
                                            </video>`;
                                    } else {
                                        chatMessage.innerHTML += `<br><img src="${chat.hinh_anh}" style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 5px;">`;
                                    }
                                }

                                const timeSent = new Date(chat.created_at);
                                const timeString = timeSent.toLocaleString('vi-VN', {
                                    weekday: 'short',
                                    year: 'numeric',
                                    month: 'numeric',
                                    day: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric',
                                });
                                chatMessage.innerHTML += `<br><small class="text-muted">${timeString}</small>`;

                                chatBox.appendChild(chatMessage);
                            }
                        });
                        chatBox.scrollTop = chatBox.scrollHeight;

                        // Đánh dấu tin nhắn là đã đọc
                        const markAsReadResponse = await fetch(`/mark-as-read/${nguoiNhanId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Content-Type': 'application/json'
                            }
                        });
                        const markAsReadResult = await markAsReadResponse.json();
                        console.log('Mark as read response:', markAsReadResult);

                        // Cập nhật số tin nhắn chưa đọc
                        updateUnreadCount();
                    } catch (error) {
                        console.error("Lỗi khi tải tin nhắn:", error);
                    }
                });

                // Gửi tin nhắn khi form được submit
                document.getElementById("chat-form").addEventListener("submit", function(e) {
                    e.preventDefault();

                    const noiDungInput = document.getElementById("noi_dung");
                    const fileInput = document.getElementById("media");
                    const file = fileInput.files[0];
                    const noiDung = noiDungInput.value.trim();

                    if (!noiDung && !file) {
                        document.getElementById("chat-error").classList.remove("d-none");
                        document.getElementById("chat-error").innerText =
                            "Vui lòng gửi tin nhắn hoặc hình ảnh/video!";
                        return;
                    }

                    if (file) {
                        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif',
                            'image/webp', 'image/jfif'
                        ];
                        const validVideoTypes = ['video/mp4', 'video/webm', 'video/ogg'];

                        if (!validImageTypes.includes(file.type) && !validVideoTypes.includes(file.type)) {
                            document.getElementById("chat-error").classList.remove("d-none");
                            document.getElementById("chat-error").innerText =
                                "Định dạng file không hợp lệ! Chỉ hỗ trợ hình ảnh (JPG, JPEG, PNG, GIF, WEBP) và video (MP4, WEBM, OGG).";
                            return;
                        }

                        if (file.type.startsWith("video/") && file.size > 20 * 1024 * 1024) {
                            document.getElementById("chat-error").classList.remove("d-none");
                            document.getElementById("chat-error").innerText = "Video không được vượt quá 20MB!";
                            return;
                        }
                    }

                    document.getElementById("chat-error").classList.add("d-none");
                    const formData = new FormData();
                    formData.append("nguoi_gui_id", userId);
                    formData.append("nguoi_nhan_id", nguoiNhanId);
                    formData.append("channel", userId);
                    if (noiDung) formData.append("noi_dung", noiDung);
                    if (file) formData.append("media", file);

                    fetch('/send-chat', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            noiDungInput.value = "";
                            fileInput.value = "";
                            updateUnreadCount();
                        })
                        .catch(error => console.error("Lỗi khi gửi tin nhắn:", error));
                });

                // Nhận tin nhắn qua Pusher
                Pusher.logToConsole = true;
                const pusher = new Pusher("0ca5e8c271c25e1264d2", {
                    cluster: "ap1"
                });
                const channel = pusher.subscribe("chat." + userId);

                channel.bind("send-chat", function(data) {
                    const chatBox = document.getElementById("chat-box");
                    const chat = data.chat;
                    let align = chat.nguoi_gui_id === userId ? "text-end" : "text-start";

                    let chatMessage = document.createElement("p");
                    chatMessage.classList.add(align);
                    chatMessage.dataset.id = chat.id;
                    chatMessage.innerHTML = `<strong>${chat.ten_nguoi_gui}:</strong> ${chat.noi_dung || ''}`;

                    if (chat.hinh_anh) {
                        const ext = chat.hinh_anh.split('.').pop().toLowerCase();
                        if (['mp4', 'webm', 'ogg'].includes(ext)) {
                            chatMessage.innerHTML += `
                    <br><video controls style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 5px;">
                        <source src="${chat.hinh_anh}">
                        Trình duyệt không hỗ trợ video.
                    </video>`;
                        } else {
                            chatMessage.innerHTML += `<br><img src="${chat.hinh_anh}" style="max-width: 200px; height: auto; border-radius: 8px; margin-top: 5px;">`;
                        }
                    }

                    const timeSent = new Date(chat.created_at);
                    const timeString = timeSent.toLocaleString('vi-VN', {
                        weekday: 'short',
                        year: 'numeric',
                        month: 'numeric',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                    });
                    chatMessage.innerHTML += `<br><small class="text-muted">${timeString}</small>`;

                    chatBox.appendChild(chatMessage);
                    chatBox.scrollTop = chatBox.scrollHeight;

                    // Kiểm tra nếu modal chat đang mở và tin nhắn đến từ nguoiNhanId
                    const chatModal = document.getElementById('chat-box-modal');
                    if (chatModal.classList.contains('show') && chat.nguoi_gui_id === nguoiNhanId) {
                        // Đánh dấu tin nhắn là đã đọc
                        fetch(`/mark-as-read/${nguoiNhanId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Mark as read response:', data);
                                updateUnreadCount(); // Cập nhật số tin nhắn chưa đọc
                            })
                            .catch(error => console.error("Lỗi khi đánh dấu tin nhắn là đã đọc:", error));
                    } else {
                        // Cập nhật số tin nhắn chưa đọc nếu modal không mở
                        updateUnreadCount();
                    }
                });

                // Xử lý nút Back to Top
                window.addEventListener('scroll', function () {
                    const backToTopButton = document.getElementById('back-to-top');
                    if (window.scrollY > 300) {
                        backToTopButton.style.display = 'block';
                    } else {
                        backToTopButton.style.display = 'none';
                    }
                });

                document.getElementById('back-to-top').addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        </script>
    @endisset



</body>
<script>
    function Logout(ev) {
        ev.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>

        Swal.fire({
            title: "Bạn có chắc chắn muốn đăng xuất?",
            // text: "Hãy chắc chắn rằng bạn đã lưu tất cả công việc trước khi đăng xuất.",
            iconHtml: '<i class="fas fa-sign-out-alt" style="color:#e74c3c"></i>',
            showCancelButton: true,
            confirmButtonColor: "#e74c3c", // Màu đỏ nổi bật
            cancelButtonColor: "#0e947a", // Màu xanh nhẹ
            confirmButtonText: "Đăng xuất ngay",
            cancelButtonText: "Ở lại",
            background: "#f4f6f7", // Màu nền nhẹ nhàng
            color: "#333", // Màu chữ
            customClass: {
                popup: "swal-custom-popup",
                title: "swal-custom-title",
                confirmButton: "swal-custom-confirm",
                cancelButton: "swal-custom-cancel"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout.client') }}"; // Điều hướng đến route logout
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $(".notifi-wishlist").on("click", function(e) {
            e.preventDefault(); // Ngăn chặn load lại trang

            var button = $(this); // Lưu nút đang bấm
            var form = button.closest("li").find(".wishlist-form"); // Tìm form gần nhất
            var formData = form.serialize(); // Lấy dữ liệu form

            $.ajax({
                url: form.attr("action"),
                type: "POST",
                data: formData,
                success: function(response) {
                    $.notify({
                        icon: "fa fa-check",
                        title: "Sản phẩm đã được thêm vào danh sách yêu thích.",
                    }, {
                        element: "body",
                        type: "Thành công: ",
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        delay: 3000,
                        z_index: 9999,
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp"
                        },
                        template: '<div class="alert alert-success" style="background-color:#1abc9c; color:white; border-color:#16a085; padding: 10px; border-radius: 5px;">' +
                            '<strong><i class="fa fa-check"></i> {0}</strong> {1}' +
                            '</div>'
                    });

                    // Đổi màu icon thành đỏ (đã yêu thích)
                    button.find("i").css("color", "red");
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi!",
                            text: "Vui lòng đăng nhập.",
                            confirmButtonText: "OK"
                        });
                        return;
                    }
                    $.notify({
                        icon: "<i class='fa fa-exclamation-circle'></i>", // Icon lỗi nổi bật hơn
                        title: "Sản phẩm đã tồn tại ở danh sách yêu thích.", // Màu đỏ dịu hơn
                        message: xhr.responseJSON?.message ||
                            "Có lỗi xảy ra, vui lòng thử lại.",
                    }, {
                        element: "body",
                        type: "Cảnh báo: ",
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        delay: 3000,
                        z_index: 9999,
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp"
                        },
                        template: '<div class="alert alert-danger" style="background-color:#ff6b6b; color:white; border-color:#d64545; padding: 10px; border-radius: 5px;">' +
                            '<strong><i class="fa fa-exclamation-circle"></i> {0}</strong> {1}' +
                            '</div>'
                    });

                }
            });
        });
    });
</script>

</html>

{{--
<script>
    $(".delete-cart-item").click(function () {
        console.log('hi')
        let itemId = $(this).data("id");
        let button = $(this);

        $.ajax({
            url: "/xoa-gio-hang",
            method: "POST",
            data: { id: itemId },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function (response) {
                console.log("Response từ server:", response);

                // Xóa sản phẩm khỏi giao diện
                button.closest("li.product-box-contain").remove();

                // Tính lại tổng tiền
                let total = 0;
                let totalItem = response.totalItem;
                $(".cart-list li").each(function () {
                    let text = $(this).find("h6").text();
                    let matches = text.match(/(\d+)\s*x\s*([\d\.]+)/);

                    if (matches) {
                        let soLuong = parseInt(matches[1]);  // Số lượng
                        let giaBan = parseInt(matches[2].replace(/\./g, "")); // Giá (loại bỏ dấu chấm)

                        total += soLuong * giaBan;
                    }
                });

                $(".header-wishlist .badge").text(totalItem);
                // Cập nhật tổng tiền
                $(".total-price").text(total.toLocaleString("vi-VN") + " đ");
            },
            error: function (xhr) {
                console.log("Lỗi:", xhr.responseText);
            }
        });
    });

</script> --}}