<?php

require_once __DIR__ . '/mail.php';

return [
    'name' => 'Sendity',

    'environment' => 'development',

    'debug' => true,


    /*
    |--------------------------------------------------------------------------
    | Audit
    |--------------------------------------------------------------------------
    */

    'audit' => [
        'path' => __DIR__ . '/../storage/audit',
    ],
];