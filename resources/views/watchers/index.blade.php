@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="panel-name">Watchers</h3>

                        <a class="btn btn-default btn-sm" href="{{route('watchers.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create new watcher
                        </a>
                    </div>

                    @if($watchers->count() > 0)
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Description</th>
                                <th>Trigger Condition</th>
                                <th>Trigger Value</th>
                                <th>Observing</th>
                                <th>Creator</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($watchers as $watcher)
                                <tr>
                                    <th>
                                        {{$watcher->id}}
                                    </th>
                                    <td>
                                        {{$watcher->description}}
                                    </td>
                                    <td>
                                        {{$watcher->condition}}
                                    </td>
                                    <td>
                                        {{$watcher->trigger_value}}
                                    </td>
                                    <td>
                                        {{$watcher->observing}}
                                    </td>
                                    <td>
                                        {{$watcher->creator->name}}
                                    </td>
                                    <td>
                                        {{$watcher->created_at}}
                                    </td>
                                    <td>
                                        {{$watcher->updated_at}}
                                    </td>
                                    <td>
                                        @include('actions.edit', ['action' =>route('watchers.edit', ['watcher' => $watcher->id])])
                                        @include('actions.delete', ['action' =>route('watchers.destroy', ['watcher' => $watcher->id])])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="panel-body"><p class="text-center text-warning"><strong>There are no configured
                                    watchers.</strong></p></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
