<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:driver');
    }

    public function showLinkRequestForm()
    {
        return view('driver.passwords.email');
    }

    public function broker()
    {
        return Password::broker('drivers');
    }
}
