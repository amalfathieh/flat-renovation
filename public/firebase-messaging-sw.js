importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"
);

firebase.initializeApp({
    apiKey: "AIzaSyDRedkjDwAuGzfrh0Rdmxqcukp06MYu2qA",
    authDomain: "rebuildapp-f8417.firebaseapp.com",
    projectId: "rebuildapp-f8417",
    storageBucket: "rebuildapp-f8417.firebasestorage.app",
    messagingSenderId: "514294949355",
    appId: "1:514294949355:web:5dd33c00b6404033c1a5ae"

});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
    });
});
