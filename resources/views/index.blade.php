<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- Site Properties -->
    <title>Homepage | traveling</title>
    <link rel="stylesheet"href="{{ asset('css/app.css') }}">
    <link rel="stylesheet"href="{{ asset('css/mystyle.css') }}">
    <link rel="stylesheet"href="{{asset('css/slider.css')}}">
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
        <div class="container" style="padding-left: 100px;">
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
                <div class="dropdown" style="padding-left: 100px;">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{  Auth::guard('driver')->user()->first_name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-left: 55px;">
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
                <div class="dropdown" style="padding-left: 100px;">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{  Auth::guard('web')->user()->first_name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-left: 55px;">
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
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/tt.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block" style="top:50%;">
                <h2>WELCOME TO FAST TRAVELING</h2>

                <button class="btn btn-lg btn-danger">CREATE PROFILE</button>

            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/ll.jpg') }}" alt="Second slide">
            <div class="carousel-caption d-none d-md-block" style="top:50%;">
                <h2>FAST TIME IN TIME</h2>
                <p>WITH FAST TRAVELING <br> YOU WILL BE IN YOUR PALCE <br> IN TIME</p>
                <button class="btn btn-lg btn-danger">CHECK TRAVELING</button>
            </div>
        </div>

        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/bb.jpg') }}" alt="Third slide">
            <div class="carousel-caption d-none d-md-block" style="top:50%;">
                <h2>PICK UP YOUR BAG <br> TRAVEL NOW</h2>

                <button class="btn btn-lg btn-danger">CLICK HERE</button>
            </div>
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>
<div class="container text-center mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2>OUR <strong class="text-primary">FEATURES</strong></h2>
            <p>Fast Vachel's , Safety Tour , Less Money , MORE AND MORE </p>
        </div>
    </div>
</div>
<div class="container-fluid choose">
    <div class="container pt-4 pb-4">
        <div class="row text-center mb-4">
            <div class="col-md-12">
                <h2 class="text-primary">OUR SERVICES</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card upper-card">
                    <div class="icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                    <div class="card-body">
                        <h3>Car</h3>
                        <p>Our car is a brand model with fast engine<br>brand seat , cold chiller ,  </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card upper-card">
                    <div class="icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                    <div class="card-body">
                        <h3>Bus</h3>
                        <p>Our bus is a brand model with fast engine<br>brand seat , cold chiller ,  </p>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card upper-card">
                    <div class="icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                    <div class="card-body">
                        <h3>MiniBus</h3>
                        <p>Our Mini is a brand model <br>with fast engine brand seat </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-12">
            <h2>WHY <strong class="text-primary">CHOOSE</strong> US</h2>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-8 offset-md-2">
            We think that , we are first system in <strong class="text-primary">KURDISTAN</strong> , for more year ,there was a problem
            <br> with the traveling in case <strong class="text-primary">DORMITORY</strong> , which Student can not go back to home in time
            <br>or waiting or More and More Problem , So most of Students choose <strong class="text-primary">FAST TRAVELING</strong>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <img src="{{ asset('images/taxi_car.png') }}" alt="image" class="img-fluid m-auto">
        </div>
        <div class="col-md-6">
            <p>Now , Know about US from Below</p>

            <div class="media">
                <i class="fa fa-at" aria-hidden="true"></i>
                <div class="media-body">
                    <h5 class="mt-0">e-Mail</h5>

                    Ahmed.001883532@gmail.com

                </div>
            </div>


            <div class="media">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="media-body">
                    <h5 class="mt-0">Phone Number</h5>

                    0967-750544-3434

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    function logout() {$('#logout').submit();}
</script>
</html>