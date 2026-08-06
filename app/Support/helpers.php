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


if (! function_exists('app_path')) {

    function app_path(string $path = ''): string
    {
        return base_path(
            'app' . ($path !== ''
                ? DIRECTORY_SEPARATOR . ltrim($path, '/\\')
                : '')
        );
    }

}


if (! function_exists('config_path')) {

    function config_path(string $path = ''): string
    {
        return base_path(
            'config' . ($path !== ''
                ? DIRECTORY_SEPARATOR . ltrim($path, '/\\')
                : '')
        );
    }

}


if (! function_exists('storage_path')) {

    function storage_path(string $path = ''): string
    {
        return base_path(
            'storage' . ($path !== ''
                ? DIRECTORY_SEPARATOR . ltrim($path, '/\\')
                : '')
        );
    }

}