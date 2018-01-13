@extends('app')

@section('content')
    <div class="ui container">
        <form class="ui form segment"method="POST"action="{{ route('drivers.password.email') }}">
            {{ csrf_field() }}
            @if (session('status'))
                <div class="ui green message">
                    {{ session('status') }}
                </div>
            @endif
            <div class="field">
                <label>Email</label>
                <input placeholder="Email"name="email" type="text">
            </div>
            <div class="ui primary button submit">Send Password Reset Link</div>
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
                            type   : 'email'
                        },{
                            type   : 'empty'
                        }
                    ]
                }
            }
        });
    </script>
@stop
