@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-name">Edit Permission</h3>
                    </div>

                    <div class="panel-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('admin.permissions.update', ['permission' => $permission->id]) }}">

                            {{ method_field('PATCH') }}

                            {{ csrf_field() }}

                            @include('admin.permissions.fields', $permission->toArray())

                            {{-- Submit Field --}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-default" href="{{route('admin.permissions.index')}}">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

