<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PassengerRequestResponse extends Notification
{
    use Queueable;

    private $driver_id;
    private $response;

    public function __construct($driver_id,$response)
    {
        $this->driver_id = $driver_id ;
        $this->response = $response ;

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'driver_id' => $this->driver_id ,
            'response' =>  $this->response
        ];
    }
}
