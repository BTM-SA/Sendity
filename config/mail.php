<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Mail Transport
    |--------------------------------------------------------------------------
    */

    "default" => "smtp",
    
    'mailbox' => $_ENV['MAILBOX_DRIVER'] ?? 'imap',

    /*
    |--------------------------------------------------------------------------
    | Mail Transports
    |--------------------------------------------------------------------------
    */

    "transports" => [
        "smtp" => [
            "host" => $_ENV["MAIL_HOST"] ?? null,

            "port" => (int) ($_ENV["MAIL_PORT"] ?? 587),

            "username" => $_ENV["MAIL_USERNAME"] ?? null,

            "password" => $_ENV["MAIL_PASSWORD"] ?? null,

            "encryption" => $_ENV["MAIL_ENCRYPTION"] ?? "tls",

            "timeout" => (int) ($_ENV["MAIL_TIMEOUT"] ?? 30),

            "hostname" => $_ENV["MAIL_HOSTNAME"] ?? "localhost",
        ],
    ],

    /*
|--------------------------------------------------------------------------
| Default Sender
|--------------------------------------------------------------------------
*/

    "from" => [
        "address" => $_ENV["MAIL_FROM_ADDRESS"] ?? ($_ENV["MAIL_USERNAME"] ?? null),

        "name" => $_ENV["MAIL_FROM_NAME"] ?? "Sendity",
    ],
    /*
    |--------------------------------------------------------------------------
    | IMAP Configuration
    |--------------------------------------------------------------------------
    */
    /*
|--------------------------------------------------------------------------
| IMAP Configuration
|--------------------------------------------------------------------------
*/

    "imap" => [
        "host" => $_ENV["MAIL_IMAP_HOST"] ?? "localhost",

        "port" => (int) ($_ENV["MAIL_IMAP_PORT"] ?? 993),

        "username" => $_ENV["MAIL_IMAP_USERNAME"] ?? "",

        "password" => $_ENV["MAIL_IMAP_PASSWORD"] ?? "",

        "encryption" => $_ENV["MAIL_IMAP_ENCRYPTION"] ?? "ssl",

        "sent_folder" => $_ENV["MAIL_IMAP_SENT_FOLDER"] ?? null,

        "save_sent" => filter_var($_ENV["MAIL_IMAP_SAVE_SENT"] ?? true, FILTER_VALIDATE_BOOLEAN),

        "validate_cert" => filter_var($_ENV["MAIL_IMAP_VALIDATE_CERT"] ?? true, FILTER_VALIDATE_BOOLEAN),
    ],
];
