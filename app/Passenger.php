<?php

namespace App;

use App\Notifications\PassengerResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Passenger extends Authenticatable
{
    use Notifiable;

    protected $guarded='web';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name' ,
        'phone_number',
        'emergency_phone_number',
        'email',
        'emergency_email',
        'birthday',
        'gender',
        'weight',
        'height',
        'bio',
        'address',
        'profile_picture',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PassengerResetPasswordNotification($token));
    }
    public function appointments ()
    {
        return $this->belongsToMany('App\Appointment')->withTimestamps()->withPivot('number_of_passengers', 'number_of_mail','verification');
    }
    public function passenger_requests()
    {
        return $this->hasMany('App\PassengerRequest');
    }
}
