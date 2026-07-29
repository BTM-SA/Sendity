<?php

declare(strict_types=1);

if (! function_exists('base_path')) {

    function base_path(string $path = ''): string
    {
        $base = dirname(__DIR__, 2);

        return $path === ''
            ? $base
            : $base . DIRECTORY_SEPARATOR . ltrim($path, '/\\');
    }

}