import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyDRedkjDwAuGzfrh0Rdmxqcukp06MYu2qA",
    authDomain: "rebuildapp-f8417.firebaseapp.com",
    projectId: "rebuildapp-f8417",
    storageBucket: "rebuildapp-f8417.firebasestorage.app",
    messagingSenderId: "514294949355",
    appId: "1:514294949355:web:5dd33c00b6404033c1a5ae"

};
// تهيئة Firebase
const app = initializeApp(firebaseConfig);

// تهيئة Messaging
const messaging = getMessaging(app);

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/firebase-messaging-sw.js");
}

if (Notification.permission === "default") {
    Notification.requestPermission();
}

// Get Device Token
getToken(messaging, {
    vapidKey: "BOQidQulnh1wvgayguZX-rMeizKBJZNpJwi77TNGSEVdnRjHa1r2X_kt3KorN0MAu8p0J4g9KBZHdq9IV8KcN_8",
})
    .then((currentToken) => {
        if (currentToken) {
            console.log("Device Token:", currentToken);

            fetch("/device-token", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ token: currentToken }),
            });
        } else {
            console.log("No registration token available.");
        }
    })
    .catch((err) => {
        console.log("Error retrieving token: ", err);
    });

onMessage(messaging, (payload) => {
    console.log("Message received:", payload);

    // تشغيل صوت محلي
    // const audio = new Audio('/sounds/notification.mp3');
    // audio.play();

    if (window.FilamentNotification) {
        new window.FilamentNotification()
            .title(payload.notification?.title || "Notification")
            .body(payload.notification?.body || "")
            .success()
            .send();
    } else {
        console.warn("FilamentNotification class not found");
        alert(payload.notification?.title + "\n" + payload.notification?.body);
    }
});
