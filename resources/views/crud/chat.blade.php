<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-database-compat.js"></script>
    {{-- <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-analytics-compat.js"></script> --}}



    <style>
        body {
            background-color: #f8f9fa;
        }

        .chat-container {
            height: 90vh;
            display: flex;
            overflow: hidden;
        }

        .users-sidebar {
            width: 25%;
            background: #fff;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            padding: 10px;
        }

        .chat-box {
            width: 75%;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 15px;
            background: #007bff;
            color: white;
        }

        .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #e9ecef;
        }

        .chat-footer {
            padding: 10px;
            background: white;
            display: flex;
            gap: 10px;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .user-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 60%;
        }

        .sent {
            background: #2c3034;
            color: white;
            align-self: flex-end;
        }

        .received {
            background: #ffffff;
            color: black;
            align-self: flex-start;
        }

        .time {
            font-size: 14px;
            color: gray;
            text-align: right;
            margin-top: 3px;
            padding-left: 10px;
        }

        .date-separator {
            text-align: center;
            background: #e1f3fb;
            color: #555;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin: 10px auto;
            width: fit-content;
        }

        .read-receipt {
            color: blue;
            font-weight: bold;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
        <ul class="nav justify-content-center  bg-secondary">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/user/create') }}" aria-current="page">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/show') }}">Show data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/') }}">Chat</a>
            </li>
            <li class="nav-item">
                @if (auth()->check())
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ Auth::user()->name }}</button>
                    </form>
                @endif
            </li>
        </ul>
    </header>
    <main>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="show" data-bs-dismiss="alert"
                aria-label="Close">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="container-fluid chat-container">
            <div class="users-sidebar">
                <h5>Users</h5>
                @foreach ($users as $user)
                    <div class="user-item" data-receiver-id="{{ $user->id }}">
                        @if ($user->gender === 'male')
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZa0CKGp-TrwZAasTRSxDmjZHRNaUsLlstKZtDVlqJRXh7UPw6DEd3gi5NuJgjICqfSpg&usqp=CAU"
                                alt="User">
                        @else
                            <img src="https://www.shareicon.net/data/512x512/2016/07/26/802033_user_512x512.png"
                                alt="User">
                        @endif
                        <span>{{ $user->name }}</span>
                    </div>
                @endforeach
            </div>
            <div class="chat-box">
                <div class="chat-header">Chat with <span id="chat-user-name"></span></div>
                <div class="chat-messages d-flex flex-column p-3">
                    <div class="message received"></div>
                    <div class="message sent"></div>
                </div>
                <div class="chat-footer">
                    <input type="text" class="form-control" placeholder="Type a message...">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>



    </main>
    <footer>

    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>



    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('#show').remove();
            }, 2000);
        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🚀 Initializing Firebase...");

            const firebaseConfig = {
                apiKey: "AIzaSyB4TRBQBqFywvoaYk6iF1wGV-u2kPJb8zU",
                authDomain: "chatapp-1d2e5.firebaseapp.com",
                databaseURL: "https://chatapp-1d2e5-default-rtdb.firebaseio.com",
                projectId: "chatapp-1d2e5",
                storageBucket: "chatapp-1d2e5.firebasestorage.app",
                messagingSenderId: "310454264106",
                appId: "1:310454264106:web:1a1d3c085c60ccadcd3e53",
                measurementId: "G-1DMP0ZPT5N"
            };

            if (!firebase.apps.length) {
                firebase.initializeApp(firebaseConfig);
                console.log("🔥 Firebase Initialized Successfully!");
            } else {
                console.log("✅ Firebase Already Initialized.");
            }

            const database = firebase.database();
            console.log("📡 Firebase Database Connected");

            let senderId = "{{ auth()->id() }}";
            let receiverId = null;
            let chatRef = null;
            
            const chatUserName = document.getElementById("chat-user-name");
            const chatContainer = document.querySelector(".chat-messages");
            const messageInput = document.querySelector(".form-control");
            const sendButton = document.querySelector(".btn-primary");

            if (!chatUserName || !chatContainer || !messageInput || !sendButton) {
                console.error("❌ Required elements not found! Check your HTML structure.");
                return;
            }

            // ✅ Handle user clicks to load chat
            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");

                    if (chatUserName) {
                        chatUserName.textContent = this.textContent.trim();
                    }

                    chatRef = database.ref(`chats/${senderId}_${receiverId}`);

                    // ✅ Prevent duplicate listeners
                    chatRef.off("child_added");

                    loadMessages();
                });
            });

            // ✅ Load Messages Function
            function loadMessages() {
                if (!receiverId) {
                    console.warn("⚠️ No receiver selected.");
                    return;
                }

                chatContainer.innerHTML = ""; // Clear old messages

                // 🔥 Listen for messages where current user is either sender or receiver
                const chatPath1 = `chats/${senderId}_${receiverId}`;
                const chatPath2 = `chats/${receiverId}_${senderId}`;

                database.ref(chatPath1).off("child_added");
                database.ref(chatPath2).off("child_added");

                // Function to display messages
                function displayMessage(message) {
                    let messageDiv = document.createElement("div");
                    messageDiv.classList.add("message");
                    messageDiv.textContent = message.text;

                    if (message.sender_id == senderId) {
                        messageDiv.classList.add("sent"); // Sent message styling
                    } else {
                        messageDiv.classList.add("received"); // Received message styling
                    }

                    chatContainer.appendChild(messageDiv);
                    chatContainer.scrollTop = chatContainer.scrollHeight; // Auto-scroll to bottom
                }

                // 🔥 Listen for messages sent by the current user
                database.ref(chatPath1).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });

                // 🔥 Listen for messages received from the other user
                database.ref(chatPath2).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });
            }


            // ✅ Send Message Function
            sendButton.addEventListener("click", function() {
                const messageText = messageInput.value.trim();

                if (messageText === "" || !receiverId) {
                    console.warn("⚠️ Cannot send empty message or no receiver selected.");
                    return;
                }

                const sendMessageRoute = "{{ route('send.message') }}";

                fetch(sendMessageRoute, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            sender_id: senderId,
                            receiver_id: receiverId,
                            message: messageText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("✅ Message saved in MySQL:", data.message);

                            // ✅ Send to Firebase after saving in MySQL
                            chatRef.push({
                                sender_id: senderId,
                                receiver_id: receiverId,
                                text: messageText,
                                timestamp: firebase.database.ServerValue.TIMESTAMP
                            });

                            messageInput.value = ""; // Clear input after sending
                        } else {
                            console.error("❌ Error saving message in MySQL:", data.error);
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🚀 Initializing Firebase...");

            const firebaseConfig = {
                apiKey: "AIzaSyB4T...",
                authDomain: "chatapp-1d2e5.firebaseapp.com",
                databaseURL: "https://chatapp-1d2e5-default-rtdb.firebaseio.com",
                projectId: "chatapp-1d2e5",
                storageBucket: "chatapp-1d2e5.firebasestorage.app",
                messagingSenderId: "310454264106",
                appId: "1:310454264106:web:1a1d3c085c60ccadcd3e53",
                measurementId: "G-1DMP0ZPT5N"
            };

            if (!firebase.apps.length) {
                firebase.initializeApp(firebaseConfig);
                console.log("🔥 Firebase Initialized Successfully!");
            }

            const database = firebase.database();
            console.log("📡 Firebase Database Connected");

            let senderId = "{{ auth()->id() }}";
            let receiverId = null;
            let chatRef = null;
            let currentUserId = senderId; // ✅ Ensuring current user ID is correctly set

            const chatUserName = document.getElementById("chat-user-name");
            const chatContainer = document.querySelector(".chat-messages");
            const messageInput = document.querySelector(".form-control");
            const sendButton = document.querySelector(".btn-primary");

            if (!chatUserName || !chatContainer || !messageInput || !sendButton) {
                console.error("❌ Required elements not found! Check your HTML structure.");
                return;
            }

            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");
                    chatUserName.textContent = this.textContent.trim();
                    chatRef = database.ref(`chats/${senderId}_${receiverId}`);
                    chatRef.off("child_added");
                    loadMessages();
                });
            });

            function loadMessages() {
                if (!receiverId) {
                    console.warn("⚠️ No receiver selected.");
                    return;
                }

                chatContainer.innerHTML = "";
                const chatPath1 = `chats/${senderId}_${receiverId}`;
                const chatPath2 = `chats/${receiverId}_${senderId}`;

                database.ref(chatPath1).off("child_added");
                database.ref(chatPath2).off("child_added");

                let messages = [];

                // Function to fetch messages from Firebase
                function fetchMessages(chatPath) {
                    return database.ref(chatPath).orderByChild("timestamp").once("value").then(snapshot => {
                        let fetchedMessages = [];
                        snapshot.forEach(childSnapshot => {
                            let msg = childSnapshot.val();
                            msg.key = childSnapshot.key;
                            fetchedMessages.push(msg);
                        });
                        return fetchedMessages;
                    });
                }

                // Fetch both chat paths before rendering messages
                Promise.all([fetchMessages(chatPath1), fetchMessages(chatPath2)]).then(results => {
                    messages = [...results[0], ...results[1]];
                    messages.sort((a, b) => a.timestamp - b.timestamp); // ✅ Sort messages by timestamp

                    displayMessages(); // ✅ Render messages only after sorting
                });

                function displayMessages() {
                    chatContainer.innerHTML = ""; // ✅ Clear container before rendering

                    messages.forEach(message => {
                        let existingMessageDiv = document.querySelector(
                            `[data-message-id="${message.key}"]`);

                        // ✅ Only create message div if it doesn't exist
                        if (!existingMessageDiv) {
                            let messageDiv = document.createElement("div");
                            messageDiv.classList.add("message", message.sender_id == senderId ? "sent" :
                                "received");
                            messageDiv.textContent = message.text;
                            messageDiv.setAttribute("data-message-id", message.key);

                            // ✅ Preserve read status
                            if (message.sender_id == senderId) {
                                let checkmark = document.createElement("span");
                                checkmark.classList.add("read-receipt");

                                if (message.is_read == 1) {
                                    checkmark.textContent = "✓✓";
                                    checkmark.style.color = "blue";
                                } else {
                                    checkmark.textContent = "✓";
                                    checkmark.style.color = "blue";
                                }

                                messageDiv.appendChild(checkmark);
                            }

                            chatContainer.appendChild(messageDiv);
                        }
                    });

                    chatContainer.scrollTop = chatContainer.scrollHeight; // ✅ Auto-scroll
                    markMessagesAsRead(); // ✅ Mark messages as read
                }

                // Listen for new real-time messages
                function listenForNewMessages(path) {
                    database.ref(path).orderByChild("timestamp").on("child_added", function(snapshot) {
                        let msg = snapshot.val();
                        msg.key = snapshot.key;

                        let existingMessage = messages.find(m => m.key === msg.key);
                        if (!existingMessage) {
                            messages.push(msg);
                            messages.sort((a, b) => a.timestamp - b.timestamp); // ✅ Keep messages sorted
                            displayMessages();
                        }
                    });

                    // ✅ Update read receipts in real-time
                    database.ref(path).on("child_changed", function(snapshot) {
                        let updatedMessage = snapshot.val();
                        let messageDiv = document.querySelector(`[data-message-id="${snapshot.key}"]`);

                        if (messageDiv && updatedMessage.sender_id === senderId) {
                            let checkmark = messageDiv.querySelector(".read-receipt");

                            if (!checkmark) {
                                checkmark = document.createElement("span");
                                checkmark.classList.add("read-receipt");
                                messageDiv.appendChild(checkmark);
                            }

                            if (updatedMessage.is_read == 1) {
                                checkmark.textContent = "✓✓";
                                checkmark.style.color = "blue";
                            } else {
                                checkmark.textContent = "✓";
                                checkmark.style.color = "blue";
                            }
                        }
                    });
                }

                listenForNewMessages(chatPath1);
                listenForNewMessages(chatPath2);
            }


            sendButton.addEventListener("click", function() {
                const messageText = messageInput.value.trim();
                if (messageText === "" || !receiverId) {
                    console.warn("⚠️ Cannot send empty message or no receiver selected.");
                    return;
                }

                const sendMessageRoute = "{{ route('send.message') }}";
                fetch(sendMessageRoute, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            sender_id: senderId,
                            receiver_id: receiverId,
                            message: messageText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("✅ Message saved in MySQL:", data.message);
                            chatRef.push({
                                sender_id: senderId,
                                receiver_id: receiverId,
                                text: messageText,
                                timestamp: firebase.database.ServerValue.TIMESTAMP,
                                is_read: 0
                            });
                            messageInput.value = "";
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            });

            function markMessagesAsRead() {
                if (!receiverId) return;

                const chatPath1 = `chats/${receiverId}_${senderId}`;
                database.ref(chatPath1).once("value", function(snapshot) {
                    snapshot.forEach(function(childSnapshot) {
                        let messageData = childSnapshot.val();
                        if (messageData.receiver_id == senderId && messageData.is_read == 0) {
                            let messageKey = childSnapshot.key;

                            // ✅ Update Firebase read status
                            database.ref(`${chatPath1}/${messageKey}`).update({
                                is_read: 1
                            }).then(() => {
                                console.log("✅ Message marked as read:", messageKey);
                            }).catch(error => {
                                console.error("❌ Error updating read status:", error);
                            });

                            // ✅ Update MySQL read status
                            fetch("{{ route('mark.message.read') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        sender_id: receiverId,
                                        message_id: messageKey
                                    })
                                }).then(response => response.json())
                                .then(data => console.log("✅ Messages marked as read in MySQL:",
                                    data))
                                .catch(error => console.error(
                                    "❌ Error marking messages as read in MySQL:", error));
                        }
                    });
                });
            }

        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🚀 Initializing Firebase...");

            const firebaseConfig = {
                apiKey: "AIzaSyB4TRBQBqFywvoaYk6iF1wGV-u2kPJb8zU",
                authDomain: "chatapp-1d2e5.firebaseapp.com",
                databaseURL: "https://chatapp-1d2e5-default-rtdb.firebaseio.com",
                projectId: "chatapp-1d2e5",
                storageBucket: "chatapp-1d2e5.firebasestorage.app",
                messagingSenderId: "310454264106",
                appId: "1:310454264106:web:1a1d3c085c60ccadcd3e53",
                measurementId: "G-1DMP0ZPT5N"
            };

            if (!firebase.apps.length) {
                firebase.initializeApp(firebaseConfig);
                console.log("🔥 Firebase Initialized Successfully!");
            } else {
                console.log("✅ Firebase Already Initialized.");
            }

            const database = firebase.database();
            console.log("📡 Firebase Database Connected");

            let senderId = "{{ auth()->id() }}";
            let receiverId = null;
            let chatRef = null;

            function requestNotificationPermission() {
                if (Notification.permission === "granted") {
                    new Notification("Test Notification", {
                        body: "If you see this, notifications are working!",
                        icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                    });
                } else {
                    console.log("Requesting permission...");
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            new Notification("Test Notification", {
                                body: "If you see this, notifications are working!",
                                icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                            });
                        } else {
                            console.warn("Notification permission denied!");
                        }
                    });
                }

            }

            // Ensure we request notification permission
            requestNotificationPermission();


            // Handle user selection from chat list
            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");
                    chatRef = firebase.database().ref(`chats/${senderId}_${receiverId}`);
                    listenForMessages();
                });
            });

            // Listen for incoming messages in real-time
            function listenForMessages() {
                if (!chatRef) return;

                chatRef.on("child_added", function(snapshot) {
                    const message = snapshot.val();

                    if (message.sender_id !== senderId) {
                        console.log("📩 New message received:", message.text);
                        showNotification(message.sender_id, message.text);
                    }
                });
            }


            // Function to show browser notification
            function showNotification(senderId, messageText) {
                if (Notification.permission === "granted") {
                    const notification = new Notification("New Message", {
                        body: messageText,
                        icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                    });

                    notification.onclick = function() {
                        window.focus();
                    };
                }
            }
            const chatUserName = document.getElementById("chat-user-name");
            const chatContainer = document.querySelector(".chat-messages");
            const messageInput = document.querySelector(".form-control");
            const sendButton = document.querySelector(".btn-primary");

            if (!chatUserName || !chatContainer || !messageInput || !sendButton) {
                console.error("❌ Required elements not found! Check your HTML structure.");
                return;
            }

            // ✅ Handle user clicks to load chat
            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");

                    if (chatUserName) {
                        chatUserName.textContent = this.textContent.trim();
                    }

                    chatRef = database.ref(`chats/${senderId}_${receiverId}`);

                    // ✅ Prevent duplicate listeners
                    chatRef.off("child_added");

                    loadMessages();
                });
            });

            // ✅ Load Messages Function
            function loadMessages() {
                if (!receiverId) {
                    console.warn("⚠️ No receiver selected.");
                    return;
                }

                chatContainer.innerHTML = ""; // Clear old messages

                // 🔥 Listen for messages where current user is either sender or receiver
                const chatPath1 = `chats/${senderId}_${receiverId}`;
                const chatPath2 = `chats/${receiverId}_${senderId}`;

                database.ref(chatPath1).off("child_added");
                database.ref(chatPath2).off("child_added");

                // Function to display messages
                function displayMessage(message) {
                    let messageDiv = document.createElement("div");
                    messageDiv.classList.add("message");
                    messageDiv.textContent = message.text;

                    if (message.sender_id == senderId) {
                        messageDiv.classList.add("sent"); // Sent message styling
                    } else {
                        messageDiv.classList.add("received"); // Received message styling
                    }

                    chatContainer.appendChild(messageDiv);
                    chatContainer.scrollTop = chatContainer.scrollHeight; // Auto-scroll to bottom
                }

                // 🔥 Listen for messages sent by the current user
                database.ref(chatPath1).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });

                // 🔥 Listen for messages received from the other user
                database.ref(chatPath2).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });
            }


            // ✅ Send Message Function
            sendButton.addEventListener("click", function() {
                const messageText = messageInput.value.trim();

                if (messageText === "" || !receiverId) {
                    console.warn("⚠️ Cannot send empty message or no receiver selected.");
                    return;
                }

                const sendMessageRoute = "{{ route('send.message') }}";

                fetch(sendMessageRoute, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            sender_id: senderId,
                            receiver_id: receiverId,
                            message: messageText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("✅ Message saved in MySQL:", data.message);

                            // ✅ Send to Firebase after saving in MySQL
                            chatRef.push({
                                sender_id: senderId,
                                receiver_id: receiverId,
                                text: messageText,
                                timestamp: firebase.database.ServerValue.TIMESTAMP
                            });

                            messageInput.value = ""; // Clear input after sending
                        } else {
                            console.error("❌ Error saving message in MySQL:", data.error);
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            });
        });
    </script> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🚀 Initializing Firebase...");
            const firebaseConfig = {
                apiKey: "AIzaSyB4TRBQBqFywvoaYk6iF1wGV-u2kPJb8zU",
                authDomain: "chatapp-1d2e5.firebaseapp.com",
                databaseURL: "https://chatapp-1d2e5-default-rtdb.firebaseio.com",
                projectId: "chatapp-1d2e5",
                storageBucket: "chatapp-1d2e5.firebasestorage.app",
                messagingSenderId: "310454264106",
                appId: "1:310454264106:web:1a1d3c085c60ccadcd3e53",
                measurementId: "G-1DMP0ZPT5N"
            };

            if (!firebase.apps.length) {
                firebase.initializeApp(firebaseConfig);
                console.log("🔥 Firebase Initialized Successfully!");
            } else {
                console.log("✅ Firebase Already Initialized.");
            }

            const database = firebase.database();
            console.log("📡 Firebase Database Connected");

            let senderId = "{{ auth()->id() }}";
            let receiverId = null;
            let chatRef = null;

            function requestNotificationPermission() {
                if (Notification.permission === "granted") {
                    new Notification("Test Notification", {
                        body: "Notifications are working!",
                        icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                    });
                } else {
                    console.log("❌ Notifications are blocked! Requesting permission...");
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            new Notification("Test Notification", {
                                body: "Notifications are now enabled!",
                                icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                            });
                        } else {
                            console.warn("⚠️ User denied notifications.");
                        }
                    });
                }
            }
            requestNotificationPermission();
            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");
                    chatRef = firebase.database().ref(`chats/${senderId}_${receiverId}`);
                    console.log("✅ listenForMessages() function called!");
                    listenForMessages();
                });
            });

            function listenForMessages() {
                if (!database) {
                    console.error("❌ Firebase database is not initialized!");
                    return;
                }

                console.log("✅ Listening for messages...");

                if (!receiverId) {
                    console.warn("⚠️ No receiver selected, cannot listen for messages.");
                    return;
                }

                let chatPath1 = `chats/${senderId}_${receiverId}`;
                let chatPath2 = `chats/${receiverId}_${senderId}`;

                database.ref(chatPath1).off("child_added");
                database.ref(chatPath2).off("child_added");

                database.ref(chatPath1).on("child_added", function(snapshot) {
                    processNewMessage(snapshot);
                });

                database.ref(chatPath2).on("child_added", function(snapshot) {
                    processNewMessage(snapshot);
                });
            }

            // Helper function to process messages
            function processNewMessage(snapshot) {
                const messageData = snapshot.val();

                if (!messageData) {
                    console.warn("⚠️ No message data found.");
                    return;
                }

                console.log("🔥 New message detected:", messageData);

                // Show notification if message is meant for logged-in user
                if (messageData.receiver_id == senderId && messageData.sender_id != senderId) {
                    console.log("📩 New message received:", messageData.text);
                    showNotification(messageData.sender_id, messageData.text);
                }
            }

            // Function to show browser notification
            function showNotification(senderId, messageText) {
                if (Notification.permission !== "granted") {
                    console.warn("⚠️ Notification permission not granted!");
                    return;
                }
                const notification = new Notification("New Message", {
                    body: messageText,
                    icon: "https://cdn-icons-png.flaticon.com/512/733/733585.png",
                });
                notification.onclick = function() {
                    window.focus();
                };
                console.log("✅ Notification triggered:", messageText);
            }
            const chatUserName = document.getElementById("chat-user-name");
            const chatContainer = document.querySelector(".chat-messages");
            const messageInput = document.querySelector(".form-control");
            const sendButton = document.querySelector(".btn-primary");
            if (!chatUserName || !chatContainer || !messageInput || !sendButton) {
                console.error("❌ Required elements not found! Check your HTML structure.");
                return;
            }
            // ✅ Handle user clicks to load chat
            document.querySelectorAll(".user-item").forEach(user => {
                user.addEventListener("click", function() {
                    receiverId = this.getAttribute("data-receiver-id");
                    if (chatUserName) {
                        chatUserName.textContent = this.textContent.trim();
                    }
                    chatRef = database.ref(`chats/${senderId}_${receiverId}`);
                    // ✅ Prevent duplicate listeners
                    chatRef.off("child_added");
                    loadMessages();
                });
            });
            // ✅ Load Messages Function
            function loadMessages() {
                if (!receiverId) {
                    console.warn("⚠️ No receiver selected.");
                    return;
                }
                chatContainer.innerHTML = ""; // Clear old messages
                // 🔥 Listen for messages where current user is either sender or receiver
                const chatPath1 = `chats/${senderId}_${receiverId}`;
                const chatPath2 = `chats/${receiverId}_${senderId}`;
                database.ref(chatPath1).off("child_added");
                database.ref(chatPath2).off("child_added");
                // Function to display messages
                function displayMessage(message) {
                    let messageDiv = document.createElement("div");
                    messageDiv.classList.add("message");
                    messageDiv.textContent = message.text;

                    if (message.sender_id == senderId) {
                        messageDiv.classList.add("sent"); // Sent message styling
                    } else {
                        messageDiv.classList.add("received"); // Received message styling
                    }

                    chatContainer.appendChild(messageDiv);
                    chatContainer.scrollTop = chatContainer.scrollHeight; // Auto-scroll to bottom
                }
                // 🔥 Listen for messages sent by the current user
                database.ref(chatPath1).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });
                // 🔥 Listen for messages received from the other user
                database.ref(chatPath2).on("child_added", function(snapshot) {
                    displayMessage(snapshot.val());
                });
            }
            // ✅ Send Message Function
            sendButton.addEventListener("click", function() {
                const messageText = messageInput.value.trim();
                if (messageText === "" || !receiverId) {
                    console.warn("⚠️ Cannot send empty message or no receiver selected.");
                    return;
                }
                const sendMessageRoute = "{{ route('send.message') }}";

                fetch(sendMessageRoute, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            sender_id: senderId,
                            receiver_id: receiverId,
                            message: messageText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("✅ Message saved in MySQL:", data.message);

                            // ✅ Send to Firebase after saving in MySQL
                            chatRef.push({
                                sender_id: senderId,
                                receiver_id: receiverId,
                                text: messageText,
                                timestamp: firebase.database.ServerValue.TIMESTAMP
                            });

                            messageInput.value = ""; // Clear input after sending
                        } else {
                            console.error("❌ Error saving message in MySQL:", data.error);
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            });
        });
    </script> --}}



</body>

</html>
