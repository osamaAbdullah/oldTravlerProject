<?php

namespace App\Http\Controllers\Passenger\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function showLinkRequestForm()
    {
        return view('passenger.passwords.email');
    }

    public function broker()
    {
        return Password::broker('passengers');
    }

}
