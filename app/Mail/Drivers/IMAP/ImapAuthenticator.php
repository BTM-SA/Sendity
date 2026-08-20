<?php

declare(strict_types=1);

namespace Sendity\Mail\Drivers\IMAP;

use Sendity\Core\Config;
use Sendity\Mail\Authentication\AuthenticationCredentials;
use Sendity\Mail\Contracts\MailAuthenticatorInterface;
use Sendity\Mail\Exceptions\AuthenticationException;
use Sendity\Mail\Exceptions\MailboxException;

final class ImapAuthenticator implements MailAuthenticatorInterface
{
    public function __construct(
        protected Config $config
    ) {
    }

    public function authenticate(AuthenticationCredentials $credentials): void
    {
        $imap = $this->config->get('mail.imap');

        $connection = imap_open(
            $this->serverString($imap) . 'INBOX',
            $credentials->username(),
            $credentials->password()
        );

        if ($connection === false) {
            $error = imap_last_error() ?: '';

            if (stripos($error, 'auth') !== false) {
                throw new AuthenticationException($error);
            }

            throw new MailboxException(
                $error ?: 'Unable to authenticate against IMAP server.'
            );
        }

        imap_close($connection);
    }

    protected function serverString(array $imap): string
    {
        $flags = sprintf(
            'imap/%s',
            $imap['encryption']
        );

        if (!$imap['validate_cert']) {
            $flags .= '/novalidate-cert';
        }

        return sprintf(
            '{%s:%d/%s}',
            $imap['host'],
            $imap['port'],
            $flags
        );
    }
}
