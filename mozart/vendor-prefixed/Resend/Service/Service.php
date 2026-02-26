<?php

namespace MozartTest\Resend\Service;

use MozartTest\Resend\ApiKey;
use MozartTest\Resend\Audience;
use MozartTest\Resend\Broadcast;
use MozartTest\Resend\Collection;
use MozartTest\Resend\Contact;
use MozartTest\Resend\ContactProperty;
use MozartTest\Resend\Contacts\Topic as ContactTopic;
use MozartTest\Resend\Contracts\Transporter;
use MozartTest\Resend\Domain;
use MozartTest\Resend\Email;
use MozartTest\Resend\Emails\Attachment;
use MozartTest\Resend\Emails\Receiving;
use MozartTest\Resend\Resource;
use MozartTest\Resend\Segment;
use MozartTest\Resend\Template;
use MozartTest\Resend\Topic;
use MozartTest\Resend\Webhook;
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