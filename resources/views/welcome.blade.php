@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center" v-if="messages.length">
            <div class="col-sm-12">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Messages</h3>
                    </div>

                    <div class="card-body">
                        <li v-for="message in messages">
                            @{{ message }}
                        </li>
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Humidity<small v-if="latestHumidity">: @{{ latestHumidity }}</small></h3>
                    </div>

                    <div class="card-body">
                        <chart ref="humidity" :data="humidity"></chart>
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Temperature<small v-if="latestTemperature">: @{{ latestTemperature }}</small></h3>
                    </div>

                    <div class="card-body">
                        <chart ref="temperature" :data="temperature"></chart>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


