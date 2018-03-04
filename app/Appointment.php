<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function passengers ()
    {
        return $this->belongsToMany('App\Passenger')->withTimestamps()->withPivot('number_of_passengers', 'number_of_mail','verification');
    }
    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
}