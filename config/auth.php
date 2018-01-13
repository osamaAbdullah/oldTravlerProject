<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'passengers',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'passengers',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'passengers',
        ],
        'driver' => [
            'driver' => 'session',
            'provider' => 'drivers',
        ],

        'driver-api' => [
            'driver' => 'token',
            'provider' => 'drivers',
        ],
    ],

    'providers' => [
        'passengers' => [
            'driver' => 'eloquent',
            'model' => App\Passenger::class,
        ],
        'drivers' => [
            'driver' => 'eloquent',
            'model' => App\Driver::class,
        ],

    ],

    'passwords' => [
        'passengers' => [
            'provider' => 'passengers',
            'table' => 'password_resets',
            'expire' => 20,
        ],
        'drivers' => [
            'provider' => 'drivers',
            'table' => 'password_resets',
            'expire' => 20,
        ],
    ],

];
