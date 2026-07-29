<?php

declare(strict_types=1);

error_log('Sendity mail bootstrap loaded');

if (! function_exists('imap_open')) {

    require_once base_path(
        'vendor/phpfui/php-imap/src/Imap2/IMAPStubs.php'
    );

}