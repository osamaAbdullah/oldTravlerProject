@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui grid centered">
            <div class="sixteen wide column"style="margin-top:50px">
                <h1 style="text-align:center">Request To {{$passengerRequest->destination_city}}</h1>
                <table class="ui table" style="text-align:center">
                    <tbody>
                    <tr>
                        <td>From:</td>
                        <td>{{$passengerRequest->current_city.' / '.$passengerRequest->current_spot}}</td>
                        <td>To:</td>
                        <td>{{$passengerRequest->destination_city.' / '.$passengerRequest->destination_spot}}</td>
                    </tr>
                    <tr>
                        <td>Number Of Passengers :</td>
                        <td>{{$passengerRequest->number_of_passengers}}</td>
                        <td>Number Of Mail :</td>
                        <td>{{$passengerRequest->number_of_mail}}</td>
                    </tr>
                    <tr>
                        <td>Travel Date :</td>
                        <td>{{ date('M j, Y ', strtotime($passengerRequest->travel_date)) }}</td>
                        <td>Passenger</td>
                        <td><a href="{{route('passengers.profile.show',$passengerRequest->passenger_id)}}">View</a></td>
                    </tr>
                    <tr>
                        <td>Created At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passengerRequest->created_at))}}</td>
                        <td>Updated At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passengerRequest->created_at))}}</td>
                    </tr>
                    <tr>
                        <td>note :</td>
                        <td>{{$passengerRequest->note}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="four wide column">
                    <div id="cancel"class="ui button fluid">Back</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('cancel').onclick = function () {
            history.back();
        };
    </script>
@endsection