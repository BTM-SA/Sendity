<?php

declare(strict_types=1);

namespace Sendity\Mail\Drivers\SMTP;

use PHPMailer\PHPMailer\PHPMailer;
use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Events\MailFailed;
use Sendity\Events\MailSending;
use Sendity\Events\MailSent;
use Sendity\Mail\Contracts\MailboxInterface;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\MailMessage;
use Throwable;

class SmtpTransport implements MailerInterface
{
    public function __construct(
        protected Config $config,
        protected EventDispatcher $events,
        protected MailboxInterface $mailbox,
    ) {
    }

    public function send(MailMessage $message): void
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->CharSet = "UTF-8";

        $mail->SMTPOptions = [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true,
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | SMTP
        |--------------------------------------------------------------------------
        */

        $mail->Hostname = $this->config->get("mail.transports.smtp.hostname");
        $mail->Host = $this->config->get("mail.transports.smtp.host");
        $mail->Port = $this->config->get("mail.transports.smtp.port");

        $mail->SMTPAuth = true;

        $mail->Username = $this->config->get("mail.transports.smtp.username");
        $mail->Password = $this->config->get("mail.transports.smtp.password");

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        /*
        |--------------------------------------------------------------------------
        | Sender
        |--------------------------------------------------------------------------
        */

        $from = $message->getFrom();

        if ($from !== null) {
            $mail->setFrom(
                $from->getEmail(),
                $from->getName()
            );

            $mail->Sender = $this->config->get("mail.from.address");
        } else {
            $defaultFrom = $this->config->get("mail.from");

            $mail->setFrom(
                $defaultFrom["address"],
                $defaultFrom["name"]
            );

            $mail->Sender = $defaultFrom["address"];
        }

        /*
        |--------------------------------------------------------------------------
        | Recipients
        |--------------------------------------------------------------------------
        */

        foreach ($message->getTo() as $address) {
            $mail->addAddress(
                $address->getEmail(),
                $address->getName()
            );
        }

        foreach ($message->getCc() as $address) {
            $mail->addCC(
                $address->getEmail(),
                $address->getName()
            );
        }

        foreach ($message->getBcc() as $address) {
            $mail->addBCC(
                $address->getEmail(),
                $address->getName()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Reply-To
        |--------------------------------------------------------------------------
        */

        $replyTo = $message->getReplyTo();

        if ($replyTo !== null) {
            $mail->addReplyTo(
                $replyTo->getEmail(),
                $replyTo->getName()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Content
        |--------------------------------------------------------------------------
        */

        $mail->Subject = $message->getSubject();

        if ($message->getHtml() !== null) {
            $mail->isHTML(true);

            $mail->Body = $message->getHtml();

            if ($message->getText() !== null) {
                $mail->AltBody = $message->getText();
            }
        } else {
            $mail->isHTML(false);
            $mail->Body = $message->getText() ?? "";
        }

        /*
        |--------------------------------------------------------------------------
        | Headers
        |--------------------------------------------------------------------------
        */

        $mail->addCustomHeader(
            "X-Sendity-ID",
            $message->id()
        );

        foreach ($message->getHeaders() as $name => $value) {
            $mail->addCustomHeader($name, $value);
        }

        /*
        |--------------------------------------------------------------------------
        | Attachments
        |--------------------------------------------------------------------------
        */

        foreach ($message->getAttachments() as $attachment) {
            if ($attachment->hasName()) {
                $mail->addAttachment(
                    $attachment->getPath(),
                    $attachment->getName()
                );
            } else {
                $mail->addAttachment(
                    $attachment->getPath()
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Lifecycle - Sending
        |--------------------------------------------------------------------------
        */

        $message
            ->lifecycle()
            ->sending([
                "transport" => "smtp",
                "host" => $this->config->get("mail.transports.smtp.host"),
                "port" => $this->config->get("mail.transports.smtp.port"),
                "attempt" => 1,
            ]);

        $this->events->dispatch(
            new MailSending($message)
        );

        try {

            $mail->send();

            /*
            |--------------------------------------------------------------------------
            | Lifecycle - Sent
            |--------------------------------------------------------------------------
            */

            $message
                ->lifecycle()
                ->sent([
                    "transport" => "smtp",
                    "message_id" => $message->id(),
                ]);

            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */

            $this->events->dispatch(
                new MailSent($message)
            );

            /*
            |--------------------------------------------------------------------------
            | Save copy to Sent mailbox
            |--------------------------------------------------------------------------
            */

            if ($this->config->get("mail.imap.save_sent")) {
                try {

                    $mime = $mail->getSentMIMEMessage();

                    $this->mailbox->appendSent($mime);

                } catch (Throwable $e) {

                    /*
                     * SMTP delivery already succeeded.
                     * Saving a copy to Sent is secondary.
                     */

                    error_log(
                        "Unable to save message to Sent folder: "
                        . $e->getMessage()
                    );
                }
            }

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Lifecycle - Failed
            |--------------------------------------------------------------------------
            */

            $message
                ->lifecycle()
                ->failed([
                    "transport" => "smtp",
                    "host" => $this->config->get("mail.transports.smtp.host"),
                    "error" => $e->getMessage(),
                    "exception" => get_class($e),
                    "attempt" => 1,
                ]);

            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */

            $this->events->dispatch(
                new MailFailed(
                    $message,
                    $e
                )
            );

            throw $e;
        }
    }
}