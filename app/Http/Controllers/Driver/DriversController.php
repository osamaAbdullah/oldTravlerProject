<?php

namespace App\Http\Controllers\Driver;

use App\Appointment;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Notifications\PassengerRequestResponse;
use App\Passenger;
use App\PassengerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

//Driver
class DriversController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth:driver');
    }

    //show dashboard
    public function showDashboard()
    {
        $cities = DB::select('SELECT `name` FROM `cities`');
        $driver = Driver::find(Auth::guard('driver')->user()->id);
        return view('driver.dashboard',['driver' => $driver->appointments,'cities' => $cities]);
    }

    //show profile
    public function showProfile($id)
    {
        $driver = Driver::find($id);
        return view('driver.profile',['driver' => $driver]);
    }

    //create new appointment
    public function createAppointment()
    {
        $cities = DB::select('SELECT `name` FROM `cities`');
        return view('driver.create_appointment',['cities' => $cities]);
    }

    //save the new appointment
    public function saveAppointment(Request $request)
    {
        $this->validate($request, array(
            'current_city' => 'required|max:50',
            'destination_city' => 'required|max:50',
            'current_spot' => 'sometimes|max:50',
            'destination_spot' => 'sometimes|max:50',
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
            'min_number_of_passenger' => 'required|numeric',
            'max_number_of_passenger' => 'required|numeric',
            'price_per_passenger' => 'required|numeric',
            'price_per_mail' => 'required|numeric',
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
        $appointment->price_per_mail = $request->price_per_mail;
        $appointment->min_number_of_passenger = $request->min_number_of_passenger;
        $appointment->max_number_of_passenger = $request->max_number_of_passenger;
        $appointment->note = $request->note;
        $appointment->driver_id = Auth::guard('driver')->user()->id;
        $appointment->save();

        Session::flash('success', 'The appointment created successfully ');
        return redirect()->route('drivers.dashboard.show');
    }

    //edit the appointment
    public function editAppointment (Appointment $appointment)
    {
        if ($appointment->driver_id!=Auth::guard('driver')->user()->id)
            throw ValidationException::withMessages('Only the creator can edit the appointment');
        $cities = DB::select('SELECT `name` FROM `cities`');
        return view('driver.edit_appointment',['appointment'=>$appointment,'cities' => $cities]);
    }

    //update the appointment and save the changes
    public function updateAppointment(Request $request,Appointment $appointment)
    {
        $this->validate($request, array(
            'current_city' => 'required|max:50',
            'destination_city' => 'required|max:50',
            'current_spot' => 'sometimes|max:50',
            'destination_spot' => 'sometimes|max:50',
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
            'min_number_of_passenger' => 'required|numeric',
            'max_number_of_passenger' => 'required|numeric',
            'price_per_passenger' => 'required|numeric',
            'price_per_mail' => 'required|numeric',
            'time_is_fixed' => 'sometimes',
            'travel_date' => 'required|date',
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
        $appointment->travel_date = $request->travel_date;
        $appointment->start_time = $request->start_time;
        $appointment->end_time = ($request->time_is_fixed == 'on') ? null : $request->end_time;
        $appointment->price_per_passenger = $request->price_per_passenger;
        $appointment->price_per_mail = $request->price_per_mail;
        $appointment->min_number_of_passenger = $request->min_number_of_passenger;
        $appointment->max_number_of_passenger = $request->max_number_of_passenger;
        $appointment->note = $request->note;
        $appointment->driver_id = Auth::guard('driver')->user()->id;
        $appointment->update();

        Session::flash('success', 'You successfully updated your appointment');
        return redirect()->route('drivers.view.appointment',$appointment->id);
    }

    //cancel the appointment  ??????????????????
    public function cancelAppointment (Appointment $appointment)
    {
        if ($appointment->driver_id!=Auth::guard('driver')->user()->id)
            throw ValidationException::withMessages('Only the creator can Delete the appointment');
        $appointment->passengers()->detach();
        $appointment->driver()->dissociate();
        $appointment->delete();


        Session::flash('success', 'You canceled the appointment');
        return redirect()->route('drivers.dashboard.show');
    }

    //show the appointment
    public function viewAppointment (Appointment $appointment)
    {
        return view('driver.view_appointment',['appointment' => $appointment]);
    }

    //search for the requests
    public function searchAppointment(Request $request)
    {
        $passengerRequests = DB::select(' SELECT * FROM `passenger_requests` WHERE `current_city` = ? AND `destination_city` = ? ',[$request->source,$request->destination]);
        $results = [];
        foreach ($passengerRequests as $passengerRequest){
            $results [] = [
                'from' => $passengerRequest->current_city.' - '.$passengerRequest->current_spot ,
                'to'=> $passengerRequest->destination_city.' - '.$passengerRequest->destination_spot ,
                'number_of_passengers' => $passengerRequest->number_of_passengers ,
                'number_of_mail' => $passengerRequest->number_of_mail ,
                'date' => $passengerRequest->travel_date ,
                'note' => $passengerRequest->note,
                'updated_at' => $passengerRequest->updated_at ,
                'url' => route('drivers.view.request',$passengerRequest->id)
            ];        }
        return response($results);
    }

    //view the Request
    public function viewRequest ($id)
    {
        $passengerRequest = PassengerRequest::find($id);
        return view('driver.view_request',['passengerRequest' => $passengerRequest]);
    }

    //accept the passenger's request
    public function acceptPassengerRequest(Appointment $appointment,Passenger $passenger,$notification_id)
    {
        foreach ($appointment->passengers as $_passenger)
        {
            if (DB::select('SELECT * FROM `appointment_passenger` WHERE `passenger_id` = \''.$passenger->id.'\' AND `appointment_id` = \''.$appointment->id.'\''))
            {
                DB::update('UPDATE `appointment_passenger` SET `verification` = 1 WHERE `passenger_id` = \''.$passenger->id.'\' AND `appointment_id` = \''.$appointment->id.'\' ');
                $passenger->notify(new PassengerRequestResponse(Auth::guard('driver')->user()->id,1));
                DB::delete('DELETE FROM `notifications` WHERE `id` = \''.$notification_id.'\'');
                $data = DB::select('SELECT * FROM `appointment_passenger` WHERE `id` = \''.$_passenger->id.'\' ');
                $appointment->number_of_passengers += $data[0]->number_of_passengers ;
                $appointment->number_of_mail += $data[0]->number_of_mail ;
                $appointment->update();
                break;
            }
        }
        Session::flash('success', 'You Accepted '.$passenger->first_name .' '.$passenger->middle_name .' '.$passenger->last_name.'\'s Request Successfully');
        return redirect()->route('drivers.dashboard.show');
    }

    //accept the passenger's request
    public function rejectPassengerRequest(Appointment $appointment,Passenger $passenger,$notification_id)
    {
        foreach ($appointment->passengers as $_passenger)
        {
            if (DB::select('SELECT * FROM `appointment_passenger` WHERE `passenger_id` = \''.$passenger->id.'\' AND `appointment_id` = \''.$appointment->id.'\''))
            {
                DB::delete('DELETE FROM `appointment_passenger`  WHERE `passenger_id` = \''.$passenger->id.'\' AND `appointment_id` = \''.$appointment->id.'\' ');
                $passenger->notify(new PassengerRequestResponse(Auth::guard('driver')->user()->id,0));
                DB::delete('DELETE FROM `notifications` WHERE `id` = \''.$notification_id.'\'');
                break;
            }
        }
        Session::flash('success', 'You Rejected '.$passenger->first_name .' '.$passenger->middle_name .' '.$passenger->last_name.'\'s Request Successfully');
        return redirect()->route('drivers.dashboard.show');
    }


}