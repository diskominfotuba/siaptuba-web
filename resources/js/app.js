import './bootstrap';
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, onMessage, getToken } from "firebase/messaging";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBhzQYLZ4lspqxgAuGiPnM5vWJviolK2sk",
  authDomain: "siap-tuba-a7935.firebaseapp.com",
  projectId: "siap-tuba-a7935",
  storageBucket: "siap-tuba-a7935.firebasestorage.app",
  messagingSenderId: "37720929143",
  appId: "1:37720929143:web:9e303c3850429beeb9e772",
  measurementId: "G-E5PVMP4916"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);

// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging(app);
onMessage(messaging, (payload) => {
    console.log('Message received: ', payload);
});

function requestNotificationPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("Izin notifikasi diberikan");
            getFirebaseToken();
        } else {
            console.log("Izin notifikasi ditolak");
        }
    });
}

  Notification.requestPermission().then((permission) => {
    if (permission === "granted") {
        console.log("Notification permission granted.");
        getToken(messaging, { vapidKey: 'BDO_zLF5weoxUCJi7TGfjkbhgmE1Pk4xSQdB2TFmJwyi-vBfz40AlNIVnZh6PpEBCYmCGzVum56NAAxChKp2IV4' })
            .then((currentToken) => {
                if (currentToken) {
                    console.log('Token:', currentToken);
                    // Kirim token ke server Laravel untuk disimpan
                    fetch('/api/save-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer YOUR_AUTH_TOKEN'
                        },
                        body: JSON.stringify({ token: currentToken })
                    }).then(response => response.json())
                      .then(data => console.log('Token saved:', data))
                      .catch(error => console.error('Error saving token:', error));
                    
                } else {
                    console.log('No registration token available.');
                }
            }).catch((err) => {
                console.log('Error retrieving token:', err);
            });
    } else {
        console.log("Notification permission denied.");
    }
});

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
        .then((registration) => {
            console.log('Service Worker registered:', registration);
        })
        .catch((error) => {
            console.log('Service Worker registration failed:', error);
        });
}
