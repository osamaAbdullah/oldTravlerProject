@extends('app')

@section('content')
    <div class="ui middle aligned center aligned grid">
        <div class="four wide column">
            <h2 class="ui teal image header">
                <i class="male icon"></i>
                <div class="content">
                    Log-in as passenger
                </div>
            </h2>
            <form class="ui large form"method="POST"action="{{ route('passengers.login') }}">
                {{ csrf_field() }}
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i><input name="email" placeholder="E-mail address" type="text" value="{{Request::old('email')}}"/>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i><input name="password" placeholder="Password" type="password" />
                        </div>
                    </div>
                    <div class="ui fluid large teal submit button">
                        Login
                    </div>
                    <br>
                    <div class="two fields">
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label>Remember Me</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="left floated right aligned sixteen wide column">
                                <a href="{{route('passengers.password.request')}}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="ui message">
                New to us? <a href="{{route('passengers.register')}}"> Sign Up</a>
            </div>
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
