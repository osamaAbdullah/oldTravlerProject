@extends('app')

@section('title','Register')
@section('content')
    <div class="ui container">
        <form class="ui form piled segment"method="POST">
            {{ csrf_field() }}
            <h4 class="ui horizontal divider header">
                <i class="signup icon"></i>
                Registration
            </h4>
            <br>
            <div class="three fields">
                <div class="field">
                    <label>First Name</label>
                    <input placeholder="First Name" name="first_name"value="{{Request::old('first_name')}}" type="text">
                </div>
                <div class="field">
                    <label>Middle Name</label>
                    <input placeholder="Middle Name" name="middle_name"value="{{Request::old('middle_name')}}" type="text">
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input placeholder="Last Name" name="last_name"value="{{Request::old('last_name')}}" type="text">
                </div>
            </div>

            <div class="three fields">
                <div class="field">
                    <label>Email</label>
                    <input placeholder="Email"name="email"value="{{Request::old('email')}}" type="text">
                </div>
                <div class="field">
                    <label>Phone Number</label>
                    <input placeholder="0000 000 0000"name="phone_number"value="{{Request::old('phone_number')}}" type="text">
                </div>
                <div class="field">
                    <label>Birthday</label>
                    <div class="ui calendar">
                        <div class="ui input fluid left icon">
                            <i class="calendar icon"></i>
                            <input type="text"autocomplete="off"name="birthday"value="{{Request::old('birthday')}}"placeholder="0000-00-00">
                        </div>
                    </div>
                </div>

            </div>
            <div class="ui divider" style="margin:30px 0 20px 0"></div>
            <div class="two fields">
                <div class="field">
                    <label>Gender</label>
                    <select class="ui dropdown"name="gender">
                        <option value="">Gender</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </div>
                <div class="field">
                    <label>Type of vehicle</label>
                    <select class="ui dropdown"name="type_of_vehicle">
                        <option value="">Type of vehicle</option>
                        <option value="0">Taxi</option>
                        <option value="1">Bus</option>
                        <option value="2">Mini-Bus</option>
                        <option value="2">Other</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <label>Bio</label>
                <input name="bio"value="{{Request::old('bio')}}"type="text"placeholder="Bio">
            </div>
            <div class="field">
                <label>Vehicle-Bio</label>
                <input name="vehicle_bio"value="{{Request::old('vehicle_bio')}}"type="text"placeholder="Bio">
            </div>

            <div class="two fields">
                <div class="field">
                    <label>Address</label>
                    <input name="address"value="{{Request::old('address')}}"type="text"placeholder="Address">
                </div>
                <div class="field">
                    <label>Max-Passenger</label>
                    <input name="max_pass"value="{{Request::old('max_pass')}}"type="number"placeholder="Max-Passenger">
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label>Password</label>
                    <input name="password" type="password">
                </div>
                <div class="field">
                    <label>Confirm Password</label>
                    <input type="password"name="password_confirmation">
                </div>
            </div>

            <div class="ui equal width center aligned padded grid">
                <div class="row">
                    <div class="column"style="padding-left:0">
                        <div class="ui green submit button fluid">Submit</div>
                    </div>
                    <div class="column"style="padding-right:0">
                        <div class="ui reset primary button fluid">Reset</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/calendar.js')}}"></script>
    <script>
        $('.ui.dropdown').dropdown();
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
        $('.ui.form').form({
            on     : 'change',
            inline : true,
            fields: {
                first_name: {
                    identifier: 'first_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[100]'
                        }
                    ]
                },
                middle_name: {
                    identifier: 'middle_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[100]'
                        }
                    ]
                },
                last_name: {
                    identifier: 'last_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[100]'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[68]'
                        },{
                            type   : 'minLength[6]'
                        }
                    ]
                },
                password_confirmation: {
                    identifier  : 'password_confirmation',
                    rules: [
                        {
                            type   : 'match[password]',
                            prompt : 'Your password doesn\'t match'
                        },
                        {
                            type   : 'empty'
                        }
                    ]
                },
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'empty'
                        }, {
                            type   : 'email'
                        },{
                            type   : 'maxLength[150]'
                        }
                    ]
                },
                phone_number: {
                    identifier  : 'phone_number',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[30]'
                        },{
                            type   : 'minLength[11]'
                        },{
                            type   : 'number'
                        }
                    ]
                },
                birthday: {
                    identifier  : 'birthday',
                    rules: [
                        {
                            type   : 'empty'
                        }
                    ]
                },
                gender: {
                    identifier  : 'gender',
                    rules: [
                        {
                            type   : 'empty'
                        }
                    ]
                },
                type_of_vehicle: {
                    identifier  : 'type_of_vehicle',
                    rules: [
                        {
                            type   : 'empty'
                        }
                    ]
                },
                address: {
                    identifier  : 'address',
                    rules: [
                        {
                            type   : 'empty'
                        }
                    ]
                },
                bio: {
                    identifier  : 'bio',
                    rules: [
                        {
                            type   : 'maxLength[255]'
                        }
                    ]
                },
                vehicle_bio: {
                    identifier  : 'vehicle_bio',
                    rules: [
                        {
                            type   : 'maxLength[255]'
                        }
                    ]
                },
                max_pass: {
                    identifier  : 'max_pass',
                    rules: [
                        {
                            type   : 'empty'
                        } ,{
                            type    : 'integer'
                        }
                    ]
                }
            }
        });
    </script>
@stop