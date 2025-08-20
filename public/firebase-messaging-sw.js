// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

try
{
    // Initialize the Firebase app in the service worker by passing in
    // your app's Firebase config object.
    // https://firebase.google.com/docs/web/setup#config-object
    firebase.initializeApp({
        apiKey: "AIzaSyCGuYbCyYhOQtGQelQQhk_eR-EF-e0wEik",
        authDomain: "flat-925c4.firebaseapp.com",
        databaseURL: "https://flat-925c4-default-rtdb.firebaseio.com",
        projectId: "flat-925c4",
        storageBucket: "flat-925c4.firebasestorage.app",
        messagingSenderId: "812868767585",
        appId: "1:812868767585:web:9ce8153351517785643f20",
        measurementId: "G-DPDKL4WZHH"
    });


    // Retrieve an instance of Firebase Messaging so that it can handle background
    // messages.
    const messaging = firebase.messaging();

    messaging.onBackgroundMessage((payload) => {
    //
        var audio = new Audio('default');
 audio.play();

        let options = {
            body: "",
            icon: "",
            image: "",
            tag: "alert",
        };

        if(payload.data.body){
            options.body = payload.data.body;
        }

        if(payload.data.image){
            options.icon = payload.data.image;
        }

        let notification = self.registration.showNotification(
            payload.data.title,
            options
        );

        if(payload.data.url){
            // link to page on clicking the notification
            notification.onclick = (payload) => {
                window.open(payload.data.url);
            };
        }
    });
}
catch(e) {
    console.log(e)
}
