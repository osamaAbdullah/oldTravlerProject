@extends('app')
@section('content')
    <br>
    <br>
    <div class="ui container">
        <div class="ui raised segment">
            <h1>Driver DashBoard</h1>
        </div>
        <a class="ui button transparent" href="{{route('drivers.create.appointment')}}">Start new Journey</a>
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
                        <td><a href="{{route('drivers.edit.appointment',$appointment->id)}}">Edit</a></td>
                        <td>
                            <div id="cancel"class="ui button transparent cancel">Delete</div>
                            <div class="ui basic modal">
                                <div class="ui icon header">
                                    <i class="trash icon"></i>
                                    Cancel the appointment
                                </div>
                                <div class="content"style="text-align:center">
                                    <p><strong>Are you sure you want to cancel this appointment?</strong></p>
                                    <form id="{{$appointment->id}}"method="post"action="{{route('drivers.cancel.appointment',$appointment->id)}}">
                                        {{csrf_field()}}
                                        <div class="actions">
                                            <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                            <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td><a href="{{route('drivers.view.appointment',$appointment->id)}}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="ui segment">
            <form class="ui form">
                <h1>Search for Passengers Requests</h1>
                {{csrf_field()}}
                <div class="three fields">
                    <div class="field">
                        <label>Current City</label>
                        <select class="ui search dropdown"id="source">
                            <option value="">From:</option>
                            <?php
                            foreach ($cities as $city)
                            {
                                echo '<option value="'.$city->name.'">'.$city->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Destination City</label>
                        <select class="ui search dropdown"id="destination">
                            <option value="">To:</option>
                            <?php
                            foreach ($cities as $city)
                            {
                                echo '<option value="'.$city->name.'">'.$city->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <div class="ui button primary fluid"id="search"style="margin-top:25px">Search</div>
                    </div>
                </div>
            </form>
            <table class="ui table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>n.Passenger</th>
                    <th>n.Mail</th>
                    <th>Note</th>
                    <th>Updated At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="body">
                </tbody>
            </table>
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
        $('#search').click(function () {
            $.ajax({
                method: 'GET',
                url: '{{route('drivers.search.appointment')}}',
                data: {source: $('#source').val() ,destination: $('#destination').val() , _token : $('input[name=_token]').val() }
            }).done(function (results) {
                console.log(results);
                $('#body').html('');
                for (var i in results)
                {
                    var row ='<tr><td>1</td><td>'+results[i]['from']+'</td><td>'+results[i]['to']+'</td><td>'+results[i]['date']+'</td><td>'+results[i]['number_of_passengers']+'</td><td>'+results[i]['number_of_mail']+'</td><td>'+results[i]['note']+'</td><td>'+results[i]['updated_at']+'</td><td><a href="'+results[i]['url']+'">View</a></td></tr>';
                    $("#body").append(row);
                }
            });
        });
    </script>
@endsection