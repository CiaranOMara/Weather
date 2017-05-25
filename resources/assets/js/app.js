/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


window.Chartist = require('chartist');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('chart', require('./components/Chart.vue'));

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            messages: [],
            humidity: {
                series: [
                    {
                        name: "Humidity",
                        data: []
                    }
                ]
            },
            temperature: {

                series: [
                    {
                        name: "Temperature",
                        data: []
                    }
                ]
            }
        }
    },
    methods: {
        listenMessage (message) {

            console.log("received: ", message);

            this.messages.push(
                message
            );
        },
        streamData(base, obj) {
            this[base].series[0].data.shift();
            this[base].series[0].data.push({x: new Date(obj.created_at), y: obj.value});
        },
        loadMessages(){

        },
        loadHumidity() {
            axios
                .get('api/humidity', {
                    // params: {
                    //     ID: 12345
                    // }
                })
                .then((response) => {
                    console.log(response);

                    const data = response.data;

                    _.each(data, datum => {
                        this.humidity.series[0].data.push({x: new Date(datum.created_at), y: datum.value});
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadTemperature() {
            axios
                .get('api/temperature', {
                    // params: {
                    //     ID: 12345
                    // }
                })
                .then((response) => {
                    console.log(response);

                    const data = response.data;

                    _.each(data, datum => {
                        this.temperature.series[0].data.push({x: new Date(datum.created_at), y: datum.value});
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        load(){
            this.loadMessages(); //TODO
            this.loadHumidity();
            this.loadTemperature();
        }
    },
    created () {

        this.load();


        if (typeof io === "undefined") {
            alert('please check your laravel-echo-server status!');
        } else {
            Echo.private('message')
                .listen('SendMessageEvent', function (e) {
                    if (e.message) {
                        this.listenMessage(e.message);
                    }
                });

            Echo.channel('weather')
                .listen('HumidityWasLogged', (e) => {

                    console.debug("Received HumidityWasLogged:", e);

                    if (e.humidity) {
                        this.streamData("humidity", e.humidity);
                    }
                })
                .listen('TemperatureWasLogged', (e) => {

                    console.debug("Received TemperatureWasLogged:", e);

                    if (e.temperature) {
                        this.streamData("temperature", e.temperature);
                    }
                });
        }
    }
});
