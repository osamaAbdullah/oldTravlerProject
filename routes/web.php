<?php

Route::get('/',function(){return view('index');})->name('home');

Route::prefix('passengers')->group(function() {
// Authentication Routes...
    Route::get('login', 'Passenger\Auth\LoginController@showLoginForm')->name('passengers.login');
    Route::post('login', 'Passenger\Auth\LoginController@login');
    Route::post('logout', 'Passenger\Auth\LoginController@logout')->name('passengers.logout');

// Registration Routes...
    Route::get('register', 'Passenger\Auth\RegisterController@showRegistrationForm')->name('passengers.register');
    Route::post('register', 'Passenger\Auth\RegisterController@register');

// Password Reset Routes...
    Route::get('password/reset', 'Passenger\Auth\ForgotPasswordController@showLinkRequestForm')->name('passengers.password.request');
    Route::post('password/email', 'Passenger\Auth\ForgotPasswordController@sendResetLinkEmail')->name('passengers.password.email');
    Route::get('password/reset/{token}', 'Passenger\Auth\ResetPasswordController@showResetForm')->name('passengers.password.reset');
    Route::post('password/reset', 'Passenger\Auth\ResetPasswordController@reset');

//dashboard
    Route::get('dashboard', 'Passenger\PassengersController@showDashboard')->name('passengers.dashboard.show');

//profile
    Route::get('profile', 'Passenger\PassengersController@showProfile')->name('passengers.profile.show');

//createAppointment
    Route::get('createAppointment', 'Passenger\PassengersController@createAppointment')->name('passengers.create.appointment');
//saveAppointment
    Route::post('saveAppointment', 'Passenger\PassengersController@saveAppointment')->name('passengers.save.appointment');
});

Route::prefix('drivers')->group(function() {
    // Authentication Routes...
    Route::get('login', 'Driver\Auth\LoginController@showLoginForm')->name('drivers.login');
    Route::post('login', 'Driver\Auth\LoginController@login');
    Route::post('logout', 'Driver\Auth\LoginController@logout')->name('drivers.logout');

// Registration Routes...
    Route::get('register', 'Driver\Auth\RegisterController@showRegistrationForm')->name('drivers.register');
    Route::post('register', 'Driver\Auth\RegisterController@register');

// Password Reset Routes...
    Route::get('password/reset', 'Driver\Auth\ForgotPasswordController@showLinkRequestForm')->name('drivers.password.request');
    Route::post('password/email', 'Driver\Auth\ForgotPasswordController@sendResetLinkEmail')->name('drivers.password.email');
    Route::get('password/reset/{token}', 'Driver\Auth\ResetPasswordController@showResetForm')->name('drivers.password.reset');
    Route::post('password/reset', 'Driver\Auth\ResetPasswordController@reset');

//dashboard
    Route::get('dashboard', 'Driver\DriversController@showDashboard')->name('drivers.dashboard.show');


//profile
    Route::get('profile/{driver}', 'Driver\DriversController@showProfile')->name('drivers.profile.show');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
