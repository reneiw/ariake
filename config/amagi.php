<?php

return [
    'organization' => env('AMAGI_ORGANIZATION_ENABLE', false),
    'import' => [
        'proxy' => [
            'enable' => env('AMAGI_IMPORT_PROXY_ENABLE', false),
            'address' => env('AMAGI_IMPORT_PROXY_ADDRESS', null),
            'port' => env('AMAGI_IMPORT_PROXY_PORT', null),
        ],
    ],

    'routes' => [
        'enable' => false,

        'namespace' => 'Arukas\Amagi\Http\Controllers',

        'api' => [
            'prefix' => 'api/amagi',
            'middleware' => [
                'auth:api',
                'user_api_request_log',
                'permission:product_import',
            ],
        ],
        'web' => [
            'prefix' => 'amagi',
            'middleware' => [],
        ],
    ],

    'queue' => [
        'export' => env('AMAGI_QUEUE_EXPORT', null),
        'import' => env('AMAGI_QUEUE_IMPORT', null),
    ],

    /**
     * 数据库相关的选项设置
     * 如果你的数据库有多个，而且读写分离设计的非常垃圾，已经影响到业务的执行了
     * 请你把sticky改成false，并根据延迟的时间设置postpone，单位是秒
     * 这个设置只影响到队列任务的调用
     */
    'database' => [
        'sticky' => true,
        'postpone' => 1,
    ],

    /**
     * 用于shopify安装app的功能
     */
    'shopify' => [
        'app_name' => env('SHOPIFY_APP_NAME', 'SFS-TEST'),
        'api_key' => env('SHOPIFY_API_KEY', '123123213'),
        'api_secret' => env('SHOPIFY_API_SECRET', '44444'),
        'api_scopes' => env(
            'SHOPIFY_API_SCOPES',
            'read_products,write_products'
        ),
        'api_redirect_uri' => env('SHOPIFY_API_REDIRECT_URI', '/api/amagi/shopify'),
    ],

    'wShop' => [
        'overTLS' => env('AMAGI_WSHOP_OVER_TLS', true),
    ],

    'wshop' => [
        'over_tls' => env('AMAGI_WSHOP_OVER_TLS', true),
    ],

    'shopbase' => [
        'api_key' => env('SHOPBASE_API_KEY', null),
        'api_secret' => env('SHOPBASE_API_SECRET', null),
        'api_scopes' => env(
            'SHOPBASE_API_SCOPES',
            'read_products,write_products'
        ),
        'api_redirect_uri' => env('SHOPBASE_API_REDIRECT_URI', '/api/amagi/shopify'),
    ],
];
