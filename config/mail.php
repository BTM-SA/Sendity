<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mail Transport
    |--------------------------------------------------------------------------
    */

    'default' => 'smtp',

    /*
    |--------------------------------------------------------------------------
    | Mail Transports
    |--------------------------------------------------------------------------
    */

    'transports' => [

        'smtp' => [

            'host' => $_ENV['MAIL_HOST'] ?? null,

            'port' => (int) ($_ENV['MAIL_PORT'] ?? 587),

            'username' => $_ENV['MAIL_USERNAME'] ?? null,

            'password' => $_ENV['MAIL_PASSWORD'] ?? null,

            'encryption' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',

            'timeout' => (int) ($_ENV['MAIL_TIMEOUT'] ?? 30),

            'hostname' => $_ENV['MAIL_HOSTNAME'] ?? 'localhost',

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Sender
    |--------------------------------------------------------------------------
    */

    'from' => [

        'address' => $_ENV['MAIL_FROM_ADDRESS'] ?? null,

        'name' => $_ENV['MAIL_FROM_NAME'] ?? 'Sendity',

    ],

    /*
    |--------------------------------------------------------------------------
    | Mailbox Driver
    |--------------------------------------------------------------------------
    */

    'mailbox' => [

        'driver' => 'native',

    ],

    /*
    |--------------------------------------------------------------------------
    | IMAP Configuration
    |--------------------------------------------------------------------------
    */

    'imap' => [

        'host' => 'imap.example.com',

        'port' => 993,

        'username' => 'your@email.com',

        'password' => 'your-password',

        'encryption' => 'ssl',

        'sent_folder' => 'Sent',

    ],

];