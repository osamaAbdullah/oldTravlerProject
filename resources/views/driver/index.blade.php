@extends('app')

@section('content')
<div class="ui container">
    <div class="ui grid centered">
        <div class="ten wide column">
            <div class="horizontal divider">ADMIN Dashboard</div>
            <div class="panel-body">
                @component('components.who')
                @endcomponent
            </div>
        </div>
    </div>
</div>
@endsection
