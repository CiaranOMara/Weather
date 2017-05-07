
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

app = new Vue({
    el: '#app',
    data: function () {
        return {
            messages: []
        }
    },
    methods: {
        listenMessage (message) {

            console.log("received: ", message);

            this.messages.push(
                message
            );
        }
    },
    created () {
        if (typeof io === "undefined") {
            alert('please check your laravel-echo-server status!');
        } else {
            Echo.channel('everyone')
                .listen('SendMessageEvent', function (e) {
                    if (e.message) {
                        app.listenMessage(e.message);
                    }
                });
        }
    }
});
