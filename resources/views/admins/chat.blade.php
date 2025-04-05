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
                        <form id="chat-form">
                            <input type="hidden" id="receiver_id">
                            <div class="input-group">
                                <input type="text" id="noi-dung" class="form-control" placeholder="Nhập tin nhắn..."
                                    autocomplete="off">
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
            let bgColor = chat.nguoi_gui_id === nguoi_gui_id ? "bg-primary text-white" : "bg-light text-dark";

            let chatMessage = document.createElement("div");
            chatMessage.style.maxWidth = "75%";
            chatMessage.style.display = "inline-block";
            chatMessage.innerHTML =
                `<strong>${chat.nguoi_gui_id === nguoi_gui_id ? chat.ten_nguoi_gui : "Admin"}:</strong> ${chat.noi_dung}`;

            let wrapper = document.createElement("div");
            wrapper.classList.add("m-2", align);
            wrapper.appendChild(chatMessage);

            chatBox.appendChild(wrapper);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        document.getElementById("chat-form").addEventListener("submit", function(e) {
            e.preventDefault();

            let noiDungInput = document.getElementById("noi-dung");
            let noiDung = noiDungInput.value.trim();
            if (!noiDung) return;

            fetch('/send-chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        nguoi_gui_id: user_id,
                        nguoi_nhan_id: receiver_id,
                        noi_dung: noiDung,
                        channel: receiver_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    noiDungInput.value = ""; // Xóa input sau khi gửi
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

            channel.bind("send-chat", function(data) {
                let chatBox = document.getElementById("chat-box");
                const chat = data.chat
                console.log(chat);

                var align = chat.nguoi_gui_id === nguoi_gui_id ? "text-end" : "text-start";
                let bgColor = chat.nguoi_gui_id === nguoi_gui_id ? "bg-primary text-white" : "bg-light text-dark";

                let chatMessage = document.createElement("div");
                chatMessage.style.maxWidth = "75%";
                chatMessage.style.display = "inline-block";
                chatMessage.innerHTML =
                    `<strong>${chat.ten_nguoi_gui}:</strong> ${chat.noi_dung}`;

                let wrapper = document.createElement("div");
                wrapper.classList.add("m-2", align);
                wrapper.appendChild(chatMessage);

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
