@extends('app')
@section('content')
    <div class="ui container">
        <div class="ui piled segment">
            <br>
            <h1>BOOKING</h1>
            <br>
            <form class="ui form" method="GET" action="{{route('passengers.book.appointment',$appointment->id)}}">
                {{csrf_field()}}
                <div class="two fields">
                    <div class="field">
                        <label>Number Of Passengers</label>
                        <input type="number" name="number_of_passengers"value="{{Request::old('number_of_passengers')}}"placeholder="Number Of Passengers">
                    </div>
                    <div class="field">
                        <label>Number Of Mail</label>
                        <input type="number" name="number_of_mail" value="{{Request::old('number_of_mail')}}"placeholder="Number Of Mail">
                    </div>
                </div>
                <br>
                <br>
                <div class="ui centered grid">
                    <div class="four wide column"><div class="ui cancel button fluid"id="cancel">Cancel</div></div>
                    <div class="four wide column"><button class="ui button green submit fluid">Join</button></div>
                </div>
            </form>
            <br>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('cancel').onclick = function () {
            history.back();
        };
        $('form').form({
            on: 'change',
            inline: true,
            fields: {
                number_of_passengers: {
                    identifier: 'number_of_passengers',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[2]'}]
                },
                number_of_mail: {
                    identifier: 'number_of_mail',
                    rules: [{type: 'empty'}, {type: 'number'}, {type: 'maxLength[2]'}]
                }
            }
        });
    </script>
@endsection