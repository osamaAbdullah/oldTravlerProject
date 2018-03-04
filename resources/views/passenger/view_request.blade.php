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
                        <td>note :</td>
                        <td>{{$passengerRequest->note}}</td>
                    </tr>
                    <tr>
                        <td>Created At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passengerRequest->created_at))}}</td>
                        <td>Updated At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passengerRequest->created_at))}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="four wide column">
                    <div id="cancel"class="ui button fluid">Back</div>
                </div>
                <div class="ui basic modal">
                    <div class="ui icon header">
                        <i class="trash icon"></i>
                        Cancel the appointment
                    </div>
                    <div class="content"style="text-align:center">
                        <p><strong>Are you sure you want to leave this appointment?</strong></p>
                        <form method="post"action="{{route('passengers.cancel.request',$passengerRequest->id)}}">
                            {{csrf_field()}}
                            <div class="actions">
                                <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="four wide column">
                    <div class="ui button primary fluid"id="cancelRequest">Cancel</div>
                </div>
                <div class="four wide column">
                    <a class="ui button primary fluid"href="{{route('passengers.edit.request',$passengerRequest->id)}}">Edit</a>
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
        document.getElementById('leave').onclick = function () {
            $('.ui.basic.modal').modal('show');
        };
    </script>
@endsection