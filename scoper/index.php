<?php

require_once __DIR__ . '/vendor-prefixed/autoload.php';

use ScoperTest\Resend\Resend;

$resend = Resend::client('re_test_fake_key_123');

try {
    $result = $resend->emails->send([
        'from' => 'test@example.com',
        'to'   => 'recipient@example.com',
        'subject' => 'Test',
        'text' => 'This is a test.',
    ]);
    echo "Unexpected success: " . print_r($result, true) . "\n";
} catch (\Throwable $e) {
    echo "API call failed (expected):\n";
    echo get_class($e) . ': ' . $e->getMessage() . "\n";
}
