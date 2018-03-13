<?php

namespace App\Http\Controllers\Passenger;

use App\Appointment;
use App\Driver;
use App\Passenger;
use App\PassengerRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

//Passenger
class PassengersController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    //show dashboard
    public function showDashboard()
    {
        $passenger = Passenger::find(Auth::guard('web')->user()->id);
        $appointments = [];
        foreach ($passenger->appointments as $appointment)
        {
            if ($appointment->pivot->verification == 1)
                $appointments[sizeof($appointments)] = $appointment;
        }
        return view('passenger.dashboard',['passenger'=> $appointments ,'passenger_requests'=> $passenger->passenger_requests ]);
    }

    //show profile
    public function showProfile(Passenger $passenger)
    {
        return view('passenger.profile',['passenger' => $passenger]);
    }

    //create Request show appointment form
    public function createRequest()
    {
        $cities = DB::select('SELECT `name` FROM `cities`');
        return view('passenger.create_request',['cities' => $cities]);
    }

    //save the Request to the database
    public function saveRequest(Request $request)
    {
        $this->validate($request, array(
            'current_city' => 'required|max:50',
            'destination_city' => 'required|max:50',
            'current_spot' => 'sometimes|max:50',
            'destination_spot' => 'sometimes|max:50',
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
            'travel_date' => 'required|date',
            'notes' => 'sometimes|max:255',
        ));
        $passengerRequest = new PassengerRequest ;
        $passengerRequest->current_city = $request->current_city;
        $passengerRequest->current_spot = $request->current_spot;
        $passengerRequest->destination_city = $request->destination_city;
        $passengerRequest->destination_spot = $request->destination_spot;
        $passengerRequest->number_of_passengers = $request->number_of_passengers;
        $passengerRequest->number_of_mail = $request->number_of_mail;
        $passengerRequest->travel_date = $request->travel_date;
        $passengerRequest->driver_id = null;
        $passengerRequest->passenger_id = Auth::guard('web')->user()->id;
        $passengerRequest->note = $request->note;
        $passengerRequest->save();

        Session::flash('success', 'The Request is created successfully You will be notified as soon as appointment is created');
        return redirect()->route('passengers.dashboard.show');
    }

    //edit the Request show edit form
    public function editRequest ($id)
    {
        $cities = DB::select('SELECT `name` FROM `cities`');
        $passengerRequest = PassengerRequest::find($id);
        if ($passengerRequest->passenger_id != Auth::guard('web')->user()->id )
            throw ValidationException::withMessages('Only the creator can edit the the request');
        return view('passenger.edit_request',['passengerRequest'=>$passengerRequest,'cities' => $cities]);
    }

    //save edition changes to the database
    public function updateRequest(Request $request,$id)
    {
        $passengerRequest = PassengerRequest::find($id);
        $this->validate($request, array(
            'current_city' => 'required|max:50',
            'destination_city' => 'required|max:50',
            'current_spot' => 'sometimes|max:50',
            'destination_spot' => 'sometimes|max:50',
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
            'travel_date' => 'required|date',
            'notes' => 'sometimes|max:255',
        ));
        $passengerRequest->current_city = $request->current_city;
        $passengerRequest->current_spot = $request->current_spot;
        $passengerRequest->destination_city = $request->destination_city;
        $passengerRequest->destination_spot = $request->destination_spot;
        $passengerRequest->number_of_passengers = $request->number_of_passengers;
        $passengerRequest->number_of_mail = $request->number_of_mail;
        $passengerRequest->travel_date = $request->travel_date;
        $passengerRequest->note = $request->note;
        $passengerRequest->update();

        Session::flash('success', 'The Request is updated successfully You will be notified as soon as an appointment is created');
        return redirect()->route('passengers.dashboard.show');
    }

    //cancel the Request
    public function cancelRequest ($id)
    {
        $passengerRequest = PassengerRequest::find($id);
        if ($passengerRequest->driver_id==null)
        {
            $passengerRequest->delete();
        } else {
            throw ValidationException::withMessages(['You have to cancel the appointment first']);
        }
        Session::flash('success', 'The Request is deleted successfully');
        return redirect()->route('passengers.dashboard.show');
    }

    //view the appointment
    public function viewRequest (PassengerRequest $passengerRequest)
    {
        return view('passenger.view_request',['passengerRequest' => $passengerRequest]);
    }

    //cancel the appointment ???????????????
    public function cancelAppointment (Appointment $appointment)
    {
        foreach ($appointment->passengers as $passenger)
        {
            if ($passenger->id == Auth::guard('web')->user()->id)
            {
                $appointment->number_of_passengers -= $passenger->pivot->number_of_passengers ;
                $appointment->number_of_mail -= $passenger->pivot->number_of_mail ;
                break;
            }
        }
        $appointment->update();
        $appointment->passengers()->detach(Auth::guard('web')->user()->id);
        if(sizeof($appointment->passengers) == 0 && $appointment->driver_id == null)
            $appointment->delete();
        
        Session::flash('success', 'You canceled the appointment');
        return redirect()->route('passengers.dashboard.show');
    }

    //search the appointment
    public function searchAppointment(Request $request)
    {
        $appointments = DB::select('SELECT * FROM `appointments` WHERE `destination_city` LIKE \'%'.$request->term.'%\' OR `destination_spot` LIKE \'%'.$request->term.'%\' ');
        $results = [];
        foreach ($appointments as $appointment){
            $results [] = [
                'from' => $appointment->current_city.' - '.$appointment->current_spot ,
                'to'=> $appointment->destination_city.' - '.$appointment->destination_spot ,
                'date' => $appointment->travel_date ,
                'time' => $appointment->start_time ,
                'driver' => $appointment->driver_id ,
                'note' => $appointment->note,
                'updated_at' => $appointment->updated_at ,
                'url' => route('passenger.view.appointment',$appointment->id)
            ];
        }
        return response($results);
    }

    //view the appointment
    public function viewAppointment (Appointment $appointment)
    {
        return view('passenger.view_appointment',['appointment' => $appointment]);
    }

    //show booking form
    public function bookingAppointmentForm (Appointment $appointment)
    {
        return view('passenger.booking_appointment_form',['appointment' => $appointment]);
    }

    //save the booked appointment to the database
    public function bookAppointment(Request $request,Appointment $appointment)
    {
        $this->validate($request, array(
            'number_of_passengers' => 'required|numeric',
            'number_of_mail' => 'required|numeric',
        ));
        if ($request->number_of_passengers + $appointment->number_of_passengers > $appointment->max_number_of_passenger)
            throw ValidationException::withMessages(['Number of passenger will be more than maximum']);
        $passenger = Passenger::find(Auth::guard('web')->user()->id);
        $appointment->passengers()->save($passenger,['number_of_passengers'=>$request->number_of_passengers,'number_of_mail'=>$request->number_of_mail,'verification'=>false]);
        Driver::find($appointment->driver_id)->notify(new \App\Notifications\PassengerRequest(Auth::guard('web')->user()->id,$request->number_of_passengers,$request->number_of_mail,$appointment->id));
        Session::flash('success', 'Request has been sent');
        return redirect()->route('passengers.dashboard.show');
    }
}