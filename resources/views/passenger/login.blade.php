@extends('app')

@section('content')

    <div class="ui container">
        <form class="ui form segment"method="POST"action="{{ route('passengers.login') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Email</label>
                <input placeholder="Email"name="email" type="text">
            </div>
            <div class="field">
                <label>Password</label>
                <input name="password"placeholder="Password"type="password">
            </div>

            <div class="required inline field">
                <div class="ui checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label>Remember Me</label>
                </div>
            </div>
            <br>
            <div class="two fields">

                <div class="field">
                    <div class="ui green submit button fluid">Sign In</div>
                </div>
                <div class="field">
                    <a class="ui primary button fluid"href="{{route('passengers.register')}}">Sign Up</a>
                </div>
            </div>

            <div class="ui right aligned grid">
                <div class="left floated right aligned sixteen wide column">
                    <a href="{{route('passengers.password.request')}}">Forgot Your Password?</a>
                </div>
            </div>
        </form>
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
                            type   : 'email',
                            prompt : 'Please enter a valid Email'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'Please enter a password'
                        },

                        {
                            type   : 'minLength[6]',
                            prompt : 'Your password must be at least {ruleValue} characters'
                        }
                    ]
                }
            }
        });
    </script>
@stop
