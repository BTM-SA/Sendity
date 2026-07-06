<?php

namespace Sendity\Services;

class Logger
{
    protected static string $logFile = __DIR__ . '/../../storage/logs/app.log';

    public static function info(string $message): void
    {
        self::write('INFO', $message);
    }

    public static function warning(string $message): void
    {
        self::write('WARNING', $message);
    }

    public static function error(string $message): void
    {
        self::write('ERROR', $message);
    }

    protected static function write(string $level, string $message): void
    {
        $directory = dirname(self::$logFile);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $line = sprintf(
            "[%s] [%s] %s%s",
            date('Y-m-d H:i:s'),
            $level,
            $message,
            PHP_EOL
        );

        file_put_contents(
            self::$logFile,
            $line,
            FILE_APPEND
        );
    }
}