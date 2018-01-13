<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('phone_number')->unique();
            $table->string('emergency_phone_number')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('emergency_email')->unique()->nullable();
            $table->date('birthday');
            $table->boolean('gender');
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->string('bio')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passengers', function (Blueprint $table) {
            //
        });
    }
}
