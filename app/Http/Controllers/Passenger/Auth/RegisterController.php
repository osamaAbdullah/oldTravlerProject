<?php

namespace App\Http\Controllers\Passenger\Auth;

use App\Passenger;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('passenger.register');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:web');
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|unique:passengers',
            'email' => 'required|string|email|max:255|unique:passengers',
            'birthday' => 'required|date',
            'gender' => 'required|boolean',
            'bio' => 'string|max:255',
            'address' => 'string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Passenger::create([
            'first_name' =>  $data['first_name'],
            'middle_name' =>  $data['middle_name'],
            'last_name' =>  $data['last_name'],
            'phone_number' =>  $data['phone_number'],
            'email' =>  $data['email'],
            'birthday' =>  $data['birthday'],
            'gender' => $data['gender'],
            'bio' =>  $data['bio'],
            'address' =>  $data['address'],
            'password' => bcrypt($data['password']),
        ]);
    }
}