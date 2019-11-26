@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Edit Trigger</h3>
                    </div>

                    <div class="card-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('triggers.update', ['trigger' => $trigger->id]) }}">

                            {{ method_field('PATCH') }}

                            @csrf

                            @include('triggers.fields', $trigger->toArray())

                            {{-- Submit Field --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-secondary" href="{{route('triggers.index')}}">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Subscribed Users</h3>
                    </div>

                    @if($trigger->users->count() > 0)
                        <table class="table table-bordered table-sm table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subscribed</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trigger->users as $user)
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
                                        @include('actions.unsubscribe', ['tip'=>'Un-subscribe user','action' =>route('triggers.users.destroy', ['trigger'=>$trigger->id, 'user'=>$user->id])])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if($users->count() > 0)
                        @permission('triggers.attach.user')
                        <div class="card-body">

                            <h5 class="card-title">Subscribe User</h5>

                            <form class="form-inline" role="form" method="POST"
                                  action="{{ route('triggers.users.store', ['trigger' => $trigger->id]) }}">

                                @csrf

                                <div class="form-group mr-1">
                                    <select class="form-control" name="user">

                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Add user
                                    </button>
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

