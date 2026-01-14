<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Transport\Http;

use Illuminate\Http\Client\PendingRequest;

interface HttpClient
{
    public function acceptJson(): PendingRequest;

    public function asForm(): PendingRequest;
}
