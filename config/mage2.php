<?php


return [

    'system' => [
        'meta_title' => ['type' => 'text']
    ],

    'payment' => [
        'paypal'        => ['class' => '/Modules/Core/Payment','label' => 'Paypal'],
        'creditcart'    => ['class' => '/Modules/Core/Payment','label' => 'Credit Cart']
    ],
    'shipping' => [
        'freeshipping'  => ['class' => "/Modules/Core/Shipping", 'label' => 'Free Shipping'],
        'pickup'        => ['class' => "/Modules/Core/Shipping",'label' => 'Pick Up from Store']
        ]
];