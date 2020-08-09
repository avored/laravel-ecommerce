<?php
/*
  |--------------------------------------------------------------------------
  | AvoRed Cart Products Session Identifier
  |--------------------------------------------------------------------------
 */
return [
    'admin_url' => 'admin',
    'symlink_storage_folder' => 'storage',
    'cart' => ['session_key' => 'cart_products'],
    'model' => [
        'user' => Avored\Framework\Database\Models\Customer::class,
    ],

    'routes' => [
        'category' => [
            'param' => 'slug',
            'name' => 'category.show',
        ],
    ],

    'filesystems' => [
        'disks' => [
            'avored' => [
                'driver' => 'local',
                'root' => storage_path('app/public'),
            ],
        ],
    ],
    'image' => [
        'driver' => 'gd',
        'sizes' => [
            'small' => ['150', '150'],
            'med' => ['350', '350'],
            'large' => ['750', '750'],
        ],
    ],
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'admin_api' => [
                'driver' => 'passport',
                'provider' => 'admin-users',
                'hash' => false,
            ],
        ],

        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\AdminUser::class,
            ],
        ],

        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
        ],
    ],
    'graphql' => [
        'schemas' => [
            'default' => [
                'query' => [
                    // 'example_query' => ExampleQuery::class,
                    'userInfo' => AvoRed\Framework\GraphQL\Query\System\Auth\UserInfoQuery::class,
                    'admin_menus' => AvoRed\Framework\GraphQL\Query\System\Layout\AdminMenuQuery::class,
                    'allCategory' => AvoRed\Framework\GraphQL\Query\Catalog\Category\AllQuery::class,
                    'fetchCategory' => AvoRed\Framework\GraphQL\Query\Catalog\Category\FetchQuery::class,
                ],
                'mutation' => [
                    'createCategory' => AvoRed\Framework\GraphQL\Mutation\Catalog\Category\Create::class,
                    'updateCategory' => AvoRed\Framework\GraphQL\Mutation\Catalog\Category\Update::class,
                    'deleteCategory' => AvoRed\Framework\GraphQL\Mutation\Catalog\Category\Delete::class,
                ],
                'middleware' => ['auth:admin_api'],
                'method' => ['get', 'post'],
            ],
            'guest' => [
                'query' => [
                    // 'example_query' => ExampleQuery::class,
                ],
                'mutation' => [
                    'auth' => AvoRed\Framework\GraphQL\Mutation\Auth\Login::class,
                ],
                'middleware' => [],
                'method' => ['get', 'post'],
            ],
        ],
        'types' => [
            'token' => \AvoRed\Framework\GraphQL\Type\Auth\TokenType::class,
            'adminUserType' => \AvoRed\Framework\GraphQL\Type\System\AdminUserType::class,
            'adminMenuType' => \AvoRed\Framework\GraphQL\Type\System\Layout\AdminMenuType::class,
            'category_type' => \AvoRed\Framework\GraphQL\Type\Catalog\CategoryType::class,
        ],
    ],
];
