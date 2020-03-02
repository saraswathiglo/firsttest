<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
<link rel="manifest" href="/manifest.json">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <link rel="stylesheet" href="main.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <style>
    div {
        margin-bottom: 15px;
    }
</style>
    </head>
    <body>

        




        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                @if (Route::has('login'))
                    @auth
                        <div class="title m-b-md">First Test Data</div>
                        <div class="">
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Title</td>
                                        <td>URL</td>
                                        <td>Description</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($links as $link)
                                        <tr>
                                            <td>{{ $link->title }}</td>
                                            <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                            <td>{{ $link->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>                                
                            </table>
                            
                        </div>
                    @else
                        <div class="title m-b-md">
                            Laravel
                        </div>
                        <div class="links">
                            <a href="https://laravel.com/docs">Documentation</a>
                            <a href="https://laracasts.com">Laracasts</a>
                            <a href="https://laravel-news.com">News</a>
                            <a href="https://forge.laravel.com">Forge</a>
                            <a href="https://github.com/laravel/laravel">GitHub</a>
                        </div>
                    @endauth
                @endif

            </div>
        </div>


        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
          <!-- div to display the generated Instance ID token -->
          <div id="token_div" style="display: none;">
            <h4>Instance ID Token</h4>
            <p id="token" style="word-break: break-all;"></p>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                    onclick="deleteToken()">Delete Token</button>
          </div>
          <!-- div to display the UI to allow the request for permission to
               notify the user. This is shown if the app has not yet been
               granted permission to notify. -->
          <div id="permission_div" style="display: none;">
            <h4>Needs Permission</h4>
            <p id="token"></p>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                    onclick="requestPermission()">Request Permission</button>
          </div>
          <!-- div to display messages received by this app. -->
          <div id="messages"></div>
        </div>


    <div id="token"></div>
    <div id="msg"></div>
    <div id="notis"></div>
    <div id="err"></div>

<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-messaging.js"></script>
<!--<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js"></script>
     <script>
        MsgElem = document.getElementById("msg")
        TokenElem = document.getElementById("token")
        NotisElem = document.getElementById("notis")
        ErrElem = document.getElementById("err")
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
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

        const messaging = firebase.messaging();

        messaging
            .requestPermission()
            .then(function () {
                MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");

                // get the token in the form of promise
                return messaging.getToken();
            })
            .then(function(token) {
                TokenElem.innerHTML = "token is : " + token
            })
            .catch(function (err) {
                ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                console.log("Unable to get permission to notify.", err);
            });
        /*messaging.onMessage(function(payload) {

            console.log("Message received. ", payload);
            NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload);
        });*/
    </script>

<!--<script src="https://www.gstatic.com/firebasejs/7.9.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.9.2/firebase-messaging.js"></script>-->

   <!-- 
   <script src="https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js"></script>


<script>
     MsgElem = document.getElementById("msg")
        TokenElem = document.getElementById("token")
        NotisElem = document.getElementById("notis")
        ErrElem = document.getElementById("err")
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyBhBTGhrdOoumj0LUiN8o4DFJM1fzdjReQ",
    authDomain: "test-7d4b6.firebaseapp.com",
    databaseURL: "https://test-7d4b6.firebaseio.com",
    projectId: "test-7d4b6",
    storageBucket: "test-7d4b6.appspot.com",
    messagingSenderId: "438060110908",
    appId: "1:438060110908:web:e616615c25382437"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
//const messaging = firebase.messaging();
//messaging.usePublicVapidKey("BLwlsLqVlViuRXdj-DH7idVWD1nfb-cimI_Ih1AQ7Oz5nFZk0U2Te5hTl0V0mvKTkcdCeY8rI4mWzX25XoPU22g");
        

       const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");

                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
                TokenElem.innerHTML = "token is : " + token
            })
            .catch(function (err) {
                ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                console.log("Unable to get permission to notify.", err);
            });

        messaging.onMessage(function(payload) {
            console.log("Message received. ", payload);
            NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload) 
        });
    </script>-->

  <!--  <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script> -->
<!--<script src="https://www.gstatic.com/firebasejs/7.9.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.9.2/firebase-messaging.js"></script>
     <script>
        MsgElem = document.getElementById("msg")
        TokenElem = document.getElementById("token")
        NotisElem = document.getElementById("notis")
        ErrElem = document.getElementById("err")
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
        var config = {
            apiKey: "AIzaSyBhBTGhrdOoumj0LUiN8o4DFJM1fzdjReQ",
            authDomain: "test-7d4b6.firebaseapp.com",
            databaseURL: "https://test-7d4b6.firebaseio.com",
            projectId: "test-7d4b6",
            storageBucket: "test-7d4b6.appspot.com",
            messagingSenderId: "438060110908",
            appId: "1:438060110908:web:e616615c25382437"
        };
        firebase.initializeApp(config);

        const messaging = firebase.messaging();
       

messaging.setBackgroundMessageHandler(payload => {
  console.log('Received background message ', payload);
  // here you can override some options describing what's in the message; 
  // however, the actual content will come from the Webtask
  const notificationTitle = "Background message title"
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/assets/images/logo-128.png'
  };
  return self.registration.showNotification(notificationTitle, notificationOptions);
});

messaging.onMessage(function(payload) {
  console.log('Message received. ', payload);
});

    </script>-->
    
<script>
const tokenDivId = 'token_div';
  const permissionDivId = 'permission_div';

  // [START refresh_token]
  // Callback fired if Instance ID token is updated.
  messaging.onTokenRefresh(() => {
    messaging.getToken().then((refreshedToken) => {
      console.log('Token refreshed.');
      // Indicate that the new Instance ID token has not yet been sent to the
      // app server.
      setTokenSentToServer(false);
      // Send Instance ID token to app server.
      sendTokenToServer(refreshedToken);
      // [START_EXCLUDE]
      // Display new Instance ID token and clear UI of all previous messages.
      resetUI();
      // [END_EXCLUDE]
    }).catch((err) => {
      console.log('Unable to retrieve refreshed token ', err);
      showToken('Unable to retrieve refreshed token ', err);
    });
  });
  // [END refresh_token]

  // [START receive_message]
  // Handle incoming messages. Called when:
  // - a message is received while the app has focus
  // - the user clicks on an app notification created by a service worker
  //   `messaging.setBackgroundMessageHandler` handler.
  messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    // [START_EXCLUDE]
    // Update the UI to include the received message.
    appendMessage(payload);
    // [END_EXCLUDE]
    NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload) 
  });
  // [END receive_message]

  function resetUI() {
    clearMessages();
    showToken('loading...');
    // [START get_token]
    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken().then((currentToken) => {
      if (currentToken) {
        sendTokenToServer(currentToken);
        updateUIForPushEnabled(currentToken);
      } else {
        // Show permission request.
        console.log('No Instance ID token available. Request permission to generate one.');
        // Show permission UI.
        updateUIForPushPermissionRequired();
        setTokenSentToServer(false);
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      showToken('Error retrieving Instance ID token. ', err);
      setTokenSentToServer(false);
    });
    // [END get_token]
  }


  function showToken(currentToken) {
    // Show token in console and UI.
    console.log(currentToken);
    const tokenElement = document.querySelector('#token');
    tokenElement.textContent = currentToken;
  }

  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }

  }

  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }

  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }

  function showHideDiv(divId, show) {
    const div = document.querySelector('#' + divId);
    if (show) {
      div.style = 'display: visible';
    } else {
      div.style = 'display: none';
    }
  }

  function requestPermission() {
    console.log('Requesting permission...');
    // [START request_permission]
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        // [START_EXCLUDE]
        // In many cases once an app has been granted notification permission,
        // it should update its UI reflecting this.
        resetUI();
        // [END_EXCLUDE]
      } else {
        console.log('Unable to get permission to notify.');
      }
    });
    // [END request_permission]
  }

  function deleteToken() {
    // Delete Instance ID token.
    // [START delete_token]
    messaging.getToken().then((currentToken) => {
      messaging.deleteToken(currentToken).then(() => {
        console.log('Token deleted.');
        setTokenSentToServer(false);
        // [START_EXCLUDE]
        // Once token is deleted update UI.
        resetUI();
        // [END_EXCLUDE]
      }).catch((err) => {
        console.log('Unable to delete token. ', err);
      });
      // [END delete_token]
    }).catch((err) => {
      console.log('Error retrieving Instance ID token. ', err);
      showToken('Error retrieving Instance ID token. ', err);
    });

  }

  // Add a message to the messages element.
  function appendMessage(payload) {
    const messagesElement = document.querySelector('#messages');
    const dataHeaderELement = document.createElement('h5');
    const dataElement = document.createElement('pre');
    dataElement.style = 'overflow-x:hidden;';
    dataHeaderELement.textContent = 'Received message:';
    dataElement.textContent = JSON.stringify(payload, null, 2);
    messagesElement.appendChild(dataHeaderELement);
    messagesElement.appendChild(dataElement);
  }

  // Clear the messages element of all children.
  function clearMessages() {
    const messagesElement = document.querySelector('#messages');
    while (messagesElement.hasChildNodes()) {
      messagesElement.removeChild(messagesElement.lastChild);
    }
  }

  function updateUIForPushEnabled(currentToken) {
    showHideDiv(tokenDivId, true);
    showHideDiv(permissionDivId, false);
    showToken(currentToken);
  }

  function updateUIForPushPermissionRequired() {
    showHideDiv(tokenDivId, false);
    showHideDiv(permissionDivId, true);
  }

  resetUI(); 

    </script>
    </body>
</html>
