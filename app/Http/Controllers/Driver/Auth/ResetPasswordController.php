<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:driver');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('driver.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function broker()
    {
        return Password::broker('drivers');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }
}
