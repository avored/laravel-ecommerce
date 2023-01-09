<?php

use AvoRed\Framework\Graphql\Mutations\Auth\LoginMutation;
use AvoRed\Framework\Graphql\Mutations\Auth\RegisterMutation;
use AvoRed\Framework\Graphql\Mutations\Cart\AddToCartMutation;
use AvoRed\Framework\Graphql\Mutations\Cart\DeleteCartMutation;
use AvoRed\Framework\Graphql\Mutations\Customer\CreateAddressMutation;
use AvoRed\Framework\Graphql\Mutations\Customer\CreateSubscriberMutation;
use AvoRed\Framework\Graphql\Mutations\Customer\CustomerUpdateMutation;
use AvoRed\Framework\Graphql\Mutations\Customer\DeleteAddressMutation;
use AvoRed\Framework\Graphql\Mutations\Customer\UpdateAddressMutation;
use AvoRed\Framework\Graphql\Mutations\PlaceOrderMutation;
use AvoRed\Framework\Graphql\Queries\AddressQuery;
use AvoRed\Framework\Graphql\Queries\AllAddressQuery;
use AvoRed\Framework\Graphql\Queries\AllCategoryQuery;
use AvoRed\Framework\Graphql\Queries\AllOrdersQuery;
use AvoRed\Framework\Graphql\Queries\OrderQuery;
use AvoRed\Framework\Graphql\Queries\CartItems;
use AvoRed\Framework\Graphql\Queries\CartItemsQuery;
use AvoRed\Framework\Graphql\Queries\CategoryQuery;
use AvoRed\Framework\Graphql\Queries\CountryOptionsQuery;
use AvoRed\Framework\Graphql\Queries\CustomerQuery;
use AvoRed\Framework\Graphql\Queries\LatestProductQuery;
use AvoRed\Framework\Graphql\Queries\PaymentQuery;
use AvoRed\Framework\Graphql\Queries\ShippingQuery;
use AvoRed\Framework\Graphql\Types\AddressType;
use AvoRed\Framework\Graphql\Types\CartProductType;
use AvoRed\Framework\Graphql\Types\CategoryType;
use AvoRed\Framework\Graphql\Types\CustomerType;
use AvoRed\Framework\Graphql\Types\NotificationType;
use AvoRed\Framework\Graphql\Types\OptionType;
use AvoRed\Framework\Graphql\Types\OrderType;
use AvoRed\Framework\Graphql\Types\PaymentType;
use AvoRed\Framework\Graphql\Types\ProductType;
use AvoRed\Framework\Graphql\Types\ShippingType;
use AvoRed\Framework\Graphql\Types\SubscriberType;
use AvoRed\Framework\Graphql\Mutations\Auth\ForgotPasswordMutation;
use AvoRed\Framework\Graphql\Mutations\Auth\ResetPasswordMutation;
use AvoRed\Framework\Graphql\Mutations\Cart\UpdateCartMutation;
use AvoRed\Framework\Graphql\Queries\ProductQuery;
use AvoRed\Framework\System\Controllers\AvoRedGraphQLController;

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed Config Information
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'admin_url' => 'admin',

    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'customer' => [
                'driver' => 'passport',
                'provider' => 'customers',
            ],
        ],
        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\AdminUser::class,
            ],
            'customers' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\Customer::class,
            ],
        ],

        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
            'customers' => [
                'provider' => 'customers',
                'table' => 'customer_password_resets',
                'expire' => 60,
            ],
        ],
    ],
    'graphql' => [
        'route' => [],
        'schemas' => [
            'default' => [
                'query' => [
                    'latestProductQuery' => LatestProductQuery::class,
                    'allCategory' => AllCategoryQuery::class,
                    'category' => CategoryQuery::class,
                    'product' => ProductQuery::class,
                    'shippingQuery' => ShippingQuery::class,
                    'paymentQuery' => PaymentQuery::class,
                    'countryOptions' => CountryOptionsQuery::class,
                    'cartItems' => CartItemsQuery::class,
                    'allAddress' => AllAddressQuery::class,
                    'addressQuery' => AddressQuery::class,
                    'customerQuery' => CustomerQuery::class,
                    'allOrders' => AllOrdersQuery::class,
                    'order' => OrderQuery::class,
                ],
                'mutation' => [
                    'login' => LoginMutation::class,
                    'register' => RegisterMutation::class,
                    'forgotPassword' => ForgotPasswordMutation::class,
                    'resetPassword' => ResetPasswordMutation::class,
                    'customerUpdate' => CustomerUpdateMutation::class,
                    'createAddress' => CreateAddressMutation::class,
                    'updateAddress' =>  UpdateAddressMutation::class,
                    'deleteAddress' => DeleteAddressMutation::class,
                    'placeOrder' => PlaceOrderMutation::class,
                    'addToCart' => AddToCartMutation::class,
                    'updateCart' => UpdateCartMutation::class,
                    'deleteCart' => DeleteCartMutation::class,
                    'CreateSubscriberMutation' => CreateSubscriberMutation::class,
                ],
                'middleware' => [],
                'method'     => ['GET', 'POST'],
            ],
        ],

        'types' => [
            'Category' => CategoryType::class,
            \Rebing\GraphQL\Support\UploadType::class,
            'Product' => ProductType::class,
            'Customer' => CustomerType::class,
            'Order' => OrderType::class,
            'Address' => AddressType::class,
            'Notification' => NotificationType::class,
            'CartProduct' => CartProductType::class,
            'Payment' => PaymentType::class,
            'Shipping' => ShippingType::class,
            'Subscriber' => SubscriberType::class,
            'Option' => OptionType::class,
        ],
    ],
];
