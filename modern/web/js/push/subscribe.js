if (!('serviceWorker' in navigator)) {
    console.log("Service Worker isn't supported on this browser!");
} else if (!('PushManager' in window)) {
    console.log("Push isn't supported on this browser!");
} else {
    registerServiceWorker();
}

function registerServiceWorker() {
    return navigator.serviceWorker.register('js/push/service-worker.js')
        .then(function(registration) {
            console.log('Service worker successfully registered.');
            return registration;
        })
        .catch(function(err) {
            console.error('Unable to register service worker.', err);
        });
}