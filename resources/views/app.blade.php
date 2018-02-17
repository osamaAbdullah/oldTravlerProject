<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/ui.css') }}" rel="stylesheet">
</head>
<body>
<div class="ui inverted vertical masthead center aligned segment">
    <div class="ui container">
    <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
            <i class="sidebar icon"></i>
        </a>
        <a class="active item"href="{{route('home')}}">Home</a>
        <a class="item">Work</a>
        <a class="item">Company</a>
        <a class="item">Careers</a>
        <div class="right item">
            @if (!Auth::guard('web')->check()&!Auth::guard('driver')->check())
                <div class="ui dropdown button">
                    <i class="sign in icon"></i>
                    <span>Sign In</span>
                    <div class="menu">
                        <a class="item" href="{{route('passengers.login')}}">
                            <i class="male icon"></i>
                            Sign In as Passenger
                        </a>
                        <a class="item"href="{{route('drivers.login')}}">
                            <i class="taxi icon"></i>
                            Sign In as Driver
                        </a>
                    </div>
                </div>

                <div class="ui dropdown button">
                    <i class="signup icon"></i>
                    <span>Sign Up</span>
                    <div class="menu">
                        <a class="item" href="{{route('passengers.register')}}">
                            <i class="male icon"></i>
                            Sign Up as Passenger
                        </a>
                        <a class="item"href="{{route('drivers.register')}}">
                            <i class="taxi icon"></i>
                            Sign Up as Driver
                        </a>
                    </div>
                </div>
            @endif
                @if (Auth::guard('driver')->check())
                    <div class="ui floating labeled icon dropdown">
                        <i class="setting icon"></i>
                        <span>{{  Auth::guard('driver')->user()->first_name }}</span>
                        <div class="menu">
                            <a class="item" href="{{route('drivers.profile.show',Auth::guard('driver')->user()->id)}}">
                                <i class="user icon"></i>
                                Profile
                            </a>
                            <a class="item" href="{{route('drivers.dashboard.show')}}">
                                <i class="dashboard icon"></i>
                                DashBoard
                            </a>
                            <a class="item" onclick="logout()">
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
                    <div class="ui floating labeled icon dropdown">
                        <i class="setting icon"></i>
                        <span>{{  Auth::guard('web')->user()->first_name }}</span>
                        <div class="menu">
                            <a class="item" href="{{route('passengers.profile.show',Auth::guard('web')->user()->id)}}">
                                <i class="user icon"></i>
                                Profile
                            </a>
                            <a class="item" href="{{route('passengers.dashboard.show')}}">
                                <i class="dashboard icon"></i>
                                DashBoard
                            </a>
                            <a class="item" onclick="logout()">
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
</div>
</div>
    <div id="app"style="margin-top: 50px">
        @include('partials._messages')
        @yield('content')
    </div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/ui.js') }}"></script>
@yield('scripts')
<script>
    $('.ui.dropdown').dropdown();
    function logout() {$('#logout').submit();}
</script>
</html>  