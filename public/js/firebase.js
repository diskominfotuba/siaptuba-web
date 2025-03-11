console.log("Firebase script loaded!");

import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-messaging.js";

// Konfigurasi Firebase
const firebaseConfig = {
    apiKey: "AIzaSyBhzQYLZ4lspqxgAuGiPnM5vWJviolK2sk",
    authDomain: "siap-tuba-a7935.firebaseapp.com",
    projectId: "siap-tuba-a7935",
    storageBucket: "siap-tuba-a7935.firebasestorage.app",
    messagingSenderId: "37720929143",
    appId: "1:37720929143:web:9e303c3850429beeb9e772",
    measurementId: "G-E5PVMP4916"
};

// Inisialisasi Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Fungsi untuk meminta izin notifikasi
export function requestNotificationPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("Izin notifikasi diberikan");
            getFirebaseToken();
        } else {
            console.log("Izin notifikasi ditolak");
        }
    });
}

// Fungsi untuk mendapatkan Token FCM
export function getFirebaseToken() {
    getToken(messaging, { vapidKey: "BDO_zLF5weoxUCJi7TGfjkbhgmE1Pk4xSQdB2TFmJwyi-vBfz40AlNIVnZh6PpEBCYmCGzVum56NAAxChKp2IV4" })
        .then((currentToken) => {
            if (currentToken) {
                console.log("Token FCM:", currentToken);
                saveTokenToDatabase(currentToken);
            } else {
                console.log("Gagal mendapatkan token");
            }
        })
        .catch((err) => {
            console.log("Error mendapatkan token:", err);
        });
}

// Fungsi untuk menyimpan Token ke Database Laravel
export function saveTokenToDatabase(token) {
    fetch("/api/save-token", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ token: token })
    })
    .then(response => response.json())
    .then(data => console.log("Token disimpan:", data))
    .catch(error => console.log("Gagal menyimpan token:", error));
}
