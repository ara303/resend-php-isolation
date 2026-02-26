<?php

namespace ScoperTest\Resend\Service\Emails\Receiving;

use ScoperTest\Resend\Service\Service;
use ScoperTest\Resend\ValueObjects\Transporter\Payload;
class Attachment extends Service
{
    /**
     * Retrieve an attachment for an inbound email.
     *
     * @see https://resend.com/docs/api-reference/attachments/retrieve-received-email-attachment
     */
    public function get(string $emailId, string $id): \ScoperTest\Resend\Emails\Attachment
    {
        $payload = Payload::get("emails/receiving/{$emailId}/attachments", $id);
        $result = $this->transporter->request($payload);
        return $this->createResource('attachments', $result);
    }
    /**
     * List all attachments and their contents for the given ID.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Emails\Attachment>
     *
     * @see https://resend.com/docs/api-reference/attachments/list-received-email-attachments
     */
    public function list(string $emailId, array $options = []): \ScoperTest\Resend\Collection
    {
        $payload = Payload::list("emails/receiving/{$emailId}/attachments", $options);
        $result = $this->transporter->request($payload);
        return $this->createResource('attachments', $result);
    }
}
