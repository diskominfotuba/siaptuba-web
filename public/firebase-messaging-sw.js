importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');

// Inisialisasi Firebase di Service Worker
firebase.initializeApp({
    apiKey: "AIzaSyBhzQYLZ4lspqxgAuGiPnM5vWJviolK2sk",
    authDomain: "siap-tuba-a7935.firebaseapp.com",
    projectId: "siap-tuba-a7935",
    storageBucket: "siap-tuba-a7935.firebasestorage.app",
    messagingSenderId: "37720929143",
    appId: "1:37720929143:web:9e303c3850429beeb9e772",
    measurementId: "G-E5PVMP4916"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title || "Notifikasi Baru";
    const notificationOptions = {
        body: payload.notification.body || "Anda memiliki pesan baru.",
        icon: "/icon.png", // Ganti dengan ikon aplikasi Anda
        data: { url: payload.notification.click_action || "/" } // URL yang akan dibuka
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});

// Handle klik pada notifikasi
self.addEventListener("notificationclick", (event) => {
    event.notification.close();
    if (event.notification.data && event.notification.data.url) {
        event.waitUntil(
            clients.openWindow(event.notification.data.url)
        );
    }
});
