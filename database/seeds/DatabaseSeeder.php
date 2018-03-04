<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AppointmentTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(DriverTableSeeder::class);
         $this->call(PassengerTableSeeder::class);
    }
}
