importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"
);

firebase.initializeApp({
    apiKey: "AIzaSyDqZ3_UT_r2G1jqJYulhtkldQFtWftXOD0",
    authDomain: "flat-b7d59.firebaseapp.com",
    projectId: "flat-b7d59",
    storageBucket: "flat-b7d59.firebasestorage.app",
    messagingSenderId: "252025170203",
    appId: "1:252025170203:web:45da416f5887be1b6a8bbe",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
    });
});
