<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Scripts --}}
    <script src="https://use.fontawesome.com/2ae53ff47d.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    {{-- Collapsed Hamburger --}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    {{-- Branding Image --}}
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    {{-- Left Side Of Navbar --}}
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="">
                                <span class="fa fa-flag" aria-hidden="true"></span> Countries
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="fa fa-file-code-o" aria-hidden="true"></span> API Docs
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="fa fa-plus" aria-hidden="true"></span> New volunteer
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="fa fa-newspaper-o" aria-hidden="true"></span> News
                            </a>
                        </li>
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    <ul class="nav navbar-nav navbar-right">
                        {{-- Authentication Links --}}
                        @if (Auth::guest())
                            <li>
                                <a href="{{ route('login') }}">
                                    <span class="fa fa-sign-in"></span> @lang('auth.nav-login')
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('country') }}">
                                    <span class="fa fa-bell-o" aria-hidden="true"></span>
                                    <span class="badge">0</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="fa fa-user" aria-hidden="true"></span>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="">
                                            <span class="fa fa-cogs"></span> @lang('nav.account-settings')
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="fa fa-sign-out" aria-hidden="true"></span> @lang('auth.nav-logout')
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
