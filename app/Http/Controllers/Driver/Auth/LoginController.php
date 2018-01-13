<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return view('driver.login');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }
}
