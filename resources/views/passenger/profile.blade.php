@extends('app')
@section('content')
    <div class="ui grid centered">
        <div class="row">
            <div class="four wide column"style="text-align: center">
                <img class="ui large circular image" src="{{asset('images/user.jpg')}}">
            </div>
        </div>
        <div class="row">
            <div class="six wide column">
                <table class="ui table" style="text-align:center;font-size: 20px">
                    <tbody>
                    <tr>
                        <td>Full Name :</td>
                        <td>{{$passenger->first_name .' '. $passenger->middle_name .' '. $passenger->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td>{{$passenger->phone_number}}</td>
                    </tr>
                    <tr>
                        <td>Emergency Phone Number :</td>
                        <td>{{$passenger->emergency_phone_number}}</td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>{{$passenger->email}}</td>
                    </tr>
                    <tr>
                        <td>Emergency Email :</td>
                        <td>{{$passenger->emergency_email}}</td>
                    </tr>
                    <tr>
                        <td>Birthday :</td>
                        <td>{{ date('M j, Y ', strtotime($passenger->birthday)) }}</td>
                    </tr>
                    <tr>
                        <td>gender :</td>
                        <td>{{($passenger->gender==1)?'Male':'Female'}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="ui button fluid red">Delete</div>
            </div>
            <div class="six wide column">
                <table class="ui table" style="text-align:center;font-size: 20px">
                    <tbody>
                    <tr>
                        <td>Weight :</td>
                        <td>{{$passenger->weight}}</td>
                    </tr>
                    <tr>
                        <td>Height :</td>
                        <td>{{$passenger->height}}</td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td>{{$passenger->address}}</td>
                    </tr>
                    <tr>
                        <td>Bio :</td>
                        <td>{{$passenger->bio}}</td>
                    </tr>
                    <tr>
                        <td>Joined At  :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passenger->created_at))}}</td>
                    </tr>
                    <tr>
                        <td>Updated At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($passenger->updated_at))}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="ui button fluid primary">Edit</div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection