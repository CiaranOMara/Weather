@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-name">Edit Watcher</h3>
                    </div>

                    <div class="panel-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('watchers.update', ['watcher' => $watcher->id]) }}">

                            {{ method_field('PATCH') }}

                            {{ csrf_field() }}

                            @include('watchers.fields', $watcher->toArray())

                            {{-- Submit Field --}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-default" href="{{route('watchers.index')}}">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-name">Subscribed Users</h3>
                    </div>


                    @if($watcher->users->count() > 0)
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subscribed</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($watcher->users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->created_at}}
                                    </td>

                                    <td>
                                        @include('actions.unsubscribe', ['tip'=>'Un-subscribe user','action' =>route('watchers.users.destroy', ['watcher'=>$watcher->id, 'user'=>$user->id])])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if($users->count() > 0)
                        @permission('watchers.attach.user')
                        <div class="panel-body">

                            <h4>Subscribe User</h4>
                            <form class="form-inline" role="form" method="POST"
                                  action="{{ route('watchers.users.store', ['watcher' => $watcher->id]) }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <select class="form-control" name="user">

                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add user
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        @endpermission
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

