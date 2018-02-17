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
    Route::get('profile/{passenger}', 'Passenger\PassengersController@showProfile')->name('passengers.profile.show');

//createAppointment
    Route::get('createAppointment', 'Passenger\PassengersController@createAppointment')->name('passengers.create.appointment');
//saveAppointment
    Route::post('saveAppointment', 'Passenger\PassengersController@saveAppointment')->name('passengers.save.appointment');
//editAppointment
    Route::get('editAppointment/{appointment}', 'Passenger\PassengersController@editAppointment')->name('passengers.edit.appointment');
//updateAppointment
    Route::POST('updateAppointment/{appointment}', 'Passenger\PassengersController@updateAppointment')->name('passengers.update.appointment');
//cancelAppointment
    Route::POST('cancelAppointment/{appointment}', 'Passenger\PassengersController@cancelAppointment')->name('passengers.cancel.appointment');
//searchAppointment
    Route::GET('searchAppointment', 'Passenger\PassengersController@searchAppointment')->name('passenger.search.appointment');

//viewAppointment
    Route::GET('viewAppointment/{appointment}', 'Passenger\PassengersController@viewAppointment')->name('passenger.view.appointment');

//bookingAppointmentForm
    Route::GET('bookingAppointmentForm/{appointment}', 'Passenger\PassengersController@bookingAppointmentForm')->name('passenger.booking.appointment.form');
//bookAppointment
    Route::GET('bookAppointment/{appointment}', 'Passenger\PassengersController@bookAppointment')->name('passengers.book.appointment');
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

//createAppointment
    Route::get('createAppointment', 'Driver\DriversController@createAppointment')->name('driver.create.appointment');
//saveAppointment
    Route::post('saveAppointment', 'Driver\DriversController@saveAppointment')->name('driver.save.appointment');
//editAppointment
    Route::get('editAppointment/{appointment}', 'Driver\DriversController@editAppointment')->name('driver.edit.appointment');
//updateAppointment
    Route::POST('updateAppointment/{appointment}', 'Driver\DriversController@updateAppointment')->name('driver.update.appointment');
//cancelAppointment
    Route::POST('cancelAppointment/{appointment}', 'Driver\DriversController@cancelAppointment')->name('driver.cancel.appointment');
//searchAppointment
    Route::GET('searchAppointment', 'Driver\DriversController@searchAppointment')->name('driver.search.appointment');

//viewAppointment
    Route::GET('viewAppointment/{appointment}', 'Driver\DriversController@viewAppointment')->name('driver.view.appointment');

//bookingAppointmentForm
    Route::GET('bookingAppointmentForm/{appointment}', 'Driver\DriversController@bookingAppointmentForm')->name('driver.booking.appointment.form');
//bookAppointment
    Route::GET('bookAppointment/{appointment}', 'Driver\DriversController@bookAppointment')->name('driver.book.appointment');
});