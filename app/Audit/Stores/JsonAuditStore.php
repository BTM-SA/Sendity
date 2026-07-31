<?php

declare(strict_types=1);

namespace Sendity\Audit\Stores;

use Sendity\Audit\AuditRecord;
use Sendity\Audit\Contracts\AuditStoreInterface;
use Sendity\Core\Config;
use Sendity\Mail\MailMessage;

class JsonAuditStore implements AuditStoreInterface
{
    protected string $directory;


    public function __construct(
    protected Config $config
) {
    $path = $this->config->get(
        'audit.path'
    );

    if (!is_string($path)) {
        throw new \RuntimeException(
            'Audit storage path is not configured.'
        );
    }

    $this->directory = $path;


    if (!is_dir($this->directory)) {

        mkdir(
            $this->directory,
            0777,
            true
        );
    }
}


    public function save(
        MailMessage $message
    ): void {

        $events = [];


        foreach ($message->lifecycle()->events() as $event) {

            $events[] = [
                'status' => $event->status()->value,

                'occurred_at' => $event
                    ->occurredAt()
                    ->format(DATE_ATOM),

                'metadata' => $event->metadata(),
            ];
        }


        $payload = [
            'id' => $message->id(),

            'subject' => $message->getSubject(),

            'events' => $events,
        ];


        file_put_contents(
            $this->directory . '/' . $message->id() . '.json',

            json_encode(
                $payload,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );
    }


    public function load(
        string $messageId
    ): ?AuditRecord {

        $file = $this->directory . '/' . $messageId . '.json';


        if (!file_exists($file)) {
            return null;
        }


        $data = json_decode(
            file_get_contents($file),
            true
        );


        return new AuditRecord(
            $data
        );
    }
}