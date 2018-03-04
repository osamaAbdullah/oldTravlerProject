<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentPassengerTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_passenger', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('passenger_id');
            $table->unsignedInteger('appointment_id');
            $table->unsignedInteger('number_of_passengers')->nullable();
            $table->unsignedInteger('number_of_mail')->nullable();
            $table->boolean('verification')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment_passenger');
    }
}