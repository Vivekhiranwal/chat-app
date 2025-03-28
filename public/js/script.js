document.addEventListener("DOMContentLoaded", function() {
    console.log("🚀 Initializing Firebase...");

    // ✅ Firebase Configuration
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

    // ✅ Check if Firebase App is already initialized
    if (!firebase.apps.length) {
        firebase.initializeApp(firebaseConfig);
        console.log("🔥 Firebase Initialized Successfully!");
    } else {
        console.log("✅ Firebase Already Initialized.");
    }

    // ✅ Get Firebase Database Reference
    const database = firebase.database();
    console.log("📡 Firebase Database Connected");

    // ✅ Test Firebase Database Read
    database.ref("messages").on("value", function(snapshot) {
        console.log("📩 Messages Updated:", snapshot.val());
    });
});