@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">

                    <div class="card-header">
                        <h3 class="mb-0">Create Trigger</h3>
                    </div>

                    <div class="card-body">
                        @include('errors.list')

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('triggers.store') }}">

                            @csrf

                            @include('triggers.fields')

                            {{-- Submit Field --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                    <a class="btn btn-secondary" href="{{route('triggers.index')}}">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

