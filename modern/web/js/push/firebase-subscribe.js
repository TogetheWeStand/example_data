firebase.initializeApp({
    messagingSenderId: '1046611692339'
});

if ('Notification' in window) {
    var messaging = firebase.messaging();

    $('.subscribe').on('click', function() {
        if (Notification.permission === "denied") {
            alert("Возможность получать уведомления заблокирована Вами ранее, снимите блокировку и попробуйте снова");
        } else {
            getTokenFromFirebaseLocalDB(subscribe);
        }
    });

    messaging.onMessage(function(payload) {
        navigator.serviceWorker.register('/messaging-sw.js');
        navigator.serviceWorker.ready.then(function(registration) {
            payload.notification.data = payload.notification;
            registration.showNotification(payload.notification.title, payload.notification);
        }).catch(function(error) {
            console.log('ServiceWorker registration failed', error);
        });
    });
}

function subscribe(curentToken) {
    messaging.requestPermission().then(function() {
        messaging.getToken().then(function(newToken) {
            setTokenToFirebaseLocalDB(newToken);
            sendTokenToServer(curentToken, newToken);
        }).catch(function(error) {
            console.log("Get token error: " + error);
        });
    });
}

function sendTokenToServer(currentToken, newToken) {
    var url = '/notice/notice/user-subscription';
    $.post(url, {curentToken: currentToken, newToken: newToken}, function(data) {
        console.log('Subscription result: ' + data);
    });
}

function getTokenFromFirebaseLocalDB(callback)
{
    var request = window.indexedDB.open("fcm_token_details_db", 1);
    var db;

    request.onerror = function(event) {
        console.log("Db open error: " + event.target.errorCode);
    };

    request.onsuccess = function(event) {
        db = event.target.result;

        if (db.objectStoreNames.length) {
            db.onerror = function(event) {
                console.log("getTokenFromFirebaseLocalDB - Database processing error: " + event.target.errorCode);
            };

            db.
            transaction("fcm_token_object_Store").
            objectStore("fcm_token_object_Store").
            get("deviceToken").onsuccess = function(event) {
                if (event.target.result !== undefined) {
                    callback(event.target.result.value);
                } else {
                    callback(null);
                }
            }
        } else {
            callback(null);
        }
    };
}

function setTokenToFirebaseLocalDB(token)
{
    var request = window.indexedDB.open("fcm_token_details_db", 1);
    var db;

    request.onerror = function(event) {
        console.log("Db open error: " + event.target.errorCode);
    };

    request.onsuccess = function(event) {
        db = event.target.result;

        if (db.objectStoreNames.length) {
            db.onerror = function(event) {
                console.log("setTokenToFirebaseLocalDB - Database processing error: " + event.target.errorCode);
            };

            db.
            transaction(["fcm_token_object_Store"], "readwrite").
            objectStore("fcm_token_object_Store").
            put({swScope: "deviceToken", value: token}).onsuccess = function(event) {
                console.log("Adding result: " + event.target.result);
            }
        } else {
            console.log("DB store incorrect!");
        }
    };
}