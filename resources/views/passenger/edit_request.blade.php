@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui piled segment">
            <br>
            <h1>Update Your Request</h1>
            <br>
            <form method="POST" action="{{route('passengers.update.request',$passengerRequest->id)}}"class="ui form">
                <input name="_method" type="hidden" value="PUT">
                {{csrf_field()}}
                <div class="two fields">
                    <div class="field">
                        <label>Current City</label>
                        <select class="ui search dropdown"name="current_city">
                            <?php
                            foreach ($cities as $city)
                            {
                                ($passengerRequest->current_city == $city->name)? $is_selected="selected":$is_selected="";
                                echo '<option value="'.$city->name.'" '.$is_selected. '>'.$city->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <label>Destination City</label>
                        <select class="ui search dropdown"name="destination_city">
                            <?php
                            foreach ($cities as $city)
                            {
                                ($passengerRequest->destination_city == $city->name)? $is_selected="selected":$is_selected="";
                                echo '<option value="'.$city->name.'" '.$is_selected. '>'.$city->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Current Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="current_spot" value="{{$passengerRequest->current_spot}}"
                               placeholder="Current Spot">
                    </div>
                    <div class="field">
                        <label>Destination Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="destination_spot" value="{{$passengerRequest->destination_spot}}"
                               placeholder="Destination Spot">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Number Of Passengers</label>
                        <input type="number" name="number_of_passengers"
                               value="{{$passengerRequest->number_of_passengers}}" placeholder="Number Of Passengers">
                    </div>
                    <div class="field">
                        <label>Number Of Mail</label>
                        <input type="number" name="number_of_mail" value="{{$passengerRequest->number_of_mail}}"
                               placeholder="Number Of Mail">
                    </div>
                </div>




                <div class="two fields">
                    <div class="field">
                        <label>Date</label>
                        <div class="ui calendar">
                            <div class="ui input fluid left icon">
                                <i class="calendar icon"></i>
                                <input autocomplete="off"name="travel_date"placeholder="0000-00-00"value="{{$passengerRequest->travel_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Note<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="note" value="{{$passengerRequest->note}}" placeholder="Note">
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
    <script src="{{asset('js/calendar.js')}}"></script>
    <script>
        $('.ui.calendar').calendar({
            type: 'date',
            formatter: {
                date:function(date,settings) {
                    if (!date) return '';
                    var day = date.getDate() + '';
                    if (day.length < 2) {
                        day = '0' + day;
                    }
                    var month = (date.getMonth() + 1) + '';
                    if (month.length < 2) {
                        month = '0' + month;
                    }
                    var year = date.getFullYear();
                    return year + '-' + month + '-' + day;
                }
            }
        });
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
                travel_date: {
                    identifier: 'travel_date',
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