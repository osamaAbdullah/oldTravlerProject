<?php

namespace App\Http\Controllers\Passenger;

use App\Appointment;
use App\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PassengersController extends Controller
{
    public function showDashboard()
    {
        $passenger = Passenger::find(Auth::user()->id);
        return view('passenger.dashboard')->withPassenger($passenger->appointments);
    }
    public function showProfile(Passenger $passenger)
    {
        return view('passenger.profile',['passenger' => $passenger]);
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
            'travel_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'sometimes',
            'notes' => 'sometimes|max:255',
        ));
        $appointment = new Appointment ;
        $appointment->current_city = $request->current_city;
        $appointment->current_spot = $request->current_spot;
        $appointment->destination_city = $request->destination_city;
        $appointment->destination_spot = $request->destination_spot;
        $appointment->number_of_passengers = $request->number_of_passengers;
        $appointment->number_of_mail = $request->number_of_mail;
        $appointment->time_is_fixed = ($request->time_is_fixed == 'on') ? true : false;
        $appointment->travel_date = $request->travel_date;
        $appointment->start_time = $request->start_time;
        $appointment->end_time = ($request->time_is_fixed == 'on') ? null : $request->end_time;
        $appointment->price_per_passenger = $request->price_per_passenger;
        $appointment->price_per_mail = 0;
        $appointment->min_number_of_passenger = $request->min_number_of_passenger;
        $appointment->max_number_of_passenger = $request->max_number_of_passenger;
        $appointment->note = $request->note;
        $appointment->save();
        $appointment->passengers()->attach(Auth::user()->id);



        Session::flash('success', 'The appointment created successfully ');
        return redirect()->route('passengers.dashboard.show');
    }

    public function editAppointment (Appointment $appointment)
    {
        return view('passenger.edit_appointment',['appointment'=>$appointment]);
    }

    public function updateAppointment(Request $request,Appointment $appointment)
    {
        dd('maintenance');
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
            'notes' => 'sometimes|max:255',
        ));

        $appointment->current_city = $request->current_city;
        $appointment->current_spot = $request->current_spot;
        $appointment->destination_city = $request->destination_city;
        $appointment->destination_spot = $request->destination_spot;
        $appointment->number_of_passengers = $request->number_of_passengers;
        $appointment->number_of_mail = $request->number_of_mail;
        $appointment->time_is_fixed = ($request->time_is_fixed == 'on') ? true : false;
        $appointment->start_time = $request->start_time;
        $appointment->end_time = ($request->time_is_fixed == 'on') ? null : $request->end_time;
        $appointment->price_per_passenger = $request->price_per_passenger;
        $appointment->price_per_mail = 0;
        $appointment->min_number_of_passenger = $request->min_number_of_passenger;
        $appointment->max_number_of_passenger = $request->max_number_of_passenger;
        $appointment->note = $request->note;
        $appointment->save();
        $appointment->passengers()->attach(Auth::user()->id);


        Session::flash('success', 'Your Email was Sent!');
        return redirect()->route('passengers.dashboard.show');
    }
    public function cancelAppointment (Appointment $appointment)
    {

        $appointment->passengers()->detach(Auth::user()->id);
//        $appointment->number_of_passengers += $request->number_of_passengers ;
//        $appointment->number_of_mail += $request->number_of_mail ;
        if(sizeof($appointment->passengers)==0)
            $appointment->delete();
        Session::flash('success', 'You canceled the appointment');
        return redirect()->route('passengers.dashboard.show');
    }

    public function searchAppointment(Request $request)
    {
        $appointments = Appointment::where('destination_city','LIKE','%'.$request->term.'%')->get();
        $results = [];
        foreach ($appointments as $appointment){
            $results [] = [ 'title' => $appointment->destination_city.' / '.$appointment->destination_spot , 'description' => $appointment->start_time  ."<br>". $appointment->travel_date, 'url' => route('passenger.view.appointment',$appointment->id) ];
        }
        return response($results);
    }

    public function viewAppointment (Appointment $appointment)
    {
        return view('passenger.view_appointment',['appointment' => $appointment]);
    }
    public function bookingAppointmentForm (Appointment $appointment)
    {
        return view('passenger.booking_appointment_form',['appointment' => $appointment]);
    }
    public function bookAppointment(Request $request,Appointment $appointment)
    {
        $this->validate($request, array(
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
        ));
        if ($request->number_of_passengers + $appointment->number_of_passengers > $appointment->max_number_of_passenger)
            throw ValidationException::withMessages(['Number of passenger will be more than maximum']);
        $appointment->number_of_passengers += $request->number_of_passengers ;
        $appointment->number_of_mail += $request->number_of_mail ;
        $appointment->update();
        $appointment->passengers()->attach(Auth::user()->id);

        Session::flash('success', 'You successfully booked your seat');
        return redirect()->route('passengers.dashboard.show');
    }
}