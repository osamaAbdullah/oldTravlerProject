<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('appointments')->insert([
            'id'                         => 1 ,
            'current_city'               => 'akre' ,
            'current_spot'               => 'tlita' ,
            'destination_city'           => 'erbil' ,
            'destination_spot'           => '3adala' ,
            'number_of_passengers'       => 0 ,
            'number_of_mail'             => 0 ,
            'time_is_fixed'              => false ,
            'travel_date'                => '2018-02-12' ,
            'start_time'                 => '10:09:00' ,
            'end_time'                   => '21:09:00' ,
            'price_per_passenger'        => 4000 ,
            'price_per_mail'             => 1000 ,
            'min_number_of_passenger'    => 22 ,
            'max_number_of_passenger'    => 22 ,
            'driver_id'                  => 1 ,
            'note'                       => 'default appointment' ,
            'created_at' => '2018-02-25 12:49:09' ,
            'updated_at' => '2018-03-25 10:33:13'
        ]);
    }
}
