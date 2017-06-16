@extends('layouts.app')

@section('content')
    <div class="container">
        @role('admin|moderator')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="panel-name">Notifications</h3>

                        @if(Auth::user()->unreadNotifications()->count() > 1)
                            <form role="form" method="POST" action="{{route('notifications.all')}}"
                                  style="display: inline-block">

                                {{ csrf_field() }}

                                {{ method_field('PATCH') }}

                                <button type="submit" class="btn btn-sm btn-default">
                                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Acknowledge all notifications
                                </button>

                            </form>
                        @endif

                    </div>

                    @if(Auth::user()->unreadNotifications()->count() > 0)
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Condition</th>
                                <th>Recorded Value</th>
                                <th>Trigger Value</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (Auth::user()->unreadNotifications as $notification)
                                <tr class="{{$notification->data['context']}}">
                                    <td>{{$notification->data['condition']}}</td>
                                    <td>{{$notification->data['recorded_value']}}</td>
                                    <td>{{$notification->data['trigger_value']}}</td>
                                    <td>{{$notification->created_at}}</td>
                                    <td>

                                        @include('actions.check', ['tip' => 'Acknowledge notification','action' =>route('notifications.read', ['notification' => $notification->id])])

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    @else
                        <div class="panel-body">
                            <p class="text-center text-info">There are no notifications to acknowledge.</p>
                        </div>
                    @endif


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-name">Acknowledged Notifications</h3></div>
                    @if(Auth::user()->readNotifications()->count() > 0)
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Condition</th>
                                <th>Recorded Value</th>
                                <th>Trigger Value</th>
                                <th>Date</th>
                                <th>Acknowledged</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach (Auth::user()->readNotifications()->limit(100)->get() as $notification)

                                <tr>
                                    <td>{{$notification->data['condition']}}</td>
                                    <td>{{$notification->data['recorded_value']}}</td>
                                    <td>{{$notification->data['trigger_value']}}</td>
                                    <td>{{$notification->created_at}}</td>
                                    <td>{{$notification->read_at}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="panel-body">
                            <p class="text-center text-info">No acknowledge notifications.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        @endrole
    </div>
@endsection
