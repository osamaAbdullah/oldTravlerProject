<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        return view('driver.register');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }

    public function __construct()
    {
        $this->middleware('guest:driver');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|unique:drivers',
            'email' => 'required|string|email|max:150|unique:drivers',
            'birthday' => 'required|date',
            'gender' => 'required|boolean',
            'bio' => 'max:255',
            'vehicle_bio' => 'max:255',
            'address' => 'required|string|max:255',
            'type_of_vehicle' => 'required|numeric',
            'max_pass' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Driver::create([
            'first_name' =>  $data['first_name'],
            'middle_name' =>  $data['middle_name'],
            'last_name' =>  $data['last_name'],
            'phone_number' =>  $data['phone_number'],
            'email' =>  $data['email'],
            'birthday' =>  $data['birthday'],
            'gender' => $data['gender'],
            'bio' =>  $data['bio'],
            'vehicle_bio' =>  $data['vehicle_bio'],
            'address' =>  $data['address'],
            'type_of_vehicle' =>  $data['type_of_vehicle'],
            'max_pass' =>  $data['max_pass'],
            'password' => bcrypt($data['password']),
        ]);
    }
}