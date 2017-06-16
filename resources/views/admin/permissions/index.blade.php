@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="panel-name">Permissions</h3>

                        <a class="btn btn-default btn-sm" href="{{route('admin.permissions.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create new permission
                        </a>
                    </div>

                    @if($permissions->count() > 0)
                        <table class="table table-bordered table-condensed table-striped">
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
                            @foreach($permissions as $permission)
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
                                            @include('actions.edit', ['action' =>route('admin.permissions.edit', ['permission' => $permission->id])])
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete', $permission)
                                            @include('actions.delete', ['action' =>route('admin.permissions.destroy', ['permission' => $permission->id])])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
