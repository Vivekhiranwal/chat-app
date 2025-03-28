importScripts("https://www.gstatic.com/firebasejs/10.7.2/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.7.2/firebase-messaging-compat.js");

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

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log("📩 Received background message:", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon || "/default-icon.png"
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
