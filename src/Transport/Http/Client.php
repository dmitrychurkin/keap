<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Transport\Http;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

final class Client implements HttpClient
{
    public function __construct(
        private readonly Factory $http,
    ) {}

    public function acceptJson(): PendingRequest
    {
        return $this->http->acceptJson();
    }

    public function asForm(): PendingRequest
    {
        return $this->http->asForm();
    }
}
