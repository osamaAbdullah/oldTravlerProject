@extends('app')
@section('content')
    <br>
    <br>
    <div class="ui container">
        <div class="ui raised segment">
            <h1>Passenger DashBoard</h1>
        </div>
        <a class="ui button transparent" href="{{route('passengers.create.appointment')}}">Start new Journey</a>


    </div>
    <br>
    <br>
@endsection
@section('scripts')
    <script>

    </script>
@endsection