<?php

declare(strict_types=1);

namespace Sendity\Mail\SMTP;

use PHPMailer\PHPMailer\PHPMailer;
use Sendity\Core\Config;
use Sendity\Core\Events\EventDispatcher;
use Sendity\Events\MailSending;
use Sendity\Events\MailSent;
use Sendity\Events\MailFailed;
use Sendity\Mail\MailerInterface;
use Sendity\Mail\MailMessage;
use Throwable;



class SmtpTransport implements MailerInterface
{
    public function __construct(protected Config $config, protected EventDispatcher $events)
    {
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

        // SMTP identity
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
            $mail->setFrom($from->getEmail(), $from->getName());
            $mail->Sender = $this->config->get("mail.from.address");
        } else {
            $defaultFrom = $this->config->get("mail.from");

            $mail->setFrom($defaultFrom["address"], $defaultFrom["name"]);

            $mail->Sender = $defaultFrom["address"];
        }

        /*
        |--------------------------------------------------------------------------
        | Recipients
        |--------------------------------------------------------------------------
        */

        foreach ($message->getTo() as $address) {
            $mail->addAddress($address->getEmail(), $address->getName());
        }

        foreach ($message->getCc() as $address) {
            $mail->addCC($address->getEmail(), $address->getName());
        }

        foreach ($message->getBcc() as $address) {
            $mail->addBCC($address->getEmail(), $address->getName());
        }

        /*
        |--------------------------------------------------------------------------
        | Reply-To
        |--------------------------------------------------------------------------
        */

        $replyTo = $message->getReplyTo();

        if ($replyTo !== null) {
            $mail->addReplyTo($replyTo->getEmail(), $replyTo->getName());
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
                $mail->addAttachment($attachment->getPath(), $attachment->getName());
            } else {
                $mail->addAttachment($attachment->getPath());
            }
        }

  

        $this->events->dispatch(new MailSending($message));

                     try {

            $mail->send();

        } catch (Throwable $e) {

            $this->events->dispatch(
                new MailFailed(
                    $message,
                    $e
                )
            );

            throw $e;
        }


        $this->events->dispatch(
            new MailSent($message)
        );
    }
}