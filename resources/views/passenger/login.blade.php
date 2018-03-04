@extends('app')
@section('content')
<div class="container-fluid bb">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <form class="form-container"method="POST"action="{{ route('passengers.login') }}">
                {{ csrf_field() }}
                <h1 style="color: #999999; text-align: center">Passenger Login</h1>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email"value="{{Request::old('email')}}">
                 </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                </div>
                <a href="{{route('passengers.password.request')}}">Forgot Your Password?</a>
                New to us? <a href="{{route('passengers.register')}}"> Sign Up</a>
                <button type="submit" class="btn btn-danger btn-block">Submit</button>
            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('form').form({
            on     : 'change',
            inline : true,
            fields: {
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                        type: 'empty'
                        }, {
                            type   : 'email'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type   : 'empty'
                        }, {
                            type   : 'minLength[6]'
                        }
                    ]
                }
            }
        });
    </script>
@stop
