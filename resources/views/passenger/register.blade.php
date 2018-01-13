@extends('app')

@section('content')
    <div class="ui container">
        <form class="ui form piled segment"method="POST">
            {{ csrf_field() }}
            <h4 class="ui horizontal divider header">
                <i class="signup icon"></i>
               Passenger Registration
            </h4>
            <br>
            <div class="three fields">
                <div class="field">
                    <label>First Name</label>
                    <input placeholder="First Name" name="first_name" type="text">
                </div>
                <div class="field">
                    <label>Middle Name</label>
                    <input placeholder="Middle Name" name="middle_name" type="text">
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input placeholder="Last Name" name="last_name" type="text">
                </div>
            </div>

            <div class="three fields">
                <div class="field">
                    <label>Email</label>
                    <input placeholder="Email"name="email" type="text">
                </div>
                <div class="field">
                    <label>Phone Number</label>
                    <input placeholder="0000 000 0000"name="phone_number" type="text">
                </div>
                <div class="field">
                    <label>Address</label>
                    <input placeholder="Address"name="address" type="text">
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
                    <label>Birthday</label>
                    <input name="birthday"type="text"placeholder="Birthday">
                </div>
            </div>
            <div class="field">
                <label>Bio</label>
                <input name="bio"type="text"placeholder="Bio">
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Password</label>
                    <input name="password"type="password">
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
    <script>
        $('.ui.dropdown').dropdown();
        $('.ui.form').form({
            on     : 'change',
            inline : true,
           /* fields: {
                first_name: {
                    identifier: 'first_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[191]'
                        }
                    ]
                },
                middle_name: {
                    identifier: 'middle_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[191]'
                        }
                    ]
                },
                last_name: {
                    identifier: 'last_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[191]'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[25]'
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
                        },

                        {
                            type   : 'minLength[6]'
                        }
                    ]
                },
                email: {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'email',
                            prompt : 'Please enter a valid Email'
                        }
                    ]
                },
                phone_number: {
                    identifier  : 'phone_number',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[35]'
                        },{
                            type   : 'minLength[11]'
                        },{
                            type   : 'number'
                        }
                    ]
                },
                age: {
                    identifier  : 'age',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[35]'
                        },{
                            type   : 'minLength[2]'
                        },{
                            type   : 'integer'
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
                user_name: {
                    identifier  : 'user_name',
                    rules: [
                        {
                            type   : 'empty'
                        },{
                            type   : 'maxLength[191]'
                        }
                    ]
                }
            }*/
        });
    </script>
@stop