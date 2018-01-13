@extends('app')

@section('content')
    <div class="ui container">
        <form class="ui form piled segment" method="POST" action="{{route('drivers.password.request')}}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="{{ $email or old('email') }}">
            </div>
            <div class="field">
                <label>Password</label>
                <input name="password" type="password">
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <div class="ui equal width center aligned padded grid">
                <div class="row">
                    <div class="column" style="padding-left:0">
                        <div class="ui green submit button fluid">Submit</div>
                    </div>
                    <div class="column" style="padding-right:0">
                        <div class="ui reset primary button fluid">Reset</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $('.ui.dropdown').dropdown();
        $('.ui.form').form({
            on: 'change',
            inline: true,
            fields: {
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'email'
                        }, {
                            type: 'empty'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type: 'empty'
                        }, {
                            type: 'maxLength[25]'
                        }, {
                            type: 'minLength[6]'
                        }
                    ]
                },
                password_confirmation: {
                    identifier: 'password_confirmation',
                    rules: [
                        {
                            type: 'match[password]',
                            prompt: 'Your password doesn\'t match'
                        }, {
                            type: 'empty'
                        }, {
                            type: 'minLength[6]'
                        }
                    ]
                }
            }
        });
    </script>
@stop
