<?php

Route::GET('/',function(){return view('index');})->name('home');

Route::prefix('passengers')->group(function() {
// Authentication Routes...
    Route::GET('login', 'Passenger\Auth\LoginController@showLoginForm')->name('passengers.login');
    Route::POST('login', 'Passenger\Auth\LoginController@login');
    Route::POST('logout', 'Passenger\Auth\LoginController@logout')->name('passengers.logout');

// Registration Routes...
    Route::GET('register', 'Passenger\Auth\RegisterController@showRegistrationForm')->name('passengers.register');
    Route::POST('register', 'Passenger\Auth\RegisterController@register');

// Password Reset Routes...
    Route::GET('password/reset', 'Passenger\Auth\ForgotPasswordController@showLinkRequestForm')->name('passengers.password.request');
    Route::POST('password/email', 'Passenger\Auth\ForgotPasswordController@sendResetLinkEmail')->name('passengers.password.email');
    Route::GET('password/reset/{token}', 'Passenger\Auth\ResetPasswordController@showResetForm')->name('passengers.password.reset');
    Route::POST('password/reset', 'Passenger\Auth\ResetPasswordController@reset');

//dashboard
    Route::GET('dashboard', 'Passenger\PassengersController@showDashboard')->name('passengers.dashboard.show');

//profile
    Route::GET('profile/{passenger}', 'Passenger\PassengersController@showProfile')->name('passengers.profile.show');

//createRequest
    Route::GET('createRequest', 'Passenger\PassengersController@createRequest')->name('passengers.create.request');
//saveRequest
    Route::POST('saveRequest', 'Passenger\PassengersController@saveRequest')->name('passengers.save.request');
//editRequest
    Route::GET('editRequest/{request}', 'Passenger\PassengersController@editRequest')->name('passengers.edit.request');
//updateRequest
    Route::PUT('updateRequest/{request}', 'Passenger\PassengersController@updateRequest')->name('passengers.update.request');
//cancelRequest
    Route::POST('cancelRequest/{request}', 'Passenger\PassengersController@cancelRequest')->name('passengers.cancel.request');
//viewRequest
    Route::GET('viewRequest/{request}', 'Passenger\PassengersController@viewRequest')->name('passenger.view.request');

//searchAppointment
    Route::GET('searchAppointment', 'Passenger\PassengersController@searchAppointment')->name('passenger.search.appointment');
//viewAppointment
    Route::GET('viewAppointment/{appointment}', 'Passenger\PassengersController@viewAppointment')->name('passenger.view.appointment');
//cancelAppointment
    Route::POST('cancelAppointment/{appointment}', 'Passenger\PassengersController@cancelAppointment')->name('passengers.cancel.appointment');


//bookingAppointmentForm
    Route::GET('bookingAppointmentForm/{appointment}', 'Passenger\PassengersController@bookingAppointmentForm')->name('passenger.booking.appointment.form');
//bookAppointment
    Route::GET('bookAppointment/{appointment}', 'Passenger\PassengersController@bookAppointment')->name('passengers.book.appointment');
});

Route::prefix('drivers')->group(function() {
    // Authentication Routes...
    Route::GET('login', 'Driver\Auth\LoginController@showLoginForm')->name('drivers.login');
    Route::POST('login', 'Driver\Auth\LoginController@login');
    Route::POST('logout', 'Driver\Auth\LoginController@logout')->name('drivers.logout');

// Registration Routes...
    Route::GET('register', 'Driver\Auth\RegisterController@showRegistrationForm')->name('drivers.register');
    Route::POST('register', 'Driver\Auth\RegisterController@register');

// Password Reset Routes...
    Route::GET('password/reset', 'Driver\Auth\ForgotPasswordController@showLinkRequestForm')->name('drivers.password.request');
    Route::POST('password/email', 'Driver\Auth\ForgotPasswordController@sendResetLinkEmail')->name('drivers.password.email');
    Route::GET('password/reset/{token}', 'Driver\Auth\ResetPasswordController@showResetForm')->name('drivers.password.reset');
    Route::POST('password/reset', 'Driver\Auth\ResetPasswordController@reset');

//dashboard
    Route::GET('dashboard', 'Driver\DriversController@showDashboard')->name('drivers.dashboard.show');

//profile
    Route::GET('profile/{driver}', 'Driver\DriversController@showProfile')->name('drivers.profile.show');

//createAppointment
    Route::GET('createAppointment', 'Driver\DriversController@createAppointment')->name('drivers.create.appointment');
//saveAppointment
    Route::POST('saveAppointment', 'Driver\DriversController@saveAppointment')->name('drivers.save.appointment');
//editAppointment
    Route::GET('editAppointment/{appointment}', 'Driver\DriversController@editAppointment')->name('drivers.edit.appointment');
//updateAppointment
    Route::POST('updateAppointment/{appointment}', 'Driver\DriversController@updateAppointment')->name('drivers.update.appointment');
//cancelAppointment
    Route::POST('cancelAppointment/{appointment}', 'Driver\DriversController@cancelAppointment')->name('drivers.cancel.appointment');
//searchAppointment
    Route::GET('searchAppointment', 'Driver\DriversController@searchAppointment')->name('drivers.search.appointment');

//viewAppointment
    Route::GET('viewAppointment/{appointment}', 'Driver\DriversController@viewAppointment')->name('drivers.view.appointment');

//viewRequest
    Route::GET('viewRequest/{request}', 'Driver\DriversController@viewRequest')->name('drivers.view.request');



//bookingAppointmentForm
    Route::GET('bookingAppointmentForm/{appointment}', 'Driver\DriversController@bookingAppointmentForm')->name('drivers.booking.appointment.form');
//bookAppointment
    Route::GET('bookAppointment/{appointment}', 'Driver\DriversController@bookAppointment')->name('drivers.book.appointment');
});