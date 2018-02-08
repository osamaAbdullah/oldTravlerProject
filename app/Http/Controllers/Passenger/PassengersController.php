<?php

namespace App\Http\Controllers\Passenger;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PassengersController extends Controller
{
    public function showDashboard()
    {

        return view('passenger.dashboard');
    }
    public function showProfile()
    {

        return view('');
    }
    public function createAppointment()
    {
        return view('passenger.create_appointment');
    }
    public function saveAppointment(Request $request)
    {
        $this->validate($request, array(
            'current_city' => 'required|max:50',
            'destination_city' => 'required|max:50',
            'current_spot' => 'sometimes|max:50',
            'destination_spot' => 'sometimes|max:50',
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
            'time_is_fixed' => 'sometimes',
            'start_time' => 'required',
            'end_time' => 'sometimes',
            'min_number_of_passenger' => 'sometimes|numeric',
            'max_number_of_passenger' => 'sometimes|numeric',
            'notes' => 'sometimes|max:255',
        ));

        $booking = new Booking;

        $booking->current_city = $request->current_city;
        $booking->current_spot = $request->current_spot;
        $booking->destination_city = $request->destination_city;
        $booking->destination_spot = $request->destination_spot;
        $booking->vehicle_is_spesified = false;
        $booking->number_of_passengers = $request->number_of_passengers;
        $booking->number_of_mail = $request->number_of_mail;
        $booking->time_is_fixed = ($request->time_is_fixed == 'on') ? true : false;
        $booking->start_time = $request->start_time;
        $booking->end_time = ($request->time_is_fixed == 'on') ? null : $request->end_time;
        $booking->price_per_passenger = $request->price_per_passenger;
        $booking->price_per_mail = 0;
        $booking->min_number_of_passenger = $request->min_number_of_passenger;
        $booking->max_number_of_passenger = $request->max_number_of_passenger;
        $booking->passenger_id = Auth::user()->id;
        $booking->note = $request->note;
        $booking->save();
    }
}
