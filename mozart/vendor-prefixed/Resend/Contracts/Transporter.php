<?php

namespace MozartTest\Resend\Contracts;

use MozartTest\Resend\Exceptions\ErrorException;
use MozartTest\Resend\Exceptions\TransporterException;
use MozartTest\Resend\Exceptions\UnserializableResponse;
use MozartTest\Resend\ValueObjects\Transporter\Payload;
interface Transporter
{
    /**
     * Sends a request to the Resend API.
     *
     * @return array<array-key, mixed>
     *
     * @throws ErrorException|TransporterException|UnserializableResponse
     */
    public function request(Payload $payload): array;
}