<?php

namespace ScoperTest\Resend\Contracts;

use ScoperTest\Resend\Exceptions\ErrorException;
use ScoperTest\Resend\Exceptions\TransporterException;
use ScoperTest\Resend\Exceptions\UnserializableResponse;
use ScoperTest\Resend\ValueObjects\Transporter\Payload;
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
