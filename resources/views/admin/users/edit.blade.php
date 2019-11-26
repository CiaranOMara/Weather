@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Edit User</h3>
                    </div>

                    <div class="card-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('admin.users.update', ['user' => $user->id]) }}">

                            {{ method_field('PATCH') }}

                            @csrf

                            @include('admin.users.fields', $user->toArray())

                            {{-- Submit Field --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-secondary" href="{{route('admin.users.index')}}">Cancel</a>
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
                        <h3 class="mb-0">User's Roles</h3>
                    </div>

                    @if($user->roles->count() > 0)
                        <table class="table table-bordered table-sm table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->roles as $role)
                                <tr>
                                    <th>
                                        {{$role->id}}
                                    </th>
                                    <td>
                                        {{$role->name}}
                                    </td>
                                    <td>
                                        {{$role->slug}}
                                    </td>
                                    <td>
                                        {{$role->description}}
                                    </td>
                                    <td>
                                        {{$role->level}}
                                    </td>
                                    <td>
                                        {{$role->created_at}}
                                    </td>
                                    <td>
                                        {{$role->updated_at}}
                                    </td>
                                    <td>
                                        {{-- Edit --}}
                                        @can('update', $role)
                                            @include('actions.edit', ['action' => route('admin.roles.edit', ['role'=>$role->id])])
                                        @endcan

                                        {{-- Detach --}}
                                        @can('detachRole', [$user,$role])
                                            @include('actions.unsubscribe', ['tip'=>'Remove role from user','action' => route('admin.users.roles.destroy', ['user'=>$user->id, 'role'=>$role->id])])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if($roles->count() > 0)
                        <div class="card-body">

                            <h5 class="card-title">Add Role</h5>

                            <form class="form-inline" role="form" method="POST"
                                  action="{{ route('admin.users.roles.store', ['user' => $user->id]) }}">

                                @csrf

                                <div class="form-group mr-1">
                                    <select class="form-control" name="role">

                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Add role
                                    </button>
                                </div>

                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">User's Permissions</h3>
                    </div>

                    @if($user->getPermissions()->count() > 0)
                        <table class="table table-bordered table-sm table-striped mb-0">
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

                            @foreach($user->rolePermissions()->get() as $permission)
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
                                        {{-- Edit --}}
                                        @can('update', $permission)
                                            @include('actions.edit', ['action' => route('admin.permissions.edit', ['permission'=>$permission->id])])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($user->userPermissions as $permission)
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
                                        {{-- Edit --}}
                                        @can('update', $permission)
                                            @include('actions.edit', ['action' => route('admin.permissions.edit', ['permission'=>$permission->id])])
                                        @endcan

                                        {{-- Detach --}}
                                        @can('detachPermission', [$user,$permission])
                                            @include('actions.unsubscribe', ['tip'=>'Remove permission from user','action' => route('admin.users.permissions.destroy', ['user'=>$user->id, 'permission'=>$permission->id])])
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if($permissions->count() > 0)
                        <div class="card-body">

                            <h5 class="card-title">Add Permission</h5>

                            <form class="form-inline" role="form" method="POST"
                                  action="{{ route('admin.users.permissions.store', ['user' => $user->id]) }}">

                                @csrf

                                <div class="form-group mr-1">
                                    <select class="form-control" name="permission">

                                        @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Add permission
                                    </button>
                                </div>

                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

