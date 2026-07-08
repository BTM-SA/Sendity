<?php

namespace Sendity\Core\Exceptions;

use Sendity\Services\Logger;
use Throwable;

class ExceptionHandler
{
    public function report(Throwable $e): string
    {
        $reference = strtoupper(bin2hex(random_bytes(4)));

        Logger::error(sprintf(
            '[%s] %s: %s',
            $reference,
            get_class($e),
            $e->getMessage()
        ));

        return $reference;
    }

    public function render(Throwable $e, string $reference): void
    {
        http_response_code(500);

        echo "<h1>Sendity Error</h1>";

        echo "<p>Something went wrong.</p>";

        echo "<p><strong>Reference:</strong> {$reference}</p>";
    }
}