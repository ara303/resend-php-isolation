<?php

namespace ScoperTest\Resend\Service;

use ScoperTest\Resend\ApiKey;
use ScoperTest\Resend\Audience;
use ScoperTest\Resend\Broadcast;
use ScoperTest\Resend\Collection;
use ScoperTest\Resend\Contact;
use ScoperTest\Resend\ContactProperty;
use ScoperTest\Resend\Contacts\Topic as ContactTopic;
use ScoperTest\Resend\Contracts\Transporter;
use ScoperTest\Resend\Domain;
use ScoperTest\Resend\Email;
use ScoperTest\Resend\Emails\Attachment;
use ScoperTest\Resend\Emails\Receiving;
use ScoperTest\Resend\Resource;
use ScoperTest\Resend\Segment;
use ScoperTest\Resend\Template;
use ScoperTest\Resend\Topic;
use ScoperTest\Resend\Webhook;
abstract class Service
{
    /**
     * @var array<string, \Resend\Resource>
     */
    protected $mapping = ['api-keys' => ApiKey::class, 'attachments' => Attachment::class, 'audiences' => Audience::class, 'broadcasts' => Broadcast::class, 'contacts' => Contact::class, 'contact-properties' => ContactProperty::class, 'contact-topics' => ContactTopic::class, 'domains' => Domain::class, 'receiving' => Receiving::class, 'emails' => Email::class, 'segments' => Segment::class, 'templates' => Template::class, 'topics' => Topic::class, 'webhooks' => Webhook::class];
    /**
     * Create a service instance with the given transporter.
     */
    public function __construct(protected readonly Transporter $transporter)
    {
        //
    }
    /**
     * Create a new resource for the given  with the given attributes.
     */
    protected function createResource(string $resourceType, array $attributes)
    {
        $class = isset($this->mapping[$resourceType]) ? $this->mapping[$resourceType] : Resource::class;
        if (isset($attributes['data']) && is_array($attributes['data'])) {
            foreach ($attributes['data'] as $key => $value) {
                $attributes['data'][$key] = $class::from($value);
            }
            return Collection::from($attributes);
        } else {
            return $class::from($attributes);
        }
    }
}
