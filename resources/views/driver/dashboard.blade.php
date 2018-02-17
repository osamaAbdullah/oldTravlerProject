@extends('app')
@section('content')
    <br>
    <br>
    <div class="ui container">
        <div class="ui raised segment">
            <h1>Driver DashBoard</h1>
        </div>
        <a class="ui button transparent" href="{{route('driver.create.appointment')}}">Start new Journey</a>
        @if(count($driver)>=1)
            <table class="ui table">
                <thead>
                <tr>
                    <th>Destination City</th><th>Destination Spot</th><th>Number Of Passenger</th><th></th><th></th><th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($driver as $appointment)
                    <tr>
                        <td>{{$appointment->destination_city}}</td>
                        <td>{{$appointment->destination_spot}}</td>
                        <td>{{$appointment->number_of_passengers}}</td>
                        <td><a href="{{route('driver.edit.appointment',$appointment->id)}}">Edit</a></td>
                        <td>
                            <div id="cancel"class="ui button transparent cancel">Delete</div>
                            <div class="ui basic modal">
                                <div class="ui icon header">
                                    <i class="trash icon"></i>
                                    Cancel the appointment
                                </div>
                                <div class="content"style="text-align:center">
                                    <p><strong>Are you sure you want to cancel this appointment?</strong></p>
                                    <form id="{{$appointment->id}}"method="post"action="{{route('driver.cancel.appointment',$appointment->id)}}">
                                        {{csrf_field()}}
                                        <div class="actions">
                                            <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                            <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td><a href="{{route('driver.view.appointment',$appointment->id)}}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <form>
            {{csrf_field()}}
            <div class="ui search">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Search...">
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </form>
    </div>
    <br>
    <br>
@endsection
@section('scripts')
    <script>
        $('.cancel').click(function () {
            $('.ui.basic.modal').modal('show');
        });
        $('.ui.search').keyup(function () {
            $.ajax({
                method: 'GET',
                url: '{{route('driver.search.appointment')}}',
                data: {term: $('.prompt').val() , _token : $('input[name=_token]').val() }
            }).done(function (results) {
                console.log(results);
                $('.ui.search').search({source: results});
            });
        });
    </script>
@endsection