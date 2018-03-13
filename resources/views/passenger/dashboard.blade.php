@extends('app')
@section('content')
    <br>
    <br>
    <div class="ui container">
        <div class="ui raised segment">
            <h1>Passenger DashBoard</h1>
            <h1>Join Appointment or create new Request</h1>
        </div>
        <a class="ui button transparent" href="{{route('passengers.create.request')}}">Create a new request</a>
        @if(count($passenger) != 0)
                <table class="ui table">
                    <thead>
                    <tr>
                        <th>Destination City</th><th>Destination Spot</th><th>Number Of Passenger</th><th></th><th></th><th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($passenger as $appointment)
                        <tr>
                            <td>{{$appointment->destination_city}}</td>
                            <td>{{$appointment->destination_spot}}</td>
                            <td>{{$appointment->number_of_passengers}}</td>
                            <td><a href="#">Edit</a></td>
                            <td>
                                <div id="cancel"class="ui button transparent cancel">Delete</div>
                                <div class="ui basic modal">
                                    <div class="ui icon header">
                                        <i class="trash icon"></i>
                                        Cancel the appointment
                                    </div>
                                    <div class="content"style="text-align:center">
                                        <p><strong>Are you sure you want to cancel this appointment?</strong></p>
                                        <form id="{{$appointment->id}}"method="post"action="{{route('passengers.cancel.appointment',$appointment->id)}}">
                                            {{csrf_field()}}
                                            <div class="actions">
                                                <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                                <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td><a href="{{route('passenger.view.appointment',$appointment->id)}}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @endif


        @if(count($passenger_requests) != 0)
                <table class="ui table">
                    <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Date</th>
                        <th>Note</th>
                        <th>Updated At</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($passenger_requests as $request)
                        <tr>
                            <td>{{$request->current_city .' - '. $request->current_spot}}</td>
                            <td>{{$request->destination_city .' - '. $request->destination_spot}}</td>
                            <td>{{$request->travel_date}}</td>
                            <td>{{$request->note}}</td>
                            <td>{{$request->updated_at}}</td>
                            <td><a href="{{route('passengers.edit.request',$request)}}">Edit</a></td>
                            <td>
                                <div id="cancel"class="ui button transparent cancel">Delete</div>
                                <div class="ui basic modal">
                                    <div class="ui icon header">
                                        <i class="trash icon"></i>
                                        Cancel the appointment
                                    </div>
                                    <div class="content"style="text-align:center">
                                        <p><strong>Are you sure you want to cancel this appointment?</strong></p>
                                        <form method="post"action="{{route('passengers.cancel.request',$request->id)}}">
                                            {{csrf_field()}}
                                            <div class="actions">
                                                <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                                <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td><a href="{{route('passenger.view.request',$request->id)}}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @endif





        <form class="ui form">
            {{csrf_field()}}
            <input type="text"placeholder="Search..."id="term">
        </form>
        <table class="ui table results">
            <thead>
                <tr>
                    <th>#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Driver</th>
                    <th>Note</th>
                    <th>Updated At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="body">
            </tbody>
        </table>
        <br>
        <div class="ui floating labeled icon dropdown button fluid">
            <i class="bell outline icon"></i>
            <span class="text">Notifications {{count(Auth::guard('web')->user()->unreadNotifications)}}</span>
            <div class="menu">
                <div class="header">
                    unRead
                </div>
                <?php
                foreach (Auth::guard('web')->user()->unreadNotifications as $notification)
                {
                    $driver = \App\Driver::find($notification->data['driver_id']);
                    $response = ($notification->data['response'] == 1)?'Accepted your Request':'Rejected your request';
                    echo '<div class="item">'.
                        '<img class="ui avatar image" src="'.asset('images/user.jpg').'">'.
                        '<strong>'.$driver->first_name . ' ' .$driver->middle_name . ' ' .$driver->last_name.'</strong> <pre>     '.$response. '</pre>'.
                        '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
@section('scripts')
    <script>
        $('.cancel').click(function () {
            $('.ui.basic.modal').modal('show');
        });
        $('#term').keyup(function () {
            $.ajax({
                method: 'GET',
                url: '{{route('passenger.search.appointment')}}',
                data: {term: $('#term').val() , _token : $('input[name=_token]').val() }
            }).done(function (results) {
                $('#body').html('');
                for (var i in results)
                {
                    var row ='<tr><td>1</td><td>'+results[i]['from']+'</td><td>'+results[i]['to']+'</td><td>'+results[i]['date']+'</td><td>'+results[i]['time']+'</td><td>'+results[i]['driver']+'</td><td>'+results[i]['note']+'</td><td>'+results[i]['updated_at']+'</td><td><a href="'+results[i]['url']+'">View</a></td></tr>';
                    $("#body").append(row);
                }
            });
        });

    </script>
@endsection