<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        // creating "bookings" table
        DB::statement('CREATE TABLE IF NOT EXISTS `appointments`(
                      `id`                            int UNSIGNED  AUTO_INCREMENT,
                      `current_city`                  varchar(50),
                      `current_spot`                  varchar(50),
                      `destination_city`              varchar(50),
                      `destination_spot`              varchar(50),
                      `number_of_passengers`          int(2),             
                      `number_of_mail`                int(2),
                      `time_is_fixed`                 BOOLEAN,                  
                      `travel_date`                   DATE,
                      `start_time`                    TIME,
                      `end_time`                      TIME,
                      `price_per_passenger`           int(5),
                      `price_per_mail`                int(5),
                      `min_number_of_passenger`       int(2),
                      `max_number_of_passenger`       int(2),
                      `driver_id`                    int UNSIGNED,
                      `note`                         varchar(255),
                      `created_at`                    timestamp NULL DEFAULT NULL,
                      `updated_at`                    timestamp NULL DEFAULT NULL,
                       primary key(id)
                       )
                       ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }
    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS `appointments`');
    }
}
