<?php

namespace ScoperTest\Resend;

use ScoperTest\GuzzleHttp\Client as GuzzleClient;
use ScoperTest\Resend\Transporters\HttpTransporter;
use ScoperTest\Resend\ValueObjects\ApiKey;
use ScoperTest\Resend\ValueObjects\Transporter\BaseUri;
use ScoperTest\Resend\ValueObjects\Transporter\Headers;
class Resend
{
    /**
     * The current SDK version.
     */
    public const VERSION = '1.1.0';
    /**
     * Creates a new Resend Client with the given API key.
     */
    public static function client(string $apiKey): Client
    {
        $apiKey = ApiKey::from($apiKey);
        $baseUri = BaseUri::from(getenv('RESEND_BASE_URL') ?: 'api.resend.com');
        $headers = Headers::withAuthorization($apiKey);
        $client = new GuzzleClient();
        $transporter = new HttpTransporter($client, $baseUri, $headers);
        return new Client($transporter);
    }
}
