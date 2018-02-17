@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui piled segment">
            <br>
            <h1>Update</h1>
            <br>
            <form class="ui form"method="POST"action="{{route('passengers.update.appointment',$appointment->id)}}">
                {{csrf_field()}}
                <div class="two fields">
                    <div class="field">
                        <label>Current City</label>
                        <input type="text" name="current_city" value="{{$appointment->current_city}}"
                               placeholder="Current City">
                    </div>
                    <div class="field">
                        <label>Destination City</label>
                        <input type="text" name="destination_city" value="{{$appointment->destination_city}}"
                               placeholder="Destination City">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Current Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="current_spot" value="{{$appointment->current_spot}}"
                               placeholder="Current Spot">
                    </div>
                    <div class="field">
                        <label>Destination Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="destination_spot" value="{{$appointment->destination_spot}}"
                               placeholder="Destination Spot">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Number Of Passengers</label>
                        <input type="number" name="number_of_passengers"
                               value="{{$appointment->number_of_passengers}}" placeholder="Number Of Passengers">
                    </div>
                    <div class="field">
                        <label>Number Of Mail</label>
                        <input type="number" name="number_of_mail" value="{{$appointment->number_of_mail}}"
                               placeholder="Number Of Mail">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Minimum Number Of Passenger<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="number" name="min_number_of_passenger"
                               value="{{$appointment->min_number_of_passenger}}"
                               placeholder="Minimum Number Of Passenger">
                    </div>
                    <div class="field">
                        <label>Maximum Number Of Passenger<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="number" name="max_number_of_passenger"
                               value="{{$appointment->max_number_of_passenger}}"
                               placeholder="Maximum Number Of Passenger">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Price Per Passenger</label>
                        <input type="number" name="price_per_passenger" value="{{$appointment->price_per_passenger}}"
                               placeholder="Price Per Passenger">
                    </div>
                    <div class="field">
                        <label>Note<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="note" value="{{$appointment->note}}" placeholder="Note">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Start Time</label>
                        <input type="time" placeholder="Start Time" name="start_time"
                               value="{{$appointment->start_time}}">
                    </div>
                    <div class="field" id="end_time">
                        <label>End Time</label>
                        <input type="time" name="end_time" value="{{$appointment->end_time}}" placeholder="End Time">
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox" style="margin-top: 20px; margin-left:10px; ">
                        <input type="checkbox" name="time_is_fixed">
                        <label>time is fixed</label>
                    </div>
                </div>
                <button class="ui button primary submit">Save Changes</button>
                <div class="ui cancel button" id="cancel">Cancel</div>
            </form>
            <br>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('input[name=time_is_fixed]').change(function () {
            if (this.checked) {
                $('#end_time').fadeOut(100);
                $('.ui.form').form('remove field','end_time');
            }
            else {
                $('#end_time').fadeIn(100);
                $('.ui.form').form('add rule','end_time',[{type:'empty',prompt : 'specify end time'}]);
            }
        });
        document.getElementById('cancel').onclick = function () {
            history.back();
        };
        $('form').form({
            on: 'change',
            inline: true,
            fields: {
                current_city: {
                    identifier: 'current_city',
                    rules: [{type: 'empty'}, {type: 'maxLength[50]'}]
                },
                destination_city: {
                    identifier: 'destination_city',
                    rules: [{type: 'empty'}, {type: 'maxLength[50]'}]
                },
                current_spot: {
                    identifier: 'current_spot',
                    rules: [{type: 'maxLength[50]'}]
                },
                destination_spot: {
                    identifier: 'destination_spot',
                    rules: [{type: 'maxLength[50]'}]
                },
                number_of_passengers: {
                    identifier: 'number_of_passengers',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[2]'}]
                },
                number_of_mail: {
                    identifier: 'number_of_mail',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[2]'}]
                },
                min_number_of_passenger: {
                    identifier: 'min_number_of_passenger',
                    rules: [{type: 'number'}, {type: 'maxLength[2]'}]
                },
                max_number_of_passenger: {
                    identifier: 'max_number_of_passenger',
                    rules: [{type: 'number'}, {type: 'maxLength[2]'}]
                },
                price_per_passenger: {
                    identifier: 'price_per_passenger',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[6]'}]
                },
                start_time: {
                    identifier: 'start_time',
                    rules: [{type: 'empty'}]
                },
                end_time: {
                    identifier: 'end_time',
                    rules: [{type: 'empty'}]
                },
                note: {
                    identifier: 'note',
                    rules: [
                        {
                            type: 'maxLength[255]'
                        }
                    ]
                }
            }
        });
    </script>
@endsection