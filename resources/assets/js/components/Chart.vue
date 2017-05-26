<template>
    <vue-chartist :data="data" :options="options" :type="type"></vue-chartist>
</template>

<script>

    import VueChartist from 'v-chartist';

    export default {
        components: {
            'vue-chartist': VueChartist
        },
        props: {
            type: {
                type: String,
                default: 'Line'
            },
            data: {
                data: {
                    type: Object,
                    default(){
                        return {
                            name: "Chart Name",
                            series: []
                        }
                    }
                }
            },

            options: {
                type: Object,
                default() {
                    return {
                        lineSmooth: false,
                        fullWidth: true,
                        chartPadding: {
                            right: 40
                        },
                        axisX: {
                            type: Chartist.FixedScaleAxis,
                            divisor: 24,
                            labelInterpolationFnc (value) {
                                return moment(value).local().format('H:mm')
                            }
                        },
                    };
                },
            },
            listener: {
//                data(e) {
//                    console.log(e);
//                },
//                draw(e){
//                    console.debug(e)
//                }
            }
        },
        mounted(){
            console.log('Chart mounted.')
        }
    }
</script>
