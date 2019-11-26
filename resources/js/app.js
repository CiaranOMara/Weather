/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Chartist = require('chartist');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('chart', require('./components/Chart.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

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
    computed: {
        latestHumidity() {
            let data = _.get(this, 'humidity.series[0].data', null);

            console.debug('humidity data', data);

            if (data) {
                let last = _.last(data);

                console.debug("latest humidity:", last);

                return last ? `${last.y} %RH at ${moment(last.x).local().format('YYYY-MM-DD H:mm')}` : ''
            }

        },
        latestTemperature() {
            let data = _.get(this, 'temperature.series[0].data', null);

            console.debug('temperature data', data);

            if (data) {
                let last = _.last(data);

                console.debug("latest temperature:", last);

                return last ? `${last.y} ˚C at ${moment(last.x).local().format('YYYY-MM-DD H:mm')}` : ''
            }
        }
    },
    methods: {
        listenMessage(message) {

            console.log("received: ", message);

            this.messages.push(
                message
            );
        },
        pushDatum(base, datum) {
            let date = moment.utc(datum.created_at).local().toDate();

            this[base].series[0].data.push({x: date, y: datum.value});
        },
        streamData(base, datum) {
            this[base].series[0].data.shift();
            this.pushDatum(base, datum);
        },
        loadMessages() {
            //
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
                        this.pushDatum('humidity', datum);
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
                        this.pushDatum('temperature', datum)
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        load() {
            this.loadMessages(); //TODO
            this.loadHumidity();
            this.loadTemperature();
        }
    },
    created() {

        this.load();


        if (typeof io === "undefined") {
            alert('please check your laravel-echo-server status!');
        } else {
            Echo.channel('weather_database_message')
                .listen('SendMessageEvent', (e) => {

                    console.debug("Received SendMessageEvent:", e);

                    if (e.message) {
                        this.listenMessage(e.message);
                    }
                });

            Echo.channel('weather_database_weather')
                .listen('ReceivedHumidityRecord', (e) => {

                    console.debug("Received humidity record:", e);

                    if (e.humidity) {
                        this.streamData("humidity", e.humidity);
                    }
                })
                .listen('ReceivedTemperatureRecord', (e) => {

                    console.debug("Received temperature record:", e);

                    if (e.temperature) {
                        this.streamData("temperature", e.temperature);
                    }
                });
        }
    }
});
