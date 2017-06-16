@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="panel-name">Roles</h3>

                        <a class="btn btn-default btn-sm" href="{{route('admin.roles.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create new role
                        </a>
                    </div>

                    @if($roles->count() > 0)
                        <table class="table table-condensed table-bordered table-striped">
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
                            @foreach($roles as $role)
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
                                            @include('actions.edit', ['action' =>route('admin.roles.edit', ['role' => $role->id])])
                                        @endcan
                                        {{-- Delete --}}
                                        @can('delete', $role)
                                            @include('actions.delete', ['action' =>route('admin.roles.destroy', ['role' => $role->id])])
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
