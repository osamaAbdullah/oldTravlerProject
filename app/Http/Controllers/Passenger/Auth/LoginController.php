<?php

namespace App\Http\Controllers\Passenger\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('passenger.login');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect('/');
    }
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}