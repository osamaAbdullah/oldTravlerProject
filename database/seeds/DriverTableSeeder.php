<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drivers')->insert([
            'id' => 1,
            'first_name' => 'driver',
            'middle_name' => 'jojo',
            'last_name' => 'sweet',
            'phone_number' => '07701458596',
            'emergency_phone_number' => '07821452574',
            'email' => 'driver@a.com',
            'emergency_email' => 'a@a.com',
            'birthday' => '2018-02-12',
            'gender' => 1,
            'weight' => 83,
            'height' => 183,
            'bio' => 'the default driver',
            'vehicle_bio' => 'the default vehicle',
            'address' => 'slemany',
            'profile_picture' => null,
            'vehicle_picture' => null,
            'type_of_vehicle' => 'bus',
            'max_pass' => 22,
            'password' => '$2y$10$VCvU6uzkFx8RXfNehLO6X.v6R2C76MRxlt.prPKl7MGA/.21CviJ.',
            'remember_token' => null,
            'created_at' => '2018-02-25 12:49:09' ,
            'updated_at' => '2018-03-25 10:33:13'
        ]);
    }
}
