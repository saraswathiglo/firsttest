// Import and configure the Firebase SDK
// These scripts are made available when the app is served or deployed on Firebase Hosting
// If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup
 importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js');
 importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-messaging.js');
//importScripts('/__/firebase/init.js');



var firebaseConfig = {
    apiKey: "AIzaSyBhBTGhrdOoumj0LUiN8o4DFJM1fzdjReQ",
    authDomain: "test-7d4b6.firebaseapp.com",
    databaseURL: "https://test-7d4b6.firebaseio.com",
    projectId: "test-7d4b6",
    storageBucket: "test-7d4b6.appspot.com",
    messagingSenderId: "438060110908",
    appId: "1:438060110908:web:e616615c25382437"
  };
  firebase.initializeApp(firebaseConfig);

/**
 * Here is is the code snippet to initialize Firebase Messaging in the Service
 * Worker when your app is not hosted on Firebase Hosting.
 // [START initialize_firebase_in_sw]
 // Give the service worker access to Firebase Messaging.
 // Note that you can only use Firebase Messaging here, other Firebase libraries
 // are not available in the service worker.
 importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js');
 importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-messaging.js');
 // Initialize the Firebase app in the service worker by passing in the
 // messagingSenderId.
 firebase.initializeApp({
   'messagingSenderId': 'YOUR-SENDER-ID'
 });
 // Retrieve an instance of Firebase Messaging so that it can handle background
 // messages.
 const messaging = firebase.messaging();
 // [END initialize_firebase_in_sw]
 **/
 firebase.initializeApp({
   'messagingSenderId': '438060110908'
 });
 const messaging = firebase.messaging();
// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});
// [END background_handler]