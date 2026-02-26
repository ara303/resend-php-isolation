<?php

namespace ScoperTest\Resend\Enums\Transporter;

enum ContentType : string
{
    case JSON = 'application/json';
    case MULTIPART = 'multipart/form-data';
}
