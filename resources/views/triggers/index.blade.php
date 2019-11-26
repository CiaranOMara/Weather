@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header d-flex justify-content-between">

                        <h3 class="mb-0">Triggers</h3>

                        <a class="btn btn-secondary btn-sm align-self-center" href="{{route('triggers.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create new trigger
                        </a>
                    </div>

                    @if($triggers->count() > 0)
                        <table class="table table-bordered table-sm table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Description</th>
                                <th>Trigger Condition</th>
                                <th>Trigger Value</th>
                                <th>Observing</th>
                                <th>Creator</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($triggers as $trigger)
                                <tr>
                                    <th>
                                        {{$trigger->id}}
                                    </th>
                                    <td>
                                        {{$trigger->description}}
                                    </td>
                                    <td>
                                        {{$trigger->condition}}
                                    </td>
                                    <td>
                                        {{$trigger->value}}
                                    </td>
                                    <td>
                                        {{$trigger->observing}}
                                    </td>
                                    <td>
                                        {{$trigger->creator->name}}
                                    </td>
                                    <td>
                                        {{$trigger->created_at}}
                                    </td>
                                    <td>
                                        {{$trigger->updated_at}}
                                    </td>
                                    <td>
                                        {{-- Subscribe/Un-subscribe --}}
                                        @if(false !== array_search($trigger->id, $user_trigger_ids))
                                            @include('actions.unsubscribe', ['action' =>route('triggers.users.destroy', ['trigger'=>$trigger->id, 'user'=>Auth::user()->id])])
                                        @else
                                            @include('actions.subscribe', ['action' =>route('triggers.users.store', ['trigger' => $trigger->id])])
                                        @endif

                                        {{-- Edit --}}
                                        @can('update', $trigger)
                                            @include('actions.edit', ['action' =>route('triggers.edit', ['trigger' => $trigger->id])])
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete', $trigger)
                                            @include('actions.delete', ['action' =>route('triggers.destroy', ['trigger' => $trigger->id])])
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card-body">
                            <p class="text-center text-warning">There are no configured triggers.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
