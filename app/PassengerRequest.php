<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengerRequest extends Model
{
    public function driver ()
    {
        return $this->belongsTo('App\Driver');
    }
    public function passenger ()
    {
        return $this->belongsTo('App\Passenger');
    }
}
