<?php

return [

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin-users',
        ],
    ],

    'providers' => [
        'admin-users' => [
            'driver' => 'eloquent',
            'model' => AvoRed\Ecommerce\Models\Database\AdminUser::class,
        ],
    ],

    'passwords' => [
        'adminusers' => [
            'provider' => 'admin-users',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ],
    ],

];
