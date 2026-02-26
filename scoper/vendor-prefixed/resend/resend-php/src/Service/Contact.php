<?php

namespace ScoperTest\Resend\Service;

use ScoperTest\Resend\Contracts\Transporter;
use ScoperTest\Resend\Service\Contacts\Segment;
use ScoperTest\Resend\Service\Contacts\Topic;
use ScoperTest\Resend\ValueObjects\Transporter\Payload;
class Contact extends Service
{
    public Segment $segments;
    public Topic $topics;
    /**
     * Create a new contact service instance with the given transport.
     */
    public function __construct(Transporter $transporter)
    {
        $this->segments = new Segment($transporter);
        $this->topics = new Topic($transporter);
        parent::__construct($transporter);
    }
    /**
     * Retrieve a single contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/get-contact
     */
    public function get(string $idOrEmail): \ScoperTest\Resend\Contact
    {
        $payload = Payload::get('contacts', $idOrEmail);
        $result = $this->transporter->request($payload);
        return $this->createResource('contacts', $result);
    }
    /**
     * Create a contact.
     *
     * @see https://resend.com/docs/api-reference/contacts/create-contact
     */
    public function create(array $parameters): \ScoperTest\Resend\Contact
    {
        $payload = Payload::create('contacts', $parameters);
        $result = $this->transporter->request($payload);
        return $this->createResource('contacts', $result);
    }
    /**
     * List all contacts.
     *
     * @param array{'limit'?: int, 'before'?: string, 'after'?: string} $options
     * @return \Resend\Collection<\Resend\Contact>
     *
     * @see https://resend.com/docs/api-reference/contacts/list-contacts
     */
    public function list(array $options = []): \ScoperTest\Resend\Collection
    {
        $payload = Payload::list('contacts', $options);
        $result = $this->transporter->request($payload);
        return $this->createResource('contacts', $result);
    }
    /**
     * Update a contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/update-contacts
     */
    public function update(string $idOrEmail, array $parameters): \ScoperTest\Resend\Contact
    {
        $payload = Payload::update('contacts', $idOrEmail, $parameters);
        $result = $this->transporter->request($payload);
        return $this->createResource('contacts', $result);
    }
    /**
     * Remove a contact by ID or email.
     *
     * @see https://resend.com/docs/api-reference/contacts/delete-contact
     */
    public function remove(string $idOrEmail): \ScoperTest\Resend\Contact
    {
        $payload = Payload::delete('contacts', $idOrEmail);
        $result = $this->transporter->request($payload);
        return $this->createResource('contacts', $result);
    }
}
