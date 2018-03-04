<?php

namespace App;

use App\Notifications\DriverResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use Notifiable;

    protected $guarded='driver';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name' ,
        'phone_number',
        'email',
        'birthday',
        'gender',
        'bio',
        'vehicle_bio',
        'address',
        'type_of_vehicle',
        'max_pass',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DriverResetPasswordNotification($token));
    }
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }
    public function passenger_requests()
    {
        return $this->hasMany('App\PassengerRequest');
    }

}