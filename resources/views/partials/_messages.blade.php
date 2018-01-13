<div class="ui container">
    @if(Session::has('success'))
        <div class="ui green message">
            <strong>Success:</strong>{{Session::get('success')}}
        </div>
        <br>
    @endif

    @if(count($errors)>0)
        <div class="ui red message">
            <strong>Errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif
</div>
