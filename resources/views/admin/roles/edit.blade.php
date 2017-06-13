@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-name">Edit Role</h3>
                    </div>

                    <div class="panel-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('admin.roles.update', ['role' => $role->id]) }}">

                            {{ method_field('PATCH') }}

                            {{ csrf_field() }}

                            @include('admin.roles.fields', $role->toArray())

                            {{-- Submit Field --}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-default" href="{{route('admin.roles.index')}}">Cancel</a>
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
                        <h3 class="panel-name">Role's Permissions</h3>
                    </div>


                    @if($role->permissions->count() > 0)
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Model</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($role->permissions as $permission)
                                <tr>
                                    <th>
                                        {{$permission->id}}
                                    </th>
                                    <td>
                                        {{$permission->name}}
                                    </td>
                                    <td>
                                        {{$permission->slug}}
                                    </td>
                                    <td>
                                        {{$permission->description}}
                                    </td>
                                    <td>
                                        {{$permission->model}}
                                    </td>
                                    <td>
                                        {{$permission->created_at}}
                                    </td>
                                    <td>
                                        {{$permission->updated_at}}
                                    </td>
                                    <td>
                                        @include('actions.edit', ['action' => route('admin.permissions.edit', ['permission'=>$permission->id])])
                                        @include('actions.delete', ['tip'=>'Remove from role','action' => route('admin.roles.permissions.destroy', ['role'=>$role->id, 'permission'=>$permission->id])])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if($permissions->count() > 0)
                        <div class="panel-body">

                            <h4>Add Permission</h4>
                            <form class="form-inline" role="form" method="POST"
                                  action="{{ route('admin.roles.permissions.store', ['role' => $role->id]) }}">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <select class="form-control" name="permission">

                                        @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add permission
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

