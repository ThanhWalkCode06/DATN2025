@extends('layouts.admin')

@section('title')
    Chat với người dùng
@endsection

@section('css')
    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <style>
        
    </style>
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="row">
            <!-- Sidebar Danh sách người đã chat -->
            <div class="col-md-3 border-end" id="user-list" style="height: 500px; overflow-y: auto;">
                <h5 class="mb-4">Người đã chat</h5>
                <ul class="list-group" id="chat-users"></ul>
            </div>

            <!-- Khung chat chính -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" id="chat-header">Chọn một người để bắt đầu chat</div>
                    <div class="card-body" id="chat-box" style="height: 400px; overflow-y: auto; background: #f9f9f9;">
                    </div>
                    <div class="card-footer">
                        <form id="chat-form" enctype="multipart/form-data">
                            <input type="hidden" id="receiver_id">
                            <div class="input-group">
                                <input type="text" id="noi-dung" class="form-control" placeholder="Nhập tin nhắn..."
                                    autocomplete="off">
                                    <input type="file" id="image" accept="image/*,video/*" class="form-control" style="max-width: 180px;">

                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let user_id = {{ Auth::user()->id }}
            let receiver_id = null

        fetch('/admin/chat-users')
            .then(response => response.json())
            .then(users => {
                let userList = document.getElementById("chat-users");
                users.forEach(user => {
                    let li = document.createElement("li");
                    li.classList.add("list-group-item", "user-item");
                    li.innerText = user.ten_nguoi_dung;
                    li.dataset.id = user.id;

                    li.addEventListener("click", () => loadChat(user.id, user.ten_nguoi_dung));
                    userList.appendChild(li);
                });
            });

        function loadChat(nguoi_nhan_id, ten_nguoi_nhan) {
            receiver_id = nguoi_nhan_id; // Gắn user id của người gửi vào id người nhận khi admin gửi tin nhắn
            bindChannel(user_id, nguoi_nhan_id);
            console.log(receiver_id);

            document.getElementById("chat-header").innerText = "Chat với " + ten_nguoi_nhan;
            document.getElementById("receiver_id").value = nguoi_nhan_id;

            fetch(`/messages/${nguoi_nhan_id}`)
                .then(response => response.json())
                .then(messages => {
                    let chatBox = document.getElementById("chat-box");
                    chatBox.innerHTML = "";
                    messages.forEach(chat => {
                        appendMessage(chat, nguoi_nhan_id);
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        function appendMessage(chat, nguoi_gui_id) {
            let chatBox = document.getElementById("chat-box");
            let align = chat.nguoi_gui_id === nguoi_gui_id ? "text-start" : "text-end";

            let wrapper = document.createElement("div");
            wrapper.classList.add("m-2", align);

            let content = `<strong>${chat.nguoi_gui_id === nguoi_gui_id ? chat.ten_nguoi_gui : "Admin"}:</strong>`;

            if (chat.noi_dung) {
                content += `<div>${chat.noi_dung}</div>`;
            }

            if (chat.hinh_anh) {
                let fileUrl = chat.hinh_anh; // Đảm bảo đây là đường dẫn đến ảnh hoặc video

                // Kiểm tra phần mở rộng file
                const extension = fileUrl.split('.').pop().toLowerCase();

                // Kiểm tra nếu là ảnh
                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension)) {
                    content += `<div><img src="${fileUrl}" alt="Ảnh" style="max-width: 200px; border-radius: 8px; margin-top: 5px;"></div>`;
                }
                // Kiểm tra nếu là video
                else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                    content += `
                <div>
                    <video controls style="max-width: 300px; border-radius: 8px; margin-top: 5px;">
                        <source src="${fileUrl}" type="video/${extension}">
                        Trình duyệt không hỗ trợ video.
                    </video>
                </div>`;
                }
            }


            wrapper.innerHTML = content;
            chatBox.appendChild(wrapper);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        document.getElementById("chat-form").addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('nguoi_gui_id', user_id);
            formData.append('nguoi_nhan_id', receiver_id);
            formData.append('noi_dung', document.getElementById("noi-dung").value);
            formData.append('channel', receiver_id);

            let imageInput = document.getElementById("image");
            if (imageInput.files.length > 0) {
                formData.append('media', imageInput.files[0]); // Sửa lại đúng tên
            }


            fetch('/send-chat', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("noi-dung").value = "";
                    document.getElementById("image").value = "";
                })
                .catch(error => console.error("Lỗi:", error));
        });


        // Kết nối Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher("0ca5e8c271c25e1264d2", {
            cluster: "ap1"
        });

        function bindChannel(nguoi_gui_id, nguoi_nhan_id) {
            var channel = pusher.subscribe("chat." + nguoi_nhan_id);

            channel.bind("send-chat", function (data) {
                let chatBox = document.getElementById("chat-box");
                const chat = data.chat;

                let align = chat.nguoi_gui_id === user_id ? "text-end" : "text-start";
                let wrapper = document.createElement("div");
                wrapper.classList.add("m-2", align);

                let content = `<strong>${chat.ten_nguoi_gui}:</strong>`;

                if (chat.noi_dung) {
                    content += `<div>${chat.noi_dung}</div>`;
                }

                if (chat.hinh_anh) {
                    const ext = chat.hinh_anh.split('.').pop().toLowerCase();
                    if (['mp4', 'webm', 'ogg'].includes(ext)) {
                        content += `<div><video src="${chat.hinh_anh}" controls style="max-width: 200px; margin-top: 5px; border-radius: 8px;"></video></div>`;
                    } else {
                        content += `<div><img src="${chat.hinh_anh}" alt="Ảnh" style="max-width: 200px; border-radius: 8px; margin-top: 5px;"></div>`;
                    }
                }


                wrapper.innerHTML = content;
                chatBox.appendChild(wrapper);
                chatBox.scrollTop = chatBox.scrollHeight;
            });

        }
    </script>

    <!-- customizer js -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Data table js -->
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/custom-data-table.js') }}"></script>

    <!-- all checkbox select js -->
    <script src="{{ asset('assets/js/checkbox-all-check.js') }}"></script>
@endsection