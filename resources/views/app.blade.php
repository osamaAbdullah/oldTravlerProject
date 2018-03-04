<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    <style>
        body
        {
            overflow-x: hidden;
            background-image: url("../images/rr.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 1080px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg my-nav navbar-dark bg-dark">

    <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('images/unnamed.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        Fast Traveling
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="container">
            <ul class="navbar-nav ml-auto nav-justified">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">AboutUs</a>
                </li>
            </ul>

        </div>
        <div class="container">
            @if (!Auth::guard('web')->check()&!Auth::guard('driver')->check())
                <div class="btn-group" role="group" style="padding-left: 40px;">
                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sign In
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin-left: -25px;background-color: #999999;">
                        <a class="dropdown-item" href="{{route('passengers.login')}}">Passenger</a>
                        <a class="dropdown-item" href="{{route('drivers.login')}}">Driver</a>
                    </div>
                </div>
                <div class="btn-group" role="group" style="margin-left: 8px;">
                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sign Up
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="background-color: #999999;">
                        <a class="dropdown-item" href="{{route('passengers.register')}}">Passenger</a>
                        <a class="dropdown-item" href="{{route('drivers.register')}}">Driver</a>
                    </div>
                </div>
            @endif
            @if (Auth::guard('driver')->check())
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{  Auth::guard('driver')->user()->first_name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"href="{{route('drivers.profile.show',Auth::guard('driver')->user()->id)}}">
                            <i class="user icon"></i>
                            Profile
                        </a>
                        <a class="dropdown-item"href="{{route('drivers.dashboard.show')}}">
                            <i class="dashboard icon"></i>
                            DashBoard
                        </a>
                        <a class="dropdown-item"onclick="logout()">
                            <form id="logout" style="display:none" action="{{ route('drivers.logout') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit"value="Logout D"class="ui inverted button">
                            </form>
                            <i class="sign out icon"></i>
                            Logout
                        </a>
                    </div>
                </div>
            @endif
            @if (Auth::guard('web')->check())
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{  Auth::guard('web')->user()->first_name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"href="{{route('passengers.profile.show',Auth::guard('web')->user()->id)}}">
                            <i class="user icon"></i>
                            Profile
                        </a>
                        <a class="dropdown-item"href="{{route('passengers.dashboard.show')}}">
                            <i class="dashboard icon"></i>
                            DashBoard
                        </a>
                        <a class="dropdown-item"onclick="logout()">
                            <form id="logout" style="display:none" action="{{ route('passengers.logout') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit"value="Logout D"class="ui inverted button">
                            </form>
                            <i class="sign out icon"></i>
                            Logout
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
    <div id="app">
        @include('partials._messages')
        @yield('content')
    </div>
</body>
@yield('scripts')
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</html>