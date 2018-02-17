@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui grid centered">
            <div class="sixteen wide column"style="margin-top:50px">
                <h1 style="text-align:center">Voyage To {{$appointment->destination_city}}</h1>
                <table class="ui table" style="text-align:center">
                    <tbody>
                    <tr>
                        <td>From:</td>
                        <td>{{$appointment->current_city.' / '.$appointment->current_spot}}</td>
                        <td>To:</td>
                        <td>{{$appointment->destination_city.' / '.$appointment->destination_spot}}</td>
                    </tr>
                    <tr>
                        <td>Number Of Passengers :</td>
                        <td>{{$appointment->number_of_passengers}}</td>
                        <td>Number Of Mail :</td>
                        <td>{{$appointment->number_of_mail}}</td>
                    </tr>
                    <tr>
                        <td>Travel Date :</td>
                        <td>{{ date('M j, Y ', strtotime($appointment->travel_date)) }}</td>
                        <td>Is Time Fixed :</td>
                        <td>{{($appointment->time_is_fixed==1)?'YES':'NO'}}</td>
                    </tr>
                    <tr>
                        <td>Specified Driver :</td>
                        <td><?php if($appointment->driver_id==null) echo"None"; else echo"<a href=".route('drivers.profile.show',$appointment->driver_id).">".$appointment->driver->first_name."</a>"; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Start Time :</td>
                        <td>{{date('h:ia', strtotime($appointment->start_time))}}</td>
                        @if($appointment->time_is_fixed==0)
                            <td>End Time :</td>
                            <td>{{date('h:ia', strtotime($appointment->end_time))}}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Price Per Passenger :</td>
                        <td>{{$appointment->price_per_passenger}}</td>
                        <td>Price Per Mail :</td>
                        <td>{{$appointment->price_per_mail}}</td>
                    </tr>
                    <tr>
                        <td>Max Number Of Passenger :</td>
                        <td>{{$appointment->max_number_of_passenger}}</td>
                        <td>Minimum Number Of Passenger :</td>
                        <td>{{$appointment->min_number_of_passenger}}</td>
                    </tr>
                    <tr>
                        <td>Created At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($appointment->created_at))}}</td>
                        <td>Updated At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($appointment->created_at))}}</td>
                    </tr>
                    <tr>
                        <td>Note :</td>
                        <td>{{$appointment->note}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="four wide column">
                    <div id="cancel"class="ui button fluid">Cancel</div>
                </div>
                @if($appointment->driver_id)
                    <div class="four wide column">
                        <div id="leave"class="ui button red fluid">Leave</div>
                    </div>
                    <div class="ui basic modal">
                        <div class="ui icon header">
                            <i class="trash icon"></i>
                            Cancel the appointment
                        </div>
                        <div class="content"style="text-align:center">
                            <p><strong>Are you sure you want to leave this appointment?</strong></p>
                            <form id="{{$appointment->id}}"method="post"action="{{route('passengers.cancel.appointment',$appointment->id)}}">
                                {{csrf_field()}}
                                <div class="actions">
                                    <div class="ui green ok inverted button"><i class="remove icon"></i>No</div>
                                    <button class="ui red basic cancel inverted button"><i class="checkmark icon"></i>Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="four wide column">
                        <a id="book"class="ui button green fluid"href="{{route('driver.booking.appointment.form',$appointment->id)}}">Join</a>
                    </div>
                @endif
                <div class="four wide column">
                    <div class="ui button primary fluid">Edit</div>
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