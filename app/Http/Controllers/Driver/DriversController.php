<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use App\Http\Controllers\Controller;

class DriversController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:driver');
    }

    public function showDashboard()
    {

        return view('driver.dashboard');
    }
    public function showProfile($id)
    {
        $driver = Driver::find($id);
        return view('driver.profile',['driver' => $driver]);
    }
}
