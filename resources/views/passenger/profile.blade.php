@extends('app')
@section('content')

    <div class="container">
        <div class="text-center" style="margin-top: 5px">
           <img src="{{asset('images/user2.png')}}" class="img-circle" width="122" height="122">
         </div>
        <table class="table table-dark table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">E-mail</th>
                <th scope="col">Birthday</th>
                <th scope="col">gender</th>
                <th scope="col">Weight</th>
                <th scope="col">Height</th>
                <th scope="col">Joined At </th>
                <th scope="col">Updated At</th>

            </tr>
            </thead>
            <tbody>
            <tr>


                <td>{{$passenger->first_name .' '. $passenger->middle_name .' '. $passenger->last_name}}</td>
            </tr>
            <tr>


            </tr>
            <tr>

            </tr>
            </tbody>
        </table>





    </div>



    <!--
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
    -->
@endsection
@section('scripts')
    <script>

    </script>
@endsection