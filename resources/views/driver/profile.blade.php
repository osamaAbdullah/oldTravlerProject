@extends('app')
@section('content')
    <div class="ui grid centered">
        <div class="row">
            <div class="five wide column">
                <img class="ui large circular image" src="{{asset('images/user.jpg')}}">
            </div>
            <div class="five wide column">
                <img class="ui large circular image" src="{{asset('images/user.jpg')}}">
            </div>
        </div>
        <div class="row">
            <div class="six wide column">
                <table class="ui table" style="text-align:center;font-size: 20px">
                    <tbody>
                    <tr>
                        <td>Full Name :</td>
                        <td>{{$driver->first_name .' '. $driver->middle_name .' '. $driver->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td>{{$driver->phone_number}}</td>
                    </tr>
                    <tr>
                        <td>Emergency Phone Number :</td>
                        <td>{{$driver->emergency_phone_number}}</td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td>{{$driver->email}}</td>
                    </tr>
                    <tr>
                        <td>Emergency Email :</td>
                        <td>{{$driver->emergency_email}}</td>
                    </tr>
                    <tr>
                        <td>Birthday :</td>
                        <td>{{ date('M j, Y ', strtotime($driver->birthday)) }}</td>
                    </tr>
                    <tr>
                        <td>gender :</td>
                        <td>{{($driver->gender==1)?'Male':'Female'}}</td>
                    </tr>
                    <tr>
                        <td>Updated At :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($driver->updated_at))}}</td>
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
                        <td>{{$driver->weight}}</td>
                    </tr>
                    <tr>
                        <td>Height :</td>
                        <td>{{$driver->height}}</td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td>{{$driver->address}}</td>
                    </tr>
                    <tr>
                        <td>Vehicle Type :</td>
                        <td>{{$driver->type_of_vehicle}}</td>
                    </tr>
                    <tr>
                        <td>Max Passengers :</td>
                        <td>{{$driver->max_pass}}</td>
                    </tr>
                    <tr>
                        <td>Bio :</td>
                        <td>{{$driver->bio}}</td>
                    </tr>
                    <tr>
                        <td>vehicle Bio :</td>
                        <td>{{$driver->vehicle_bio}}</td>
                    </tr>
                    <tr>
                        <td>Joined At  :</td>
                        <td>{{date('M j, Y  h:ia', strtotime($driver->created_at))}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="ui button fluid primary"id="edit">Edit</div>
            </div>
            <div class="ui fullscreen modal">
                <i class="close icon"></i>
                <div class="header">
                    Edit Profile
                </div>
                <form class="ui form">

                </form>
                <div class="actions">
                    <div class="ui black deny button">
                        Cancel
                    </div>
                    <div class="ui positive right labeled icon button">
                        Save Changes
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#edit').click(function () {
            $('.fullscreen.modal').modal('show');
        });
    </script>
@endsection