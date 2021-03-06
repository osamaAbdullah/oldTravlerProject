@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui piled segment">
            <br>
            <h1>START NEW JOURNEY WITH US</h1>
            <br>
            <form class="ui form" method="POST" action="{{route('drivers.save.appointment')}}">
                {{csrf_field()}}
                <div class="two fields">
                    <div class="field">
                        <label>Current City</label>
                        <select class="ui search dropdown"name="current_city">
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
                        <select class="ui search dropdown"name="destination_city">
                            <option value="">To:</option>
                            <?php
                            foreach ($cities as $city)
                            {
                                echo '<option value="'.$city->name.'">'.$city->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Current Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="current_spot" value="{{Request::old('current_spot')}}"
                               placeholder="Current Spot">
                    </div>
                    <div class="field">
                        <label>Destination Spot<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="destination_spot" value="{{Request::old('destination_spot')}}"
                               placeholder="Destination Spot">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Number Of Passengers</label>
                        <input type="number" name="number_of_passengers"
                               value="{{Request::old('number_of_passengers')}}" placeholder="Number Of Passengers">
                    </div>
                    <div class="field">
                        <label>Number Of Mail</label>
                        <input type="number" name="number_of_mail" value="{{Request::old('number_of_mail')}}"
                               placeholder="Number Of Mail">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Minimum Number Of Passenger</label>
                        <input type="number" name="min_number_of_passenger"
                               value="{{Request::old('min_number_of_passenger')}}"
                               placeholder="Minimum Number Of Passenger">
                    </div>
                    <div class="field">
                        <label>Maximum Number Of Passenger</label>
                        <input type="number"name="max_number_of_passenger"value="{{Auth::user()->max_pass}}"placeholder="Maximum Number Of Passenger">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Price Per Passenger</label>
                        <input type="number" name="price_per_passenger" value="{{Request::old('price_per_passenger')}}"
                               placeholder="Price Per Passenger">
                    </div>
                    <div class="field">
                        <label>Price Per Mail</label>
                        <input type="number" name="price_per_mail" value="{{Request::old('price_per_mail')}}"
                               placeholder="Price Per Mail">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Date</label>
                        <div class="ui calendar">
                            <div class="ui input fluid left icon">
                                <i class="calendar icon"></i>
                                <input autocomplete="off"name="travel_date"placeholder="0000-00-00"value="{{Request::old('travel_date')}}">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Note<span style="color:#e57373;margin-left:10px">(optional)</span></label>
                        <input type="text" name="note" value="{{Request::old('note')}}" placeholder="Note">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Start Time</label>
                        <input type="time" placeholder="Start Time" name="start_time"
                               value="{{Request::old('start_time')}}">
                    </div>
                    <div class="field" id="end_time">
                        <label>End Time</label>
                        <input type="time" name="end_time" value="{{Request::old('end_time')}}" placeholder="End Time">
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
                min_number_of_passenger: {
                    identifier: 'min_number_of_passenger',
                    rules: [{type: 'empty'},{type: 'number'}, {type: 'maxLength[2]'}]
                },
                max_number_of_passenger: {
                    identifier: 'max_number_of_passenger',
                    rules: [{type: 'empty'},{type: 'number'}, {type: 'maxLength[2]'}]
                },
                price_per_mail: {
                    identifier: 'price_per_mail',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[6]'}]
                },
                price_per_passenger: {
                    identifier: 'price_per_passenger',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[6]'}]
                },
                travel_date: {
                    identifier: 'travel_date',
                    rules: [{type: 'empty'}]
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