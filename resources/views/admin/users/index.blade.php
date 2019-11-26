@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header d-flex justify-content-between">
                        <h3 class="mb-0">Users</h3>
                        <a class="btn btn-secondary btn-sm align-self-center" href="{{route('admin.users.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create new user
                        </a>
                    </div>

                    @if($users->count() > 0)
                        <table class="table table-bordered table-sm table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>
                                        {{$user->id}}
                                    </th>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->verified}}
                                    </td>
                                    <td>
                                        {{$user->created_at}}
                                    </td>
                                    <td>
                                        {{$user->updated_at}}
                                    </td>
                                    <td>
                                        {{-- Edit --}}
                                        @can('update', $user)
                                            @include('actions.edit', ['action' =>route('admin.users.edit', ['user' => $user->id])])
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete', $user)
                                            @include('actions.delete', ['action' =>route('admin.users.destroy', ['user' => $user->id])])
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
