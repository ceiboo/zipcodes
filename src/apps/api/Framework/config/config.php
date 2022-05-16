<?php

return [
    'environment' => "local",
    'dbconnection' => [
        'mysql_local' => [
            'driver' => 'mysql',
            'url' => '',
            'host' => 'db',
            'port' => '3306',
            'database' => 'ceiboo-main-db',
            'username' => 'admin',
            'password' => 'ROx9NW?s_Xab34y',
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'mysql_prod' => [
            'driver' => 'mysql',
            'url' => '',
            'host' => 'db',
            'port' => '3306',
            'database' => 'ceiboo-main-db',
            'username' => 'admin',
            'password' => 'ROx9NW?s_Xab34y',
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ]
    ]
];
