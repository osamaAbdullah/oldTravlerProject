<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PassengerRequest extends Notification
{
    use Queueable;

    private $passenger_id;
    private $number_of_passengers;
    private $number_of_mail;
    private $appointment_id;

    public function __construct($passenger_id,$number_of_passengers,$number_of_mail,$appointment_id)
    {
        $this->passenger_id = $passenger_id ;
        $this->number_of_passengers = $number_of_passengers;
        $this->number_of_mail = $number_of_mail;
        $this->appointment_id = $appointment_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'passenger_id' => $this->passenger_id ,
            'number_of_passengers' => $this->number_of_passengers ,
            'number_of_mail' => $this->number_of_mail,
            'appointment_id' => $this->appointment_id
        ];
    }
}
