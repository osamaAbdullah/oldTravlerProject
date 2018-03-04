<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePassengerRequestsTable extends Migration
{

    public function up()
    {
        // creating "passenger_requests" table
        DB::statement('CREATE TABLE IF NOT EXISTS `passenger_requests`(
                      `id`                            int UNSIGNED  AUTO_INCREMENT,
                      `current_city`                  varchar(50),
                      `current_spot`                  varchar(50),
                      `destination_city`              varchar(50),
                      `destination_spot`              varchar(50),
                      `number_of_passengers`          int(2),             
                      `number_of_mail`                int(2),
                      `travel_date`                   DATE,
                      `driver_id`                     int UNSIGNED,
                      `passenger_id`                  int UNSIGNED,
                      `note`                          varchar(255),
                      `created_at`                    timestamp NULL DEFAULT NULL,
                      `updated_at`                    timestamp NULL DEFAULT NULL,
                       primary key(id)
                       )
                       ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }


    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS `passenger_requests`');
    }
}
