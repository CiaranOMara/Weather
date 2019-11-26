<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @role('admin|moderator')
                                        <a class="dropdown-item {{ set_active('trigger*') }}" href="{{ route('triggers.index') }}">Triggers</a>
                                    @endrole

                                    <div class="dropdown-divider"></div>

                                    @role('admin')

                                    <h6 class="dropdown-header">Admin Group</h6>

                                    <a class="dropdown-item {{ set_active('admin/permission*') }}" href="{{ route('admin.permissions.index') }}">Permissions</a>
                                    <a class="dropdown-item {{ set_active('admin/role*') }}" href="{{ route('admin.roles.index') }}">Roles</a>
                                    <a class="dropdown-item {{ set_active('admin/user*') }}" href="{{ route('admin.users.index') }}">Users</a>

                                    <div class="dropdown-divider"></div>
                                    @endrole

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div id="flash" class="container">
                @include('flash::message')
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Script hosted on running laravel-echo-server -->
{{--    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>--}}

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            // Flash messages
            $('#flash-overlay-modal').modal();
            $('#flash div.alert').not('.alert-important').delay(5000).fadeOut(350);

            // Bootstrap opt-in functionality
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();

        })
    </script>

</body>
</html>
